<?php

namespace App\Transformers;

use App\Models\Worker;
use League\Fractal\TransformerAbstract;

class WorkerTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    // protected $defaultIncludes = [
    //     //
    // ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    // protected $availableIncludes = [
    //     //
    // ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Worker $worker)
    {
         return [
            'id' => (int)$worker->id,
            'name' => (string)$worker->name,
            'email' => (string)$worker->email,
            'birthdate' => (string)$worker->birthdate, 
            'active' => (int)$worker->active,
            'created_at' => (string)$worker->created_at,
            'updated_at' => (string)$worker->updated_at,
            'deleted_at' => isset($worker->deleted_at) ? (string) $worker->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('workers.show', $worker->id),
                ],
            ],
        ];   
    }

    

    public static function originalAttribute($index)
    {
        $attributes = [
            'id'        =>'id',
            'name'      =>'name',
            'email'     =>'email',
            'birthdate' =>'birthdate',
            'active'    =>'active',
            'created_at'=>'created_at',
            'updated_at'=>'updated_at',
            'deleted_at'=>'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        


        $attributes = [
            'id'        =>'id',
            'name'      =>'name',
            'email'     =>'email',
            'birthdate' =>'birthdate',
            'active'    =>'active',
            'created_at'=>'created_at',
            'updated_at'=>'updated_at',
            'deleted_at'=>'deleted_at',
        ];



        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
    
}
