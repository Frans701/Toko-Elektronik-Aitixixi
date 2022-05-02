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
                                        <input type="text" value="{{$province}}" class="form-control" name='province' id="province" required readonly>
                                    </div>
                                    <div class="col mt-3">
                                        <label for="country" class="form-label">Kabupaten/Kota</label>
                                        <input type="text" value="{{$destination_name}}" class="form-control" name='city_name' id="city_name" required readonly>
                                    </div>
                                    <div class="col mt-3">
                                        <label for="country" class="form-label">Alamat</label>
                                        <input type="text" value="{{$address}}" class="form-control" name='address' id="address" required readonly>
                                    </div>
                                        <div class="col mt-3">
                                            <label for="courier" class="form-label">Pilih Kurir</label>
                                            <select name="courier" id="courier" class="form-control" value="{{ $data_courier }}" required>
                                                @foreach ($couriers as $courier)
                                                <option value="{{ $courier->courier }}"
                                                    {{ old('courier', $data_courier) == $courier->courier ? 'selected' : '' }}>
                                                    {{ $courier->courier }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col mt-3">
                                            <input type="hidden" name="province" value="{{$province}}" id="province">
                                            <input type="hidden" name="destination" value="{{$destination_name}}" id="destination">
                                            <input type="hidden" name="address" value="{{$address}}" id="address">
                                            <input type="hidden" name="product_id" value="{{$product_id}}" id="product_id">
                                            <input type="hidden" name="price" id="price" value="{{$price}}">
                                            <input type="hidden" name="qty" id="qty" value="{{$qty}}">
                                            <input type="hidden" name="weight" id="weight" value="{{$total_weight}}">
                                            <button type="submit" class="btn btn-primary btn-block">Cek Ongkir</button>  
                                        </div>
                                    </form>
                                    @if($result_cost)
                                        <div class="row">
                                            <div class="col ml-3 mt-3 mr-3">
                                                <div class="table-responsive-sm">
                                                <table class="table table-striped table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Service</th>
                                                            <th>Deskripsi</th>
                                                            <th>Harga</th>
                                                            <th>Estimasi Pengiriman (Hari)</th>
                                                            <th>Note</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($result_cost as $result)
                                                        <form action="{{ route('check_out', $result['cost'][0]['value']) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                        <tr>
                                                            <td>{{$result['service']}}</td>
                                                            <td>{{$result['description']}}</td>
                                                            <td> 
                                                                Rp.{{number_format($result['cost'][0]['value'])}}
                                                            </td>
                                                            <td>{{$result['cost'][0]['etd']}}</td>
                                                            <td>
                                                                <input type="hidden" name="province" id="province" value="{{$province}}">
                                                                <input type="hidden" name="city_name" id="city_name" value="{{$destination_name}}">
                                                                <input type="hidden" name="data_courier" id="data_courier" value="{{$data_courier}}">
                                                                <input type="hidden" name="address" id="address" value="{{$address}}">
                                                                <input type="hidden" name="product_id" value="{{$product_id}}" id="product_id">
                                                                <input type="hidden" name="price" id="price" value="{{$price}}">
                                                                <input type="hidden" name="qty" id="qty" value="{{$qty}}">
                                                                <button type="submit" class="btn btn-primary">Pilih</button>
                                                            </td>
                                                        </tr>
                                                        </form>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection