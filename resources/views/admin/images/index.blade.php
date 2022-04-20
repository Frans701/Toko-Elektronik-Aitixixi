@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">

@if (session()->has('success'))

<div class="alert alert-success d-flex align-items-center col-lg-8" role="alert">
    <div>
      {{ session('success') }}
    </div>
  </div>
@endif

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
                <div class="table-responsive col-lg-8">
                  <form method="post" action="/admin/images" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @csrf
                    <div class="mb-3">
                      <img class="img-preview img-fluid">
                      <input class="form-control" name="image_name" type="file" class="form-control @error('image_name') is-invalid @enderror" id="image_name" onchange="previewImage()">
                      @error('image_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Add image</button>
                    <a href="/admin/products" class="btn btn-success mb-3">My product</a>
                  </form>
                  {{-- <a href="/admin/images/create/" class="btn btn-primary my-3"> Add new image</a>
                  <a href="/dashboard/blogs" class="btn btn-success my-3"> My Product</a> --}}
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Preview</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- {{ dd($categories) }} --}}
              
                      @foreach ($images as $image)
                      <tr>
                          <td class="align-middle">{{ $loop->iteration }}</td>
                          <td><img src="{{ asset('storage/' . $image->image_name) }}" class="img-index" alt=" {{ $image->image_name }}"></td>
                          <td class="align-middle">
                              <a href="/admin/images/{{ $image->id }}/edit"
                                  class="badge bg-warning nav-link">Edit</span></a>
                                <form action="/admin/images/{{ $image->id }} }" method="post" class="d-inline">
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

@section('script')

<script>
  function previewImage(){
    const image_name = document.querySelector('#image_name');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';
    imgPreview.style.width = '100%';
    imgPreview.style.height = '300px';
    imgPreview.style.objectFit = 'cover';
    imgPreview.style.marginBottom = '16px';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image_name.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>


@endsection
