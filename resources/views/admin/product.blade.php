@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><strong>Produk</strong></h4>
          <div class="card-tools">
            {{-- <a href="/produk" class="btn btn-sm btn-danger">
              More
            </a> --}}
          </div>
        </div>
        
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <article class="my-3">
                        <h2>{{ $product->product_name }}</h2>
                        <p>By <a href="/authors/{{ $product->product_name }}"
                                class="text-decoration-none">{{ $product->product_name }}</a> In
                            <a class="text-decoration-none"
                                href="/categories/{{ $product->product_name }}">Kategori</a>
                        </p>
                        <img src="https://source.unsplash.com/1200x400?{{ $product->product_name }}" class="img-fluid mt-3 alt="{{ $product->product_name }} ">

                        {!! $product->description !!}
                    </article>
                    <div class="my-3 fs-5">
                        <a href="/admin/dashboard"> Back to Products</a>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection