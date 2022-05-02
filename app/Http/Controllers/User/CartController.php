<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Products;
use App\Models\Cart;
use DB;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //$cart = Cart::where('user_id','=',Auth::user()->id)->get();
        $cart = Cart::with(['products' => function($q){
            $q->with('images','discount');
        }])->where('user_id', '=', Auth::user()->id)->where('status', '=', 'notyet')->get();
        
        $total = 0;

        foreach ($cart as $carts) {
            $total += $carts->products->getPriceOrDiscountedPrice() * $carts->qty;
        }

        return view('user.cart', compact('cart', 'total'));
    }

    public function addCarts(Request $request)
    {   
        $cart = Cart::where('user_id','=',Auth::user()->id)
                    ->where('product_id', '=', $request->product_id)
                    ->first();
                    
        if($cart == true){
            $sum = $request->qty + $cart->qty;
            $dataa= array(
                'qty' => $cart->qty + 1,
                'status' => 'notyet'
            ); 

            Cart::where('user_id','=',Auth::user()->id)
                    ->where('product_id', '=', $request->product_id)
                    ->update($dataa);
        }else{    
            $data= array(
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'qty' => 1,
                'status' => 'notyet'
            ); 
            Cart::create($data);
        }
        

        return redirect()->back()->with(compact('cart'))->withSuccess("Sukses Masuk Keranjang");


    }

    public function delete(Request $request)
    {
        Cart::destroy($request->id);

        return redirect('charts')->withSuccess("Produk dihapus dari Keranjang");
    }

    public function minus(Request $request)
    {
        $data=array(
            'qty' => $request->quantity - 1
        );

        $transaksi = Cart::find($request->id);
        $transaksi->update($data);

        return redirect('charts');
    }

    public function plus(Request $request)
    {
        $data=array(
            'qty' => $request->quantity + 1
        );

        $transaksi = Cart::find($request->id);
        $transaksi->update($data);

        return redirect('charts');
    }
}
