@extends('layouts.template')
@section('content')
    <section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('landing') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
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
    <section class="product-page pb-4 pt-4">
        <div class="container">
            <div class="row product-detail-inner">
                <div class="col-lg-5 col-md-6 col-12">
                    @if($images->isNotEmpty())
                        <div class="mb-3">
                            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                @foreach ($images as $image)
                                    <div class="carousel-item {{ $image['id'] == $images[0]->id ? 'active' : '' }}" data-bs-interval="10000">
                                    <img src="{{ asset('storage/' . $image->image_name) }}" class="slider-img" alt="...">
                                </div>
                                @endforeach
                            </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $product->product_name }}"
                            class="img-fluid mt-3" alt=" {{ $product->product_name }}">
                    @endif
                </div>
                
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="product-detail">
                        <h2 class="product-name">{{ $product->product_name }}</h2>
                        @if(!is_null($product->getActiveDiscount()))
                        <div class="product-price">
                            <span class="price">Rp. {{ number_format($product->getPriceOrDiscountedPrice()) }}</span>  <span class="price-muted">Rp. {{ number_format($product->price) }}</span>
                        </div>
                        @else
                        <div class="product-price">
                            <span class="price">Rp. {{ number_format($product->price) }}</span>
                        </div>
                        @endif

                        <div class="product-select">
                                <div class="form-group mt-2">
                                    <span>Weight : {{ $product->weight }} Kg</span>
                                </div>
                                <!--<div class="form-group">
                                    <label>Color</label>
                                    <select class="form-control">
                                        <option>-- Color --</option>
                                    </select>
                                </div>-->
                                <form action="{{route('address')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <label for="qty" class="form-label">Jumlah</label>
                                    @if($product->stock <= 0)
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="0"/>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <span>Stok Habis</span>
                                        </div>
                                    @else
                                        <div class="col-md-3">
                                            <input id="qty" name="qty" type="number" class="form-control" placeholder="1"/>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <span>Stok : {{ $product->stock }}</span>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">
                                        @if(!is_null($product->getActiveDiscount()))
                                            <input type="hidden" name="price" id="price" value="{{$product->getPriceOrDiscountedPrice()}}">
                                        @else
                                            <input type="hidden" name="price" id="price" value="{{$product->price}}">
                                        @endif
                                        <input type="hidden" name="weight" id="weight" value="{{$product->weight}}">
                                        <div class="btn-group btn-block mt-3" role="group" aria-label="Basic example">
                                            <button type="submit" class="btn btn-primary">Buy Now!</button>
                                        </div>
                                </div>
                                </form>
                                <form action="{{route('addCarts')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="btn-group btn-block mt-3" role="group" aria-label="Basic example">
                                    <input type="hidden" name="product_id" value="{{$product->id}}" id="product_id">
                                    <button type="submit" class="btn btn-outline-primary">Add to Cart</button>
                                </div>
                                </form>
                                @endif
                        </div>
                        <div class="product-categories mt-2">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                @foreach($product->categories as $category)
                                    <li><a href="#">{{$category->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        {!! $product->description !!}
                                    </div>
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <div class="review-form">
                                            @if (!$product->product_review->count())
                                                <div class="d-flex justify-content-center">    
                                                <div class="row mb-5">
                                                    <p><strong>Belum ada review produk.</strong></p> 
                                                </div>
                                                </div>
                                            @else
                                                <h4>Review Produk</h4>
                                                @foreach ($product->product_review as $item)
                                                <!-- First row -->
                                                <div class="row mb-3 ml-5 mt-3">
                                    
                                                    <!-- Content column -->
                                                    <div class="col-sm-12 col-12">
                                    
                                                    <a>
                                                        <h5 style="color:#333333" class="user-name">{{$item->user->user_name}}
                                                            <p><i class="far fa-clock-o"></i> {{$item->created_at}}</p>
                                                        </h5>
                                                    </a>
                                    
                                                    <!-- Rating -->
                                                    <ul class="rating">
                                                        @for ($i = 0; $i < $item->rate; $i++)
                                                        <a>
                                                            <i class="fas fa-star blue-text" style="color:#FFD700"></i>
                                                        </a>
                                                        @endfor
                                                    </ul>
                                                    <input type="hidden" class="rate{{$loop->iteration-1}}" value="{{$item->rate}}">
                                                    <input type="hidden" class="content{{$loop->iteration-1}}" value="{{$item->content}}">
                                                    <input type="hidden" class="review_id{{$loop->iteration-1}}" value="{{$item->id}}">
                                    
                                                    <p class="dark-grey-text article">{{$item->content}}</p>
                                    
                                                    </div>
                                                    <!-- Content column -->
                                    
                                                </div>
                                                <!-- First row -->
                                                @if ($item->response->count())
                                                    <!-- Balasan -->
                                                    @foreach ($item->response as $balasan)
                                                    <div class="row mb-5" style="margin-left: 50%">
                                                    
                                                    <!-- Image column -->
                                
                                                    <!-- Content column -->
                                                    <div class="col-sm-10 col-12">
                                
                                                        <a>
                                
                                                        <h6 style="text-align: right"><strong>Admin</strong></h6>
                                                        <h6 style="text-align: right">
                                                            {{$balasan->admin->admin_name}}
                                                        </h6>
                                                        <p style="text-align: right"> {{$balasan->created_at}} <i class="far fa-clock-o"></i></p>
                                
                                                        </a>
                                                        <!-- Rating -->
                                
                                                        <p class="dark-grey-text article" style="text-align: right">{{$balasan->content}}</p>
                                
                                                    </div>
                                                    <!-- Content column -->
                                
                                                    </div>
                                
                                                    @endforeach
                                                    <!-- Balasan -->
                                
                                                @endif
                                                    
                                                @endforeach
                                    
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection