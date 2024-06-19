@extends('layouts.modernize')

@section('title', 'Categories')

@section('page', 'Categories')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label fw-bold">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $category->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="file" class="form-label fw-bold">Image<span style="color: red;">*</span></label>
                            <div class="">
                                <input type="file" name="file" id="file"
                                    class="form-control-file @error('file') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                                    <span class="">
                                        <img src="{{ asset('storage/categories/' . $category->image) }}" class="image-img"
                                            alt="">
                                    </span>
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold">Type<span style="color: red;">*</span></label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="drink" name="type" value="drink" {{ $category->type == 'drink' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="drink">Drink</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="food" name="type" value="food" {{ $category->type == 'food' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="food">Food</label>
                                </div>
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="row">
                            <div class="d-flex">
                                <a href="{{ route('category.index') }}" class="btn btn-outline-dark me-2">Back</a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
