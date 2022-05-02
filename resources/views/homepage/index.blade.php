@extends('layouts.template')
@section('content')
    <!-- di bawah menu baru kontennya -->
      <div class="container">
        <!-- carousel -->
        <div class="row">
          <div class="col">
            <div id="carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="{{ asset('images/slide1.jpg') }}" class="rounded mx-auto d-block w-75" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/slide2.jpg') }}" class="rounded mx-auto d-block w-75" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="{{ asset('images/slide3.jpg') }}" class="rounded mx-auto d-block w-75" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
        <!-- end carousel -->

        <!-- kategori produk -->
        <div class="row mt-4">
          <div class="col col-md-12 col-sm-12 mb-4">
            <h2 class="text-center">Kategori Produk</h2>
          </div>
          <!-- kategori pertama -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <a href="{{ URL::to('kategori/satu') }}">
                <img src="{{asset('images/slide1.jpg') }}" alt="foto kategori" class="card-img-top">
              </a>
              <div class="card-body">
                <a href="/product" class="text-decoration-none">
                  <p class="card-text">Laptops</p>
                </a>
              </div>
            </div>
          </div>
          <!-- kategori kedua -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <a href="{{ URL::to('kategori/dua') }}">
                <img src="{{asset('images/slide1.jpg') }}" alt="foto kategori" class="card-img-top">
              </a>
              <div class="card-body">
                <a href="{{ URL::to('kategori/dua') }}" class="text-decoration-none">
                  <p class="card-text">Accessories</p>
                </a>
              </div>
            </div>
          </div>
          <!-- kategori ketiga -->
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              <a href="{{ URL::to('kategori/tiga') }}">
                <img src="{{asset('images/slide1.jpg') }}" alt="foto kategori" class="card-img-top">
              </a>
              <div class="card-body">
                <a href="{{ URL::to('kategori/tiga') }}" class="text-decoration-none">
                  <p class="card-text">Televisions</p>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- end kategori produk -->

        <!-- produk Terbaru-->
        <div class="row mt-4">
          <div class="col col-md-12 col-sm-12 mb-4">
            <h2 class="text-center">Terbaru</h2>
            <a href="#" class="float-right" ><i class="fas fa-eye"></i> Lihat Semua </a>
          </div>
          <!-- produk pertama -->
          @foreach($products as $product)
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <a href="{{ Route('detail_produk', $product->id) }}">
                  @if($product->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $product->images[0]->image_name) }}"
                    class="img-fluid mt-3 img-box" alt=" {{ $product->product_name }}">
                  @else
                    <img src="https://source.unsplash.com/500x400?{{ $product->product_name }}"
                    class="img-fluid mt-3 img-box" alt=" {{ $product->product_name }}">
                  @endif
                  <!-- <img src="{{ $product->gambar }}" alt="foto produk" class="card-img-top"> -->
                </a>
                <div class="card-body">
                  <a href="{{ Route('detail_produk', $product->id) }}" class="text-decoration-none">
                    <p class="card-text">
                      {{ $product->product_name }}
                    </p>
                  </a>
                  <div class="row mt-2">
                    <div class="col-auto">
                      @if(!is_null($product->getActiveDiscount()))
                        <p>
                          Rp. {{ number_format($product->getPriceOrDiscountedPrice()) }}
                        </p>
                      @else
                        <p>
                          Rp. {{ number_format($product->price) }}
                        </p>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach  
        <!-- end produk terbaru -->
      </div>
@endsection