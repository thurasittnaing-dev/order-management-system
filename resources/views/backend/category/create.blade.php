@extends('layouts.modernize')

@section('title', 'Create Category')

@section('page', 'Create Category')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Category</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label fw-bold">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="file" class="form-label fw-bold">Image<span class="text-danger">*</span></label>
                            <div class="">
                                <input type="file" name="file" id="file"
                                    class="form-control-file @error('file') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label fw-bold">Type<span class="text-danger">*</span></label>
                        <div>
                            <div class="form-check">
                                <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="drink" name="type" value="drink" {{ old('type', 'drink') == 'drink' ? 'checked' : '' }}>
                                <label class="form-check-label" for="drink">Drink</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input @error('type') is-invalid @enderror" type="radio" id="food" name="type" value="food" {{ old('type') == 'food' ? 'checked' : '' }}>
                                <label class="form-check-label" for="food">Food</label>
                            </div>
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('category.index') }}" class="btn btn-outline-dark me-2">Back</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Submit') }}
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
