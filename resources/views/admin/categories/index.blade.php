@extends('layouts.dashboard')
@section('content')

<div class="container-fluid">
    <!-- table produk -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><strong>Category Produk</strong></h4>
                </div>
                <div class="container-fluid">
                    <div class="table-responsive col-lg-auto">
                        <a href="/admin/category/create" class="btn btn-primary my-3"> Create new category</a>
                        <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <a href="/admin/category/{{ $category->id }}/edit"
                                        class="badge bg-warning nav-link">Edit</span></a>
                                    <form action="/admin/category/{{ $category->id }} }" method="post" class="d-inline">
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
