<?php

namespace App\Http\Controllers\Api\Worker;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PutWorkerRequest;
use App\Http\Requests\WorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workers = Worker::sortByName()->get();

        return $this->showAll($workers);
    }

    public function moreResults(Request $request)
    {
        if( $request->search ){

            $searchPrimary = collect([]);
            $searchSecondary = collect([]);

            $phrase = $request->search;

            $rawQueryPrimary = " name LIKE '%".$phrase."%' OR email LIKE '%".$phrase."%'";
                    

            $words = explode( ' ', $request->search );

            $rawQuerySecondary = '';
            
            foreach( $words as $word){
                if( $this->wordIsSearchable($word) ){
                    if($rawQuerySecondary==''){
                        $rawQuerySecondary .= "name LIKE '%".$phrase."%' OR email LIKE '%".$phrase."%'";
                    } else {
                        $rawQuerySecondary .= " OR name LIKE '%".$phrase."%' OR email LIKE '%".$phrase."%'";
                    }
                } 
            }
           
            if($rawQueryPrimary !== ''){
                $searchPrimary = Worker::whereRaw($rawQueryPrimary)->get();
            }

            if($rawQuerySecondary !== ''){
                $searchSecondary = Worker::whereRaw($rawQuerySecondary)->get();
            }

            $products = $searchPrimary->merge($searchSecondary)->unique('id');
            
            

            
        } else {
            $products = Worker::all();
        }
        
        
        return $this->showAll($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        
        $request->validated();
        
        $data['name']       =$request->name;
        $data['email']      =$request->email;
        $data['password']   =bcrypt($request->password);
        $data['birthdate']  =$request->birthdate;
        $data['active']     =$request->active ? Worker::ACTIVE : Worker::INACTIVE;


        $worker = Worker::create( $data );

        return $this->showOne($worker);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
        return $this->showOne($worker);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(PutWorkerRequest $request, Worker $worker)
    {
        $request->validated();

        $worker->fill($request->only([
            'name',
            'email',
            'birthdate',
        ]));

        if($request->password){
            $worker->password=bcrypt($request->password);
        }

        if($request->active){
            $worker->active=$request->active ? Worker::ACTIVE : Worker::INACTIVE;
        }

        $worker->save();

        return $this->showOne($worker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        
        $worker->delete();

        return $this->showOne($worker);
    }
}
