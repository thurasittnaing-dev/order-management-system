@extends('layouts.modernize')

@section('title', 'Categories')

@section('page', 'Categories')

@section('content')

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .table {
        margin: 0;
    }
    .table thead th {
        background-color: #0d6efd;
        color: white;
    }
    .btn-primary {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    .category-img {
        width: 3rem;
        height: 3rem;
        object-fit: cover;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('category.create')}}" class="btn btn-primary">Create New Category</a>
    </div>
    @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif

    <div>
        <form action="">
            @php
                $keyword = $_GET['keyword'] ?? '';
            @endphp
            <div class="mb-3 col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{ $keyword }}">
            </div>
        </form>
        <p>
            Total Categories = {{$count}}
        </p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category</h3>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-center mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $key => $category)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$category->name}}</td>
                            <td>
                                <img src="{{asset('storage/categories/'. $category->image)}}" alt="" class="category-img">
                            </td>
                            <td>{{$category->type}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('category.edit', $category)}}" class="btn btn-sm btn-warning me-1">Edit</a>
                                    <form action="{{route('category.destroy', $category)}}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no category yet!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.min.js"></script>
@endsection

@section('css')

@endsection

@section('js')

@endsection






