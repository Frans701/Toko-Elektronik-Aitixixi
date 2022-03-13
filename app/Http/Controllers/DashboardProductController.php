<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\ProductCategoriesDetails;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products', [
            "title" => "All Posts",
            // "posts" => Post::all()
            "active" => "Posts",
            "details" => ProductCategoriesDetails::get()
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create', [
            'title' => 'Created',
            'categories' => ProductCategories::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:100',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $products = Products::create($validateData);
        
        $lastIdProduct = $products->id;

        $validateDetails = ([
            'product_id' => $lastIdProduct, 
            'category_id' => $request->input('category_id')
        ]);

        ProductCategoriesDetails::create($validateDetails);

        return redirect('/admin/products')->with('success', 'new post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        return view('admin.product', [
            'title' => 'product',
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        return view('admin.edit', [
            'product' => $product,
            'title' => 'Edit Product'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $rules = [
            'product_name' => 'required|max:100',
            'description' => 'required'
        ];

        $validateData = $request->validate($rules);

        Products::where('id', $product->id)->update($validateData);

        return redirect('/admin/products')->with('success', 'Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        Products::destroy($product->id);

        return redirect('/admin/products')->with('success', 'Post has been added!');
    }
}
