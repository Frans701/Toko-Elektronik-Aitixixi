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
                <h5 class="ml-5">Ongkos Pengiriman</h5>
            </div>
            <section class="product-page ml-5 mr-5 pb-3 pt-3">
                <div class="container ml-2">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('getongkir')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col mt-3">
                                        <label for="country" class="form-label">Provinsi</label>
                                        <input type="text" value="{{$province->province}}" class="form-control" name='province' id="province" required readonly>
                                    </div>
                                    <div class="col mt-3">
                                        <label for="country" class="form-label">Kabupaten/Kota</label>
                                        <input type="text" value="{{$destination_name->city_name}}" class="form-control" name='destination' id="destination" required readonly>
                                    </div>
                                    <div class="col mt-3">
                                        <label for="country" class="form-label">Alamat</label>
                                        <input type="text" value="{{$address}}" class="form-control" name='address' id="address" required readonly>
                                    </div>
                                        <div class="col mt-3">
                                            <label for="country" class="form-label">Pilih Kurir</label>
                                            <select name="courier" id="courier" class="form-control" value="{{ old('courier') }}" required>
                                                <option value="" holder>Pilih Kurir</option>
                                                @foreach ($couriers as $courier)
                                                    <option value="{{ $courier->courier }}">{{ $courier->courier }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col mt-3">
                                            <input type="hidden" name="product_id" value="{{$product_id}}" id="product_id">
                                            <input type="hidden" name="price" id="price" value="{{$price}}">
                                            <input type="hidden" name="qty" id="qty" value="{{$qty}}">
                                            <input type="hidden" name="weight" id="weight" value="{{$weight}}">
                                            <button type="submit" class="btn btn-primary btn-block">Cek Ongkir</button>  
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection