<?php

namespace App\Http\Controllers;

use App\Models\ProductCategoriesDetails;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Models\Products;

class DashboardController extends Controller
{
    public function dashboard() {
        // $data = array('title' => 'Dashboard');
        return view('admin.dashboard', [
            "title" => "All Products",
            // "posts" => Post::all()
            "active" => "Posts",
            "products" => Products::all()   
        ]);
    }
}
