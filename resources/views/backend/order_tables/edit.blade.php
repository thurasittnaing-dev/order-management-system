@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'TableEdit')


@section('content')
    <style>
        .required-star {
            color: red;
        }
    </style>
    <div class="container mt-5">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Order Table</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('order_tables.update', $order_table) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="" class="mb-2">Table no<span class="required-star">*</span></label>
                        <input type="text" name="table no" class="form-control" value="{{ $order_table->table_no }}"
                            placeholder="" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="mb-2">Max_person <span class="required-star">*</span></label>
                        <input type="text" name="max_person"
                            class="form-control num-only @error('max_person') is-invalid  @enderror"
                            value="{{ old('max_person', $order_table->max_person) }}">
                        @error('max_person')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">
                        <label for="" class="mb-2">Status<span class="required-star">*</span></label>
                        <select name="status" id="" class="form-control">
                            <option {{ $order_table->active == true ? 'selected' : '' }} value="1">Active</option>
                            <option {{ $order_table->active == false ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('order_tables.index') }}" class="btn btn-outline-dark me-2">Back</a>
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
