<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.discount.index', [
            'title' => 'Discount',
            'discounts' => Discount::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create', [
            'title' => 'Discount',
            'products' => Products::all()
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
        $request->validate([
            'product_name' => 'required',
            'start' => 'required|date|after:tomorrow',
            'end' => 'required|date|after:start',
            'discount' => 'required|numeric|digits_between:1,2',
        ]);

        Discount::create([
            'product_id' => $request->product_name,
            'start' => $request->start,
            'end' => $request->end,
            'percentage' => $request->discount,
        ]);

        return redirect('/admin/discount/')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.discount.edit', [
            'title' => 'Discount',
            'discount' => Discount::find($id),
            'products' => Products::all()
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
        $rules = [
            'product_id' => 'required',
            'start' => 'required|date|after:tomorrow',
            'end' => 'required|date|after:start',
            'percentage' => 'required|numeric|digits_between:1,2',
        ];

        $prod_id = $request->discount_id;

        $validateData = $request->validate($rules);

        Discount::where('id', $prod_id)->update($validateData);
        
        return redirect('/admin/discount/')->with('success', 'update post has been added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discount = Discount::find($id); 
        $discount->delete();

        return redirect('/admin/discount')->with('success', 'Discount has been added!');
    }
}
