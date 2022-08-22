<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DebugController extends Controller
{
    public function debug(Request $request){
        
        $files = [];
        $files_image = Session::get('customer.files.drug_image') ? Session::get('customer.files.drug_image') : [];
        
        foreach($files_image as $file){
            $files[] = $file;
        }


        return isset( $files[0]['uri'] ) ? $files[0]['uri'] : false;

        $order = Order::find(9);
        dd($order->address);
        $products = $order->products;
        foreach($products as $product){
            dd( $product->pivot->quantity );
        }
    }
}
