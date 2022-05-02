<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use DB;

use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index(Request $request, $ongkir){

        $province = $request->province;
        $city_name = $request->city_name;
        $data_courier = $request->data_courier;
        $address = $request->address;

        $product_id = $request->product_id;
        $price = $request->price;
        $weight = $request->weight;
        $qty = $request->qty;

        if($request->product_id !=0){
            $product = Products::where('id', '=', $request->product_id)->get();
            $total_harga = $qty * $price;

        }
        else{
            $product = Cart::with(['products' => function($q){
                $q->with('images','discount');
            }])->where('user_id', '=', Auth::user()->id)->where('status', '=', 'notyet')->get();
            $total_harga = $request->price;
        }
        $shipping_cost = $ongkir;

        //$sub_total = $shipping_cost + $total;

        $sub_total1 = $ongkir + $total_harga;

        return view('user.check_out', compact('province','city_name', 'data_courier', 'address', 'product_id', 'product','price', 'shipping_cost','qty','total_harga','sub_total1'));
        
    }

    
}