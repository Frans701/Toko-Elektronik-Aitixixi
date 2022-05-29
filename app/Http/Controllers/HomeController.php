<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\ProductImages;
use App\Models\UserNotification;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('homepage.index', [
            'products' => Products::with('images','discount')->orderBy('id', 'DESC')->take(6)->get(),
            
        ]);
    }

    public function detail_produk($id)
    {
        $product = Products::with('images','details','categories','discount')->find($id);
        $images = ProductImages::where('product_id','=',$id)->get();

        return view('homepage.detail_produk', compact('product', 'images'));
    }

    public function user_notif($id) 
    {
        $notification = UserNotification::find($id);
        $notif = json_decode($notification->data);
        
        $date = Carbon::now('Asia/Makassar');
        $baca= UserNotification::find($id);
        $baca->read_at =$date;
        $baca->update();

        if ($notif->category == 'review') {
            return redirect()->route('detail_produk',$notif->id);
        } else{
            return redirect()->route('transaksi_detail',$notif->id);
        } 
     
    }

    public function read_all() 
    {
        $date = Carbon::now('Asia/Makassar');
        $baca= UserNotification::all();
        //dd($baca);
        foreach($baca as $bacas){
            if($bacas->read_at == ''){
                $read = UserNotification::find($bacas->id);
                $read->read_at =$date;
                $read->update();
            }
        }

        return redirect()->back();
    }
}
