@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <!-- table produk -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><strong>Transaction</strong></h4>
                </div>
                <div class="container-fluid">
                    <section class="product-page ml-5 mr-5 pb-3 pt-2">
                        <div class="row mt-2">
                            <div class="col-md-8">
                                <div class="col-md-13">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="row ml-3 mt-4 mb-3">
                                            <h6>Pembeli: a</h6>
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
                                        @if($transaksi->status == 'unverified')
                                        <form action="{{route('verified')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h6 align="center">Bukti Pembayaran</h6>
                                            <input type="hidden" name="id" value="{{$transaksi->id}}">
                                            <a href="{{ asset('storage/' . $transaksi->proof_of_payment) }}" class="perbesar" target="_blank">
                                            <img src="{{ asset('storage/' . $transaksi->proof_of_payment) }}" alt="proof_of_payment" class="media-avatar rounded" width="100%" >
                                            </a>
                                            <input type="hidden" name="status" value="verified">
                                            <h6 align="center">Menunggu Verifikasi</h6> 
                                            <button type="submit" class="btn btn-primary btn-block mt-2">Verified</button>
                                        </form>
                                        @endif
                                        @if($transaksi->status == 'verified')
                                        <form action="{{route('kirim')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h6 align="center">Bukti Pembayaran</h6>
                                            <a href="{{ asset('storage/' . $transaksi->proof_of_payment) }}" class="perbesar" target="_blank">
                                                <img src="{{ asset('storage/' . $transaksi->proof_of_payment) }}" alt="proof_of_payment" class="media-avatar rounded" width="100%" >
                                            </a>
                                            <h6 align="center">Pembayaran Sudah Terverifikasi</h6>
                                            <input type="hidden" name="status" value="delivered">
                                            <input type="hidden" name="id" value="{{$transaksi->id}}">
                                            <button type="submit" class="btn btn-primary btn-block mt-2">Kirim Barang</button>
                                        </form>
                                        @endif
                                        @if($transaksi->status == 'finish')
                                        <h6 align="center">Bukti Pembayaran</h6>
                                            <a href="{{ asset('storage/' . $transaksi->proof_of_payment) }}" class="perbesar" target="_blank">
                                                <img src="{{ asset('storage/' . $transaksi->proof_of_payment) }}" alt="proof_of_payment" class="media-avatar rounded" width="100%" >
                                            </a>
                                        <h6 align="center">Barang Telah Sampai</h6> 
                                        @endif
                                        @if($transaksi->status == 'expired')
                                            <h6 align="center">Batas Waktu Pembayaran Telah Habis</h6>
                                        @endif
                                        @if($transaksi->status == 'canceled')
                                            <h6 align="center">Pesanan Dibatalkan</h6>
                                        @endif
                                        @if($transaksi->status == 'unpaid')
                                            <h6 align="center">Menunggu Pembayaran</h6>
                                        @endif
                                        @if($transaksi->status == 'delivered')
                                            <h6 align="center">Bukti Pembayaran</h6>
                                            <a href="{{ asset('storage/' . $transaksi->proof_of_payment) }}" class="perbesar" target="_blank">
                                                <img src="{{ asset('storage/' . $transaksi->proof_of_payment) }}" alt="proof_of_payment" class="media-avatar rounded" width="100%" >
                                            </a>
                                            <h6 align="center">Barang Sedang Dikirim</h6>
                                        @endif
                                            <a href="/admin/transaction" class="btn btn-outline-primary btn-block mt-2">Kembali</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
