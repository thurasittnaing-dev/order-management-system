@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')


@section('content')
    <div class="container mt-5">

        <div>
            <a href="{{ route('order_tables.index') }}" class="btn btn-sm btn-primary">Go Back</a>
        </div>

        <div class="card p-3 mt-3">
            <h4>Create New Tables</h4>

            <form action="{{ route('order_tables.store') }}" method="POST">
                @csrf

                <div class="mb-2">
                    <label for="" class="mb-2">Max_person</label>
                    <input type="text" name="max_person" class="form-control @error('max_person') is-invalid  @enderror" value="{{old('max_person')}}">

                @error('max_person')
                <div class="text-danger">{{ $message }}</div>
            @enderror
                </div>
                <div class="mb-2">
                    <label for="" class="mb-2">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid  @enderror">
                        <option value="">--Select--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>


    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection



