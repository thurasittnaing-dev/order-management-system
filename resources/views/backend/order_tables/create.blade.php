@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'TableCreate')


@section('content')

    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create New Table</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('order_tables.store') }}" method="POST" autocomplete="off">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="" class="mb-2">Max_person <span class="text-danger">*</span></label>
                            <input type="text" name="max_person"
                                class="form-control num-only @error('max_person') is-invalid  @enderror"
                                value="{{ old('max_person') }}">
                            @error('max_person')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="col-md-6">
                            <label for="" class="mb-2">Status<span class="text-danger">*</span></label>
                            <select name="status" id="status"
                                class="form-control lib-s2 @error('status') is-invalid  @enderror">
                                <option value="">--Select--</option>
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="room" class="mb-2">Room<span class="text-danger">*</span></label>
                            <select name="room" id="room" class="form-control @error('room') is-invalid  @enderror">
                                <option value="">--Select--</option>
                                @foreach ($rooms as $room)
                                    <option @if (old('room') == $room->id) selected @endif value="{{ $room->id }}">
                                        {{ $room->name }}</option>
                                @endforeach
                            </select>
                            @error('room')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="in_used" class="mb-2">In_Used<span class="text-danger">*</span></label>
                            <select name="in_used" id="in_used"
                                class="form-control lib-s2 @error('in_used') is-invalid  @enderror">
                                <option value="">--Select--</option>
                                <option value="0" {{ old('in_used', '0') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('in_used') == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('in_used')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('order_tables.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
