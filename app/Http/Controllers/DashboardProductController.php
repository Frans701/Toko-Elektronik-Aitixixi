<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\ProductCategoriesDetails;
use App\Models\ProductImages;
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
            "products" => Products::get()
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
        // return $request->file('image_name')->store('post-images');

        $request->validate([
            'product_name' => 'required|max:100',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'description' => 'required'
        ]);

        $products = Products::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'description' => $request->description,
        ]);

        // $products->categories()->attach($request->categories);

        
            
        foreach ($request->categories as $key => $value) {
            ProductCategoriesDetails::create([
                'product_id' => $products->id,
                'category_id' => $value
            ]);
        }
        
        $lastIdProduct = $products->id;

        // $validateDetails = ([
        //     'product_id' => $lastIdProduct, 
        //     'categories' => $request->input('category_id')
        // ]);

        // ProductCategoriesDetails::create($validateDetails);

        // $validateImages = ([
        //     'product_id' => $lastIdProduct, 
        // ]);



        if($request->file('images_name')){
            foreach ($request->file('images_name') as $key => $value) {
                ProductImages::create([
                    'product_id' => $lastIdProduct, 
                    'image_name' => $value->store('post-images')
                ]);
            }
            // $validateImages['image_name'] = $request->file('image_name')->store('post-images');
        }

        return redirect('/admin/products')->with('success', 'new post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.product', [
            'title' => 'product',
            'product' => Products::findOrFail($id),
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
            'title' => 'Edit Product',
            'categories' => ProductCategories::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->category_id);
        $rules = [
            'product_name' => 'required|max:100',
            'price' => 'required',
            'stock' => 'required',
            'weight' => 'required',
            'description' => 'required'
        ];

        $prod_id = $request->product_id;

        $validateData = $request->validate($rules);

        $product = Products::find($id);
        Products::where('id', $prod_id)->update($validateData);
        $product->categories()->sync($request->categories);
        $product->save();

        return redirect('/admin/products')->with('success', 'update post has been added!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id); 
        $product->delete();

        return redirect('/admin/products')->with('success', 'Post has been added!');
    }
}
