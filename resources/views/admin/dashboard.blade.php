@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><strong>Produk</strong></h4>
          {{-- <div class="card-tools">
            <a href="/produk" class="btn btn-sm btn-danger">
              More
            </a>
          </div> --}}
        </div>
        <div class="card-body">

          {{-- isi --}}
          <div class="container">
            <div class="row">
                @foreach ( $products as $product )
                <div class="col-md-4 mb-3">
                    <div class="card">
                      @if($product->categories->isNotEmpty())
                        <div class="position-absolute bg-dark px-3 py-2 text-white"> <a class="text-white text-decoration-none">{{ $product->categories->pluck('category_name')->implode(',') }}</a></div>
                      @endif
                      @if($product->images->isNotEmpty())
                      <img src="{{ asset('storage/' . $product->images[0]->image_name) }}"
                          class="img-fluid mt-3 alt=" {{ $product->product_name }}>
                      @else
                      <img src="https://source.unsplash.com/500x400?{{ $product->product_name }}"
                          class="img-fluid mt-3 alt=" {{ $product->product_name }}>
                      @endif
                      <div class="card-body">
                          <div>
                            <h5>{{ $product->product_name }}</h5>
                          </div>
                          <div>
                                <small>
                                    By <a href="/authors/{{ $product->product_name }}"
                                        class="text-decoration-none">{{ auth()->user()->admin_name }}</a>
                                    {{ $product->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <p class="card-text">{{ $product->excerpt }}</p>
                            <a href="/admin/products/{{ $product->id }}" class="btn btn-primary">Detail</a>
                          </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- @foreach ( $products as $category )
          <ul>
              <li>
                  <h2>{{ $category->product_name }}</h2>
              </li>
          </ul>
        @endforeach --}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection