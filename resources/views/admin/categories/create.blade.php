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
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom col-lg-8">
            <h1 class="h2">Create new Category</h1>
        </div>
        
        <div class="col-lg-8">
          <form method="post" action="/admin/category" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="category_name" class="form-label">Category name</label>
              <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" autofocus value="{{ old('category_name') }}">
              @error('category_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>  
            <button type="submit" class="btn btn-primary mb-3">Create Category</button>
          </form>
        </div>
        

        </div>

      </div>
    </div>
  </div>
</div>
@endsection