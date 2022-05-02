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
            <h1 class="h2">Create new Discount</h1>
        </div>
        
        <div class="col-lg-8">
          <form method="post" action="/admin/discount/{{ $discount->id }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" value="{{ $discount->id }}" name="discount_id">
            <div class="mb-3">
              <label for="product_name" class="form-label">Product</label>
              <select class="form-select @error('product_name') is-invalid @enderror" id="product_name" name="product_id" aria-label="Default select example" value="{{ old('product_name', $discount->product->product_name) }}">
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option> 
                @endforeach
              </select>
              @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>  
            <div class="mb-3">
              <label for="discount" class="form-label">Discount %</label>
              <input placeholder="" type="text" class="form-control @error('discount') is-invalid @enderror" id="discount" name="percentage" value="{{ old('percentage', $discount->percentage) }}">
              @error('discount')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="start" class="form-label">Start</label>
              <input placeholder="" type="date" class="form-control @error('start') is-invalid @enderror" id="start" name="start" value="{{ old('start') }}">
              @error('start')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="end" class="form-label">End</label>
              <input placeholder="" type="date" class="form-control @error('end') is-invalid @enderror" id="end" name="end" value="{{ old('end') }}">
              @error('end')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-3">Create Discount</button>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection