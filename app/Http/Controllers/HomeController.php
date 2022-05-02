<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\ProductImages;

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
}
