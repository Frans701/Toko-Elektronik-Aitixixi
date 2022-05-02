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
                    <div class="table-responsive col-lg-auto">
                        {{-- <a href="/admin/category/create" class="btn btn-primary my-3"> Create new category</a> --}}
                        <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">
                                    Tanggal Transaksi
                                </th>
                                <th scope="col">
                                    Alamat
                                </th>
                                <th scope="col">
                                      Total Pembayaran
                                </th>
                                <th scope="col">
                                      Status
                                </th>
                                <th scope="col">
                                    Opsi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $item)
                                <tr>   
                                  <td>{{ $loop->iteration }}</td>             
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
                                    <a href="/admin/transaction/{{ $item->id }}/edit"
                                        class="badge bg-info nav-link">Detail</span></a>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
                {{ $transactions->links() }}

            </div>
        </div>
    </div>
</div>
@endsection
