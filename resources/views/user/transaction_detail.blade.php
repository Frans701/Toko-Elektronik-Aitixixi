@extends('layouts.template')
@section('content')
<section class="breadcrumb-section pb-1 pt-2">
    <div class="container">
        <ol class="breadcrumb">
            
            <h2 style="color:#0275d8" class="ml-5">Detail Transaksi</h2>
        </ol>
    </div>
</section>
@if (\Session::has('error'))
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <div class="alert alert-danger">
                <h6 align="center">{!! \Session::get('error') !!}</h6>
        </div>
    </div>
</section>
@endif
    <div class="container mt-3">
        <section class="breadcrumb-section pt-4">
            <div class="col ml-5 mt-1 mb-3">
                <a href="{{ route('transaksi') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>  
            </div>
            <div class="container">
                <h5 class="ml-5">Produk Dipesan</h5>
            </div>

        <section class="product-page ml-5 mr-5 pb-3 pt-2">
            <div class="row mt-2">
                <div class="col-md-8">
                    <div class="col-md-13">
                        <div class="card mb-4 shadow-sm">
                            <div class="row ml-3 mt-4 mb-3">
                                <h6>Pembeli: {{ Auth::user()->user_name }}</h6>
                                <h6>Alamat: {{ $transaksi->address }}</h6>
                                <h6>Pengirim: {{ $transaksi->courier->courier }}</h6>
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
                                            @if($transaksi->status == 'finish')
                                            <td>Action</td>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi->transaction_detail as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $item->product->images[0]->image_name) }}"
                                                class="img-fluid" alt=" {{ $item->product->product_name }}" width="50">
                                            </td>
                                            <td>{{ $item->product->product_name }}</td>
                                            <td>Rp. {{ number_format($item->selling_price) }}</td>
                                            <td align="center">{{ $item->qty }}</td>
                                            @if($transaksi->status == 'finish' )
                                            @if(!(Auth::user()->alreadyReviewed($item->product_id, $transaction_id)))
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateBarang{{ $item->product_id }}">Nilai</button>     
                                                </td>
                                            @else
                                            <td>
                                                Sudah dinilai
                                            </td>
                                            @endif
                                            @endif
                                            <!-- Modal Update Barang-->
                                            <div class="modal inmodal fade" id="modalUpdateBarang{{ $item->product_id }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                                                <div class="modal-dialog modal-xs">
                                                    <form action="{{route('review', $item->product_id)}}" method="post">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Review Produk</h4>
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group"><label class="col-lg-5 control-label">Nilai Produk (1-5)</label>
                                                                <div class="col-lg-12">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="1" required>
                                                                        <label class="form-check-label" for="inlineRadio1">1</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="2" required>
                                                                        <label class="form-check-label" for="inlineRadio1">2</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="3" required>
                                                                        <label class="form-check-label" for="inlineRadio1">3</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="4" required>
                                                                        <label class="form-check-label" for="inlineRadio1">4</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="rate" id="inlineRadio1" value="5" required>
                                                                        <label class="form-check-label" for="inlineRadio1">5</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="col-lg-2 control-label">Pesan</label>
                                                                <div class="col-lg-12"><textarea  type="text" name="content" placeholder="Pesan" class="form-control" rows="3" required></textarea></div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                            <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
                                                            <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </tr>       
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
                            @if ($transaksi->status == 'unpaid' && $transaksi->timeout > date('Y-m-d H:i:s'))
                                @php
                                    date_default_timezone_set("Asia/Makassar");
                                    $date1 = new DateTime($transaksi->timeout);
                                    $date2 = new DateTime(date('Y-m-d H:i:s'));
                                    $tenggat = $date1->diff($date2);
                                @endphp
                                    <span class="badge badge-danger center mt-3 ml-3 mr-3">Sisa Waktu Pembayaran: {{$tenggat->h}} Jam, {{$tenggat->i}} Menit</span>
                            @endif
                            </tr>
                            <tr>
                                <td>Bank:</td>
                                <td>Mandiri</td>
                            </tr>
                            <tr>
                                <td>No. Rekening:</td>
                                <td>1234567890</td>
                            </tr>
                            <tr>
                                <td>a/n:</td>
                                <td>Aitixixi Electronics</td>
                            </tr>
                            <tr>
                                <td>Total Harga:</td>
                                <td>Rp.{{ number_format($transaksi->total) }}</td>
                            </tr>
                            <tr>
                                <td>Ongkos Kirim:</td>
                                <td>Rp.{{ number_format($transaksi->shipping_cost) }}</td>
                            </tr>
                            <tr>
                                <td>SubTotal:</td>
                                <td>Rp.{{ number_format( $transaksi->sub_total ) }}</td>
                            </tr>
                            
                        </table>
                        <div class="col mt-3 mb-4">
                            @if($transaksi->proof_of_payment == 0 && $transaksi->status == 'unpaid' && $transaksi->timeout > date('Y-m-d H:i:s'))
                            <form action="{{route('pembayaran')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h6 align="center">Upload Bukti Pembayaran</h6>
                                <input type="hidden" name="id" value="{{$transaksi->id}}">
                                <div class="mb-3">
                                    <img style="visibility:hidden"  id="prview" src=""  width="100%" />
                                    <input type="file" name="file" id="imgInp" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block mt-2">Kirim</button>
                            </form>
                            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$transaksi->id}}" >
                                <input type="hidden" name="status" value="canceled">
                                <button type="submit" class="btn btn-outline-primary btn-block mt-2" onclick="return confirm('Apa yakin ingin membatalkan pesanan ini?')">Batalkan Pesanan</button> 
                            </form>
                            @endif
                            @if($transaksi->status == 'delivered')
                            <h6 align="center">Barang dalam proses pengiriman</h6> 
                            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$transaksi->id}}">
                                <input type="hidden" name="status" value="finish">
                                <button type="submit" class="btn btn-primary btn-block mt-2">Pesanan Diterima</button>
                            </form>
                            @endif
                            @if($transaksi->status == 'expired')
                                <h6 align="center">Batas Waktu Pembayaran Telah Habis</h6>
                            @endif
                            @if($transaksi->status == 'canceled')
                                <h6 align="center">Pesanan Dibatalkan</h6>
                            @endif
                            @if($transaksi->status == 'verified')
                                <h6 align="center">Pembayaran Sudah Terverifikasi</h6>
                            @endif
                            @if($transaksi->status == 'finish')
                                <h6 align="center">Barang Telah Sampai di Tujuan</h6>
                            @endif
                            @if($transaksi->status == 'unverified')
                                <h6 align="center">Menunggu Verifikasi</h6> 
                            @endif
                                <a href="{{ route('transaksi') }}" class="btn btn-outline-primary btn-block mt-2">Kembali</a> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection