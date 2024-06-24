@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'IngredientEdit')


@section('content')

    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Ingredient</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('ingredient.update', $ingredient) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label fw-bold">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $ingredient->name) }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('ingredient.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
