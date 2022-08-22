<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "customers";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origin',
        'email',
        'image', 
        'password', 
        'customer_group_id',
        'firstname',
        'lastname',
        'rut',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function findOrCreate(array $customerArr){
                
        $customer = self::where('email','=',$customerArr['email'])->get()->first();

        if($customer){
            
            $customer->firstname    = $customerArr['firstname'];
            $customer->lastname     = $customerArr['lastname'];
            $customer->email        = $customerArr['email'];
            $customer->image        = $customerArr['image'];
            $customer->save();

        } else {

            $customerArr['password'] = '$2y$13$dhrdVVazqEDAeqEj7lo5vuinuKgo6BrsPD9vD7NVQY.XfMpyBOUmm';
            $customer = self::create($customerArr);

        }

        return $customer;
    }
}
