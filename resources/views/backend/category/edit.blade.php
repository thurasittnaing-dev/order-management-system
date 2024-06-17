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
    <div class="mb-3">
        <a href="{{route('category.index')}}" class="btn btn-primary">Go back</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
        </div>
        <div class="card-body">
            <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"  value="{{old('name',$category->name)}}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label fw-bold">Image</label>
                    <div class="">
                        <input type="file" name="file" id="file" class="form-control-file @error('file') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="">
                            <img src="{{ asset('storage/categories/' . $category->image) }}" class="category-img" alt="">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label fw-bold">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="" disabled selected>Select type</option>
                        <option {{$category->type=='drink' ? 'selected' : ''}} value="drink">Drink</option>
                        <option {{$category->type=='food' ? 'selected' : ''}} value="food">Food</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{old('description',$category->description)}}</textarea>
                </div>
                <button type="submit" class="btn btn-success ">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('js')

@endsection





