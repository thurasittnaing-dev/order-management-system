@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'IngredientCreate')


@section('content')

    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create New Ingredient</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ingredient.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="" class="mb-2">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name"
                                class="form-control  @error('ingredient') is-invalid  @enderror"
                                value="{{ old('ingredient') }}">
                            @error('ingredient')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

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
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('ingredient.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
