@extends('layouts.template')

@section('content')
  <section class="breadcrumb-section pb-1 pt-2">
    <div class="container">
        <ol class="breadcrumb">
            
            <h2 style="color:#0275d8" class="ml-5">Transaksi</h2>
        </ol>
    </div>
  </section>
  @if (\Session::has('success'))
    <section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <div class="alert alert-success">
                    <h6 align="center">{!! \Session::get('success') !!}</h6>
            </div>
        </div>
    </section>
  @endif
    <div class="container mt-3">
        <section class="product-page ml-5 mr-5 pb-3 pt-2">
            <div class="row mt-2">
                <div class="col-md-12">
                  @if($transaksi->count()==0)
                    <section class="breadcrumb-section pb-3 pt-3">
                      <div class="container">
                          <div class="alert alert-succses">
                                  <h5 align="center">Transaksi Kosong</h5>
                          </div>
                      </div>
                    </section>
                  @endif
                    <div class="card mb-2 shadow-sm">
                        <div class="table-responsive-sm">
                            <table class="table text-center">
                              <!-- Table head -->
                              <thead>
                                <tr class="table-light">
                                  <th>
                                    Tanggal Transaksi
                                  </th>
                                  <th>
                                    Alamat
                                  </th>
                                  <th>
                                      Total Pembayaran
                                  </th>
                                  <th>
                                      Status
                                  </th>
                                  <th>
                                    Opsi
                                  </th>
                                </tr>
                              </thead>
                              <!-- Table head -->
                              <!-- Table body -->
                              <tbody>
                                <!-- First row -->
                                @foreach ($transaksi as $item)
                                <tr>                
                                  <td>
                                      {{$item->created_at->format('d, M Y')}}
                                  </td>
                                  <td>
                                      {{$item->address}}
                                  </td>
                                  <td>
                                      Rp.{{number_format($item->sub_total)}}
                                  </td>
                                  <td>
                                      {{$item->status}}
                                  </td>
                                  <td>
                                    <a href="{{ Route('transaksi_detail', $item->id) }}">Detail</a>
                                  </td>
                                </tr>
                                @endforeach
                                <!-- First row -->
                              </tbody>
                              <!-- Table body -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $transaksi->links() }}
          </section>
          
          
    </div>

@endsection