<?php

namespace App\Models;

use App\User;
use App\Models\Order;
use App\Models\Address;


class Customer extends User
{
    public function addresses(){
    	return $this->hasMany(Address::class)->withTrashed();
    }

    public function addressesActives(){
    	return $this->hasMany(Address::class);
    }

    public function orders(){
    	return $this->hasMany(Order::class);
    }
}
