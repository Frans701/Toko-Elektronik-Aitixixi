@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <!-- table produk -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><strong>Discounts Produk</strong></h4>
                </div>
                <div class="container-fluid">
                    <div class="table-responsive col-lg-auto">
                        <a href="/admin/discount/create" class="btn btn-primary my-3"> Create new Discounts</a>
                        <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Discount</th>
                            <th scope="col">start</th>
                            <th scope="col">end</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $discount->product->product_name }}</td>
                                <td>{{ $discount->percentage }}%</td>
                                <td>{{ date('d-m-Y', strtotime($discount->start)); }}</td>
                                <td>{{ date('d-m-Y', strtotime($discount->end)); }}</td>
                                <td>
                                    <a href="/admin/discount/{{ $discount->id }}/edit"
                                        class="badge bg-warning nav-link">Edit</span></a>
                                    <form action="/admin/discount/{{ $discount->id }} }" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger nav-link border-0" onclick="return confirm('aru you sure?')">Delete</span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
