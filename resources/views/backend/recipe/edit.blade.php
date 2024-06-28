@extends('layouts.modernize')

@section('title', 'Recipe Edit')

@section('page', 'Recipe Edit')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Recipe</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('recipe.update', $recipe) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $recipe->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="file" class="form-label fw-bold">Image<span class="text-danger">*</span></label>
                        <div class="">
                            <input type="file" name="file" id="file"
                                class="form-control-file @error('file') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                                <span class="">
                                    <img src="{{ asset('storage/recipes/' . $recipe->image) }}" class="image-img"
                                        alt="">
                                </span>
                            @error('file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ old('description', $recipe->description ) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Category<span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control lib-s2 @error('category_id') is-invalid  @enderror">
                            <option value="">--Select--</option>
                            @foreach ($categories as $category)
                                <option @if (old('category_id', $recipe->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ingredients" class="form-label fw-bold">Ingredients<span class="text-danger">*</span></label>
                        <select name="ingredients[]" id="ingredients" multiple class="form-control lib-s2-multiple @error('ingredients') is-invalid @enderror">
                            <option value="">--Select--</option>
                            @foreach ($ingredients as $ingredient)
                                <option  value="{{ $ingredient->id }}"
                                    @if (is_array(old('ingredients', $recipe->ingredients->pluck('id')->toArray())) && in_array($ingredient->id, old('ingredients', $recipe->ingredients->pluck('id')->toArray()))) selected @endif>
                                    {{ $ingredient->name }}</option>
                            @endforeach
                        </select>
                        @error('ingredients')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="amount" class="form-label fw-bold">Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control num-only @error('amount') is-invalid  @enderror" id="amount"
                            name="amount" value="{{ old('amount', $recipe->amount ) }}">
                        @error('amount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-bold">Status<span class="text-danger">*</span></label>
                        <select class="form-control lib-s2 @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="" selected></option>
                            <option value="active" {{ old('status', $recipe->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $recipe->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="d-flex">
                        <a href="{{ route('recipe.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
