<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_name' => 'required'
        ]);

        $lastIdProduct = $request->product_id;

        if($request->file('image_name')){
            ProductImages::create([
                'product_id' => $lastIdProduct, 
                'image_name' => $request->file('image_name')->store('post-image')
            ]);
        }

        return redirect('/admin/images/' . $lastIdProduct)->with('success', 'Image has been successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.images.index', [
            'title' => 'Products',
            'product' => Products::findOrFail($id),
            'images' => ProductImages::where('product_id','=',$id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImages $image)
    {
        return view('admin.images.edit', [
            'image' => $image,
            'title' => 'Image'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'image_name' => 'required'
        ]);

        $prod_id = $request->image_id;

        $lastIdProduct = $request->product_id;

        if($request->file('image_name')){
            ProductImages::where('id', $prod_id)->update([
                'image_name' => $request->file('image_name')->store('post-image')
            ]);
        }
        
        return redirect('/admin/images/' . $lastIdProduct)->with('success', 'Image has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = ProductImages::find($id); 
        $image->delete();

        $lastIdProduct = Products::latest()->first()->id;

        return redirect('/admin/images/' . $lastIdProduct)->with('success', 'Image has been successfully deleted!');
    }
}
