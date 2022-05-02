<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Rdj\Rajaongkir\Facades\Rajaongkir;
use App\Models\Province;
use App\Models\Products;
use App\Models\City;
use App\Models\Courier;
use App\Models\Cart;
use Illuminate\Support\Facades\Http;
use DB;

use Illuminate\Http\Request;

class OngkirController extends Controller
{
    public function index(Request $request){
        //Variabel key dan url API raja ongkir
        $key = '8580f5686e5a3eeab330119f3d82e31e'; //Buat akun atau pakai API akun Tahu Coding
        $cost_url = 'https://api.rajaongkir.com/starter/cost';

        $destination = $request->destination;
        $destination = City::where('city_name','=',$destination)->first();
        //Variabel yang valuenya didapat dari request()
        if($request->has('destination') && $request->has('courier') && $request->product_id !=0){
            
            $qty = $request->qty;
            $data_destination = $destination->id;
            $data_courier = $request->courier;
            $weight = $request->weight;
            $total_weight = $qty * $weight;
            //dd($total_weight);

        }
        else{
            $qty = $request->qty;
            $data_destination = $destination->id;
            $data_courier = $request->courier;
            $total_weight = $request->weight;
        }            

            //logic untuk calculate cost
        $cost = $this->postData($key,$cost_url,$data_destination,$total_weight,$data_courier);
            //$cost->throw();
        $result_cost = $cost['rajaongkir']['results'][0]['costs'];

        //load data provinsi dari database
        $provinces = Province::all();
        $couriers = Courier::all(); 
        //$province = Province::where('id', '=', $request->province)->first();
        //$destination_name = City::where('id','=',$data_destination)->first();
        $province = $request->province;
        $destination_name = $request->destination;
        $address = $request->address;
        $product_id = $request->product_id;
        $price = $request->price;
        //load view form
        return view('user.getongkir',compact('province','address','result_cost','destination_name','total_weight','data_courier', 'product_id', 'price', 'qty', 'couriers'));
        
    }
    
    //function untuk load select dependant
    public function getCitiesAjax($id)
    {
        $cities = City::where('province_id','=', $id)->pluck('city_name','id');       
    
        return json_encode($cities);
    }

    //function untuk calculate cost 
    private function postData($key, $url,$data_destination,$total_weight,$data_courier){
        //retry() maskudnya function untuk retry hit API jika time out sebanyak parameter pertama dan range interval pada parameter kedua dalam milisecon
        //asForm() maksudnya menggunakan application/x-www-form-urlencoded content type biasanya untuk method POST
        //withHeaders() maksudnya parameter header (Jika diminta, masing2 API punya header masing-masing dan yang tidak pakai header)
        return Http::retry(10, 200)->asForm()->withHeaders([            
            'key' => $key
        ])->post($url, [
            'origin' => 114,
            'destination' => $data_destination,
            'weight' => $total_weight,
            'courier' => $data_courier
        ]);
        //setelah $url itu adalah array yaitu parameter wajib yg dibutuhkan ketika meminta POST request
    }

    public function address(Request $request){
        
        $couriers = Courier::all();  
        $provinces = Province::all();
        if(!is_null($request->product_id)){
            $product_id = $request->product_id;
            $price = $request->price;
            $qty = $request->qty;
            $weight = $request->weight;
            if($qty==0){
                $qty=1;
            }
        }else{
            $cart = Cart::with(['products' => function($q){
                $q->with('images','discount');
            }])->where('user_id', '=', Auth::user()->id)->where('status', '=', 'notyet')->get();
            foreach($cart as $item){
                if($item->products->stock >= $item->qty){
                    $weight = DB::table('carts')
                    ->join('products', 'products.id', '=', 'carts.product_id')
                    ->where('user_id','=',Auth::user()->id)
                    ->sum(\DB::raw('products.weight * carts.qty'));
            
                    $price = $request->total_harga;
                    $qty = 0;
                    $product_id = 0;
                }else{
                    return redirect()->back()->with(compact('cart'))->with('error', 'Stok barang '. $item->products->product_name .' tidak cukup!'.' (stok:'. $item->products->stock.')');
                }
            }
        }
        
        return view('user.address', compact('couriers', 'provinces', 'product_id', 'price', 'qty', 'weight'));
   }

   public function ongkir(Request $request){
    
    $product_id = $request->product_id;
    $price = $request->price;
    $weight = $request->weight;
    $qty = $request->qty;
    $data_destination = $request->destination;
    $province = Province::where('id', '=', $request->province_destination)->first();
    $destination = $request->destination;
    $destination_name = City::where('id','=',$data_destination)->first();
    $address = $request->address;
    $couriers = Courier::all();  
    //load view form
    return view('user.ongkir',compact('product_id', 'price', 'weight', 'qty', 'province', 'destination_name', 'address', 'couriers'));
   }
    
}