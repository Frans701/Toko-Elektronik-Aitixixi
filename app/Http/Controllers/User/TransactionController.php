<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Courier;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use DB;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request){

        $data_courier = $request->data_courier;
        $courier_id = Courier::where('courier','=',$data_courier)->first();

        date_default_timezone_set("Asia/Makassar");
        $data= array(
            'user_id' => Auth::user()->id,
            'courier_id' => $courier_id->id,
            'timeout' => date('Y-m-d H:i:s', strtotime('+1 days')),
            'address' => $request->address,
            'city' => $request->city_name,
            'province' => $request->province,
            'total' => $request->total_harga,
            'shipping_cost' => $request->shipping_cost,
            'sub_total' => $request->sub_total1,
            'proof_of_payment' => 0,
            'status' => 'unpaid'
        ); 
        $transaction = Transaction::create($data);

        $lastIdTransaction = $transaction->id;
        if($request->product_id !=0){
        
            $detail_transaksi = new TransactionDetail;
            $detail_transaksi->transaction_id = $lastIdTransaction;
            $detail_transaksi->product_id = $request->product_id;
            $detail_transaksi->qty = $request->qty;
            $produk = Products::with('discount')->find($request->product_id);
            if($produk->discount->count()){
                foreach($produk->discount as $diskon){
                    if($diskon->end > date('Y-m-d H:i:s')){
                        $detail_transaksi->discount = $diskon->percentage;
                    }else{
                        $detail_transaksi->discount = 0;
                    }
                }
            }else{
                $detail_transaksi->discount = 0;
            }
            $detail_transaksi->selling_price = $request->price;
            $detail_transaksi->save();

            $product = Products::find($request->product_id);
            $stock = $product->stock - $request->qty;
            $product_qty= array(
                'stock' => $stock
            ); 
            $product->update($product_qty);
        }
        else{
            $cart = Cart::with(['products' => function($q){
                $q->with('images','discount');
            }])->where('user_id', '=', Auth::user()->id)->where('status', '=', 'notyet')->get();
    
            foreach($cart as $item){
                $detail_transaksi = new TransactionDetail;
                $detail_transaksi->transaction_id = $lastIdTransaction;
                $detail_transaksi->product_id = $item->products->id;
                $detail_transaksi->qty = $item->qty;
                if($item->products->discount->count()){
                    foreach($item->products->discount as $diskon){
                        if($diskon->end > date('Y-m-d H:i:s')){
                            $detail_transaksi->discount = $diskon->percentage;
                        }else{
                            $detail_transaksi->discount = 0;
                        }
                    }
                }else{
                    $detail_transaksi->discount = 0;
                }
                $detail_transaksi->selling_price = $item->products->getPriceOrDiscountedPrice();
                $detail_transaksi->save();

                $product = Products::find($item->products->id);
                $stock = $product->stock - $item->qty;
                $product_qty= array(
                    'stock' => $stock
                ); 
                $product->update($product_qty);

                $charts = Cart::where('product_id','=',$item->products->id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->get();
                foreach($charts as $item){
                    Cart::destroy($item->id);
                }
            }
        }

        $admin = Admin::find(1);
        $data = [
            'nama'=> Auth::user()->user_name,
            'message'=>'membeli product!',
            'id'=> $lastIdTransaction,
            'category' => 'transaction'
        ];
        $data_encode = json_encode($data);
        $admin->createNotif($data_encode);

        return redirect('transaksi')->withSuccess("Pesanan telah dibuat, Silahkan selesaikan pembayaran");
        
    }

    public function index()
    {
        $transaksi = Transaction::where('user_id','=',Auth::user()->id)->orderBy('id', 'DESC')->paginate(6);
        
        return view('user.transaction', ['transaksi' => $transaksi]);
    }
    
}