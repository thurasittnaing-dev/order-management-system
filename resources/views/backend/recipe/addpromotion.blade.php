@extends('layouts.modernize')

@section('title', 'Add Promotion')

@section('page', 'Add Promotion')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Promotion</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('recipe.storepromotion',$recipe->id) }}" method="POST" autocomplete="off">
                @csrf

                <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="discount" class="form-label fw-bold">Discount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control num-only @error('discount') is-invalid @enderror" id="discount"
                                name="discount" value="{{ old('discount') }}">
                            @error('discount')
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

