@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')


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
                            <label for="" class="mb-2">Max_person</label>
                            <input type="text" name="max_person"
                                class="form-control @error('max_person') is-invalid  @enderror"
                                value="{{ old('max_person') }}">

                            @error('max_person')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="mb-2">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid  @enderror">
                                <option value="">--Select--</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
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
