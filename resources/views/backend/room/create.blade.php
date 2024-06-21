@extends('layouts.modernize')

@section('title', 'Rooms')

@section('page', 'Rooms')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Room</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('room.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                    <select class="form-control lib-s2 @error('type') is-invalid @enderror" id="type" name="type">
                        <option value="" selected></option>
                        <option value="normal" {{ old('type') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="family" {{ old('type') == 'family' ? 'selected' : '' }}>Family</option>
                        <option value="private" {{ old('type') == 'private' ? 'selected' : '' }}>Private</option>
                        <option value="vip" {{ old('type') == 'vip' ? 'selected' : '' }}>Vip</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="service_fee" class="form-label fw-bold">Service_fee<span class="text-danger">*</span></label>
                    <input type="text" class="form-control num-only @error('service_fee') is-invalid  @enderror" id="service_fee"
                        name="service_fee" value="{{ old('service_fee') }}">
                    @error('service_fee')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="d-flex">
                        <a href="{{ route('room.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
