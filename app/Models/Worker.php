<?php

namespace App\Models;

use App\Transformers\WorkerTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    
    use SoftDeletes;

    public $transformer = WorkerTransformer::class;

    public const ACTIVE = 1;

    public const INACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password', 
        'birthdate',
        'active',
    ];

    /**
     * Scope a query to sort users by name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortByName($query)
    {
        return $query->orderBy("name");
    }
}
