@extends('layouts.dashboard')
@section('content')


<div class="container-fluid">
<div class="row">
  <div class="col">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title"><strong>Add new image</strong></h4>
              <div class="card-tools">
                  {{-- <a href="/produk" class="btn btn-sm btn-danger">
        More
      </a> --}}
              </div>
          </div>
          <div class="container-fluid">
            <div class="table-responsive col-lg-8">
                <form method="post" action="/admin/images/{{ $image->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                        <input type="hidden" name="product_id" value="{{ $image->product->id }}">
                        <h1 class="h3">Previous</h1>
                        <img src="{{ asset('storage/' . $image->image_name) }}" class="slider-img mb-3">
                        <h1 class="h3">Update</h1>
                        <img class="img-preview img-fluid">
                        <input class="form-control" name="image_name" type="file" class="form-control @error('image_name') is-invalid @enderror" id="image_name" onchange="previewImage()">
                        @error('image_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      <button type="submit" class="btn btn-primary mb-3">Update image</button>
                </form>
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

