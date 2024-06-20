@extends('layouts.modernize')

@section('title', 'Categories')

@section('page', 'Categories')

@section('content')

    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            $name = $_GET['name'] ?? '';
            $type = $_GET['type'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-3">
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $name }}">
                        </div>
                        <div class="col-md-3">
                            <select id="type" class="form-control" name="type">
                                <option value="" selected>Type</option>
                                <option value="drink" @if ($type == 'drink') selected @endif>Drink</option>
                                <option value="food" @if ($type == 'food') selected @endif>Food</option>
                            </select>
                        </div>
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
                                <th style="width: 20rem">Category Name</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $category)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/categories/' . $category->image) }}" alt=""
                                                class="image-img img-thumbnail img me-4">
                                            <div class="fw-bold">
                                                {{ $category->name }}
                                            </div>
                                        </div>
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
@endsection

@section('css')

@endsection

@section('js')

@endsection
