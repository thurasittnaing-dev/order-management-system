@extends('layouts.modernize')

@section('title', 'Categories')

@section('page', 'Categories')

@section('content')
    <style>
        .category-img {
            width: 3rem;
            height: 3rem;
            object-fit: cover;
        }
    </style>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $keyword = $_GET['keyword'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="mb-3 col-md-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Name"
                            value="{{ $keyword }}">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('category.index') }}" class="btn btn-danger">Clear</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search me-1"></i>Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Category</h3>
                        <p class="text-primary">Total Categories: {{ $count }}</p>
                    </div>

                    <div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('category.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i>Add New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="">
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
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <img src="{{ asset('storage/categories/' . $category->image) }}" alt=""
                                            class="category-img">
                                    </td>
                                    <td>{{ $category->type }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('category.edit', $category) }}"
                                                class="btn btn-sm btn-warning me-1">Edit</a>
                                            <form action="{{ route('category.destroy', $category) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                </div>
            </div>
            <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
                {{ $categories->links() }}
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
