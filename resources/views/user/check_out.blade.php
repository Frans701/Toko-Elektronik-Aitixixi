@extends('layouts.template')
@section('content')
<section class="breadcrumb-section pb-1 pt-2">
    <div class="container">
        <ol class="breadcrumb">
            
            <h2 style="color:#0275d8" class="ml-5">Check Out</h2>
        </ol>
    </div>
</section>
    <div class="container mt-3">
        <section class="breadcrumb-section pt-4">
            <div class="container">
                <h5 class="ml-5">Produk Dipesan</h5>
            </div>

        <section class="product-page ml-5 mr-5 pb-3 pt-2">
            <form action="/pesan" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mt-2">
                <div class="col-md-8">
                    <div class="col-md-13">
                        <div class="card mb-4 shadow-sm">
                            <div class="row ml-3 mt-4 mb-3">
                                <h6>Pembeli: {{ Auth::user()->user_name }}</h6>
                                <h6>Alamat: {{ $address }}</h6>
                                <h6>Pengirim: {{ $data_courier }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                            <div class="table-responsive-sm">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <td>Produk Dipesan</td>
                                            <td>Nama</td>
                                            <td>Harga Satuan</td>
                                            <td>Jumlah</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $products)
                                        @if($product_id !=0)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $products->images[0]->image_name) }}"
                                                class="img-fluid" alt=" {{ $products->product_name }}" width="50">
                                            </td>
                                            <td>{{ $products->product_name }}</td>
                                            <td>Rp. {{ number_format($products->getPriceOrDiscountedPrice()) }}</td>
                                            <td align="center">{{ $qty }}</td>
                                        </tr> 
                                        @else
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $products->products->images[0]->image_name) }}"
                                                class="img-fluid" alt=" {{ $products->products->product_name }}" width="50">
                                            </td>
                                            <td>{{ $products->products->product_name }}</td>
                                            <td>Rp. {{ number_format($products->products->getPriceOrDiscountedPrice()) }}</td>
                                            <td align="center">{{ $products->qty }}</td>
                                        </tr> 
                                        @endif      
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <table width="1000px" class="col ml-3 mt-4 mb-3" style="border-collapse: collapse; border: none;">
                            <tr>
                                <td>Total Harga:</td>
                                <td>Rp.{{ number_format($total_harga) }}</td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim:</td>
                                <td>Rp.{{ number_format($shipping_cost) }}</td>
                            </tr>
                            <tr>
                                <td>SubTotal:</td>
                                <td>Rp.{{ number_format($sub_total1) }}</td>
                            </tr>
                        </table>
                        <div class="col mt-3 mb-4">
                            <input type="hidden" name="province" id="province" value="{{$province}}">
                            <input type="hidden" name="city_name" id="city_name" value="{{$city_name}}">
                            <input type="hidden" name="address" id="address" value="{{$address}}">
                            <input type="hidden" name="data_courier" id="data_courier" value="{{$data_courier}}">
                            <input type="hidden" name="product_id" id="product_id" value="{{$product_id}}">
                            <input type="hidden" name="price" id="price" value="{{$price}}">
                            <input type="hidden" name="qty" id="qty" value="{{$qty}}">
                            <input type="hidden" name="shipping_cost" id="shipping_cost" value="{{$shipping_cost}}">
                            <input type="hidden" name="total_harga" id="total_harga" value="{{$total_harga}}">
                            <input type="hidden" name="sub_total1" id="sub_total1" value="{{$sub_total1}}">
                            <button type="submit" class="btn btn-primary btn-block">Buat Pesanan</button>  
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </section>
    </div>

@endsection