<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait ApiResponser
{
	
	protected $perPage = 10;
	
	private function successResponse($data, $code)
	{
		return response()->json($data, $code);
	}

	protected function errorResponse($message, $code)
	{
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	//todos: solo se extrae la página (una parte) o vienen todos los datos
	//todos: si viene solo parte, necesita calcularse el total
	protected function showAll(Collection $collection, $code = 200, $paginate = true, $todos = true, $total = 0)
	{

		if( $collection->isEmpty() ){
			return $this->successResponse(['data' => $collection], $code);
		}

		$transformer = $collection->first()->transformer;
		
		if($todos){
			$collection = $this->filterData($collection, $transformer);
		}
		
		
		$collection = $this->sortData($collection, $transformer);

		if($paginate && !request()->all ){
			$collection = $this->paginate($collection, $todos, $total);
		}

		$collection = $this->transformData($collection, $transformer);

		//$collection = $this->cacheResponse($collection);

		return $this->successResponse($collection, $code);
	}

	protected function showAllPivot(Collection $collection, $code = 200)
	{

		if( $collection->isEmpty() ){
			return $this->successResponse(['data' => $collection], $code);
		}

		$transformer = $collection->first()->transformer;



		$collection = $this->sortData($collection, $transformer);

		$collection = $this->paginate($collection);



		//$collection = $this->cacheResponse($collection);

		return $this->successResponse($collection, $code);
	}



	protected function showOne(Model $instance, $code = 200)
	{



		$transformer = $instance->transformer;

		$instance = $this->transformData($instance, $transformer);

		return $this->successResponse($instance, $code);
	}

	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse(['data' => $message], $code);
	}


	protected function filterData(Collection $collection, $transformer)
	{
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$collection = $collection->where($attribute, $value);
			}
		}

		return $collection;
	}

	protected function keyValuesFilterData($transformer)
	{
		$data = [];
		
		foreach (request()->query() as $query => $value) {
			$attribute = $transformer::originalAttribute($query);

			if (isset($attribute, $value)) {
				$data[$attribute] = $value;
			}
		}

		return $data;
	}


	protected function wordIsSearchable($word){
		
		
		
		$numbers = 0;
		for ($i = 0; $i < strlen($word); $i++) {
			if ( ctype_digit($word[$i]) ) {
				$numbers++;
			}
		}
		
		return  strlen($word) > 3 && strlen($word)/2 > $numbers; 
 

	}


	protected function buildQueryWhereWithKeyValuesFilterData($transformer, $prefix = '')
	{
		$keysValues = $this->keyValuesFilterData($transformer);
		
        $rawQuery = '';

		if($prefix!=''){
			$prefix = $prefix.'.';
		}
		

        foreach($keysValues as $key => $value){
            if($rawQuery==''){
                $rawQuery .= " ".$prefix.$key." = ".$value;
            } else {
                $rawQuery .= " AND ".$prefix.$key." = ".$value;
            }
            
        }

		return $rawQuery;
	}


	protected function sortData(Collection $collection, $transformer)
	{
		if (request()->has('sort_by')) {
			$attribute = $transformer::originalAttribute( request()->sort_by );

			$collection = $collection->sortBy->{$attribute};
		}

		return $collection;
	}


	protected function paginate(Collection $collection, $todos, $total)
	{

		$rules = [
			'per_page' => 'integer|min:2|max:50'
		];

		Validator::validate(request()->all(), $rules);

		$page = LengthAwarePaginator::resolveCurrentPage();

		$perPage = $this->perPage;

		if (request()->has('per_page')) {
			$perPage = (int) request()->per_page;
		}


		$results = $todos ? $collection->slice(($page - 1) * $perPage, $perPage)->values() : $collection;

		$count = $todos ? $collection->count() : $total;

		$paginated = new LengthAwarePaginator($results, $count, $perPage, $page, [
			'path' => LengthAwarePaginator::resolveCurrentPath(),
		]);

		$paginated->appends(request()->all());

		return $paginated;

	}


	protected function transformData($data, $transformer)
	{


		$transformation = fractal($data, new $transformer);

		return $transformation->toArray();
	}


	protected function cacheResponse($data)
	{
		$url = request()->url();

		$queryParams = request()->query();

		ksort($queryParams);

		$queryString = http_build_query($queryParams);

		$fullUrl = "{$url}?{$queryString}";

		return Cache::remember($fullUrl, 30, function() use($data) {
			return $data;
		});
	}


}
