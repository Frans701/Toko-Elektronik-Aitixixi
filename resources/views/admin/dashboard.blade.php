@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">  <!-- table produk -->
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"><strong>Produk</strong></h4>
          <div class="card-tools">
            <a href="/produk" class="btn btn-sm btn-danger">
              More
            </a>
          </div>
        </div>
        <div class="card-body">
          <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <p align="center"><p align="center"><img src="{{ asset('foto/Merk-Laptop-Terbaik.jpg') }}" class="media-avatar rounded" width="370px" height="300px" alt="..."></p>
              </div>
              <div class="carousel-item">
                <p align="center"><p align="center"><img src="{{ asset('foto/0.88118000-1564794064-lenovo_111029_big.jpg.jpeg') }}" class="media-avatar rounded" width="370px" height="300px" alt="..."></p>
              </div>
              <div class="carousel-item">
                <p align="center"><p align="center"><img src="{{ asset('foto/Laptopmag-com.jpg') }}" class="media-avatar rounded" width="370px" height="300px" alt="..."></p>
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
    </div>
  </div>
</div>
@endsection