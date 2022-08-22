<?php

namespace App\Http\Controllers\Front\Worker;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        $customer = ( Auth::user() ) ? Customer::find( Auth::user()->id ) : json_decode( json_encode(['id' => 0, 'name' => '', 'email' => '']) );
        
        return view('customer.workers')
        ->with('customer', $customer)
        ->with('search', $request->search)
        ->with('secret', 'prueba');
    }

    public function show()
    {
       
        return view('customer.product-detail');
    }
}
