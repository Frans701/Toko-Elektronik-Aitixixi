@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <!-- table produk -->
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
                                        class="text-decoration-none">{{ auth()->user()->admin_name }}</a> In Kategory
                                    <a class="text-decoration-none"
                                        href="/categories/{{ $product->product_name }}">{{ $product->categories->pluck('category_name')->implode(',') }}</a>
                                </p>
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
                        {!! $product->description !!}
                    </article>
                    <div class=" my-3 fs-5">
                        <a href="/admin/dashboard"> Back to Products</a>
                                            @if (!$product->product_review->count())
                                                <div class="d-flex justify-content-center">    
                                                <div class="row mb-5 mt-3">
                                                    <p><strong>Belum ada review produk.</strong></p> 
                                                </div>
                                                </div>
                                            @else
                                                <h4 class="mt-3" >Review Produk</h4>
                                                @foreach ($product->product_review as $item)
                                                <!-- First row -->
                                                <div class="row mb-3 ml-5 mt-3">
                                    
                                                    <!-- Content column -->
                                                    <div class="col-sm-12 col-12">
                                    
                                                    <a>
                                                        <h6 style="color:#333333" class="user-name">{{$item->user->user_name}}
                                                            <p><i class="far fa-clock-o"></i> {{$item->created_at}}</p>
                                                        </h6>
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
                                                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalUpdateBarang{{ $item->id }}">Balas</button>
                                                            <!-- Modal Update Barang-->
                                                                <div class="modal inmodal fade" id="modalUpdateBarang{{ $item->id }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xs">
                                                                        <form action="{{route('respons', $item->id)}}" method="post">
                                                                        @csrf
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Review Produk</h4>
                                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group"><label class="col-lg-3 control-label">Review</label>
                                                                                    <ul class="rating">
                                                                                        @for ($i = 0; $i < $item->rate; $i++)
                                                                                        <a>
                                                                                            <i class="fas fa-star blue-text" style="color:#FFD700"></i>
                                                                                        </a>
                                                                                        @endfor
                                                                                        <p class="">{{ $item->content }}</p>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group"><label class="col-lg-2 control-label">Pesan</label>
                                                                                    <div class="col-lg-12"><textarea  type="text" name="content" placeholder="Pesan" class="form-control" rows="3" required></textarea></div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            
                                    
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
                                
                                                        <h6 style="text-align: right">Admin</h6>
                                                        <h6 style="text-align: right"><strong>
                                                            {{$balasan->admin->admin_name}}</strong>
                                                        </h6>
                                                        <h6 style="text-align: right"> {{$balasan->created_at}} <i class="far fa-clock-o"></i></p>
                                
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
@endsection
