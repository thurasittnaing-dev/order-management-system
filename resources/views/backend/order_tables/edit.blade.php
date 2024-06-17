@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')


@section('content')
    <div class="container mt-5">

        <div>
            <a href="{{ route('order_tables.index') }}" class="btn btn-sm btn-primary">Go Back</a>
        </div>

        <div class="card p-3 mt-3">
            <h4>Edit Tables</h4>

            <form action="{{ route('order_tables.update', $order_tables->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="" class="mb-2">Table no</label>
                    <input type="text" name="table no" class="form-control" value="{{ $order_tables->table_no}}"
                        placeholder="Order Tables">
                </div>
                <div class="form-group">
                    <label for="" class="mb-2">Max person</label>
                    <input type="text" name="max person" class="form-control" value="{{ $order_tables->max_person}}"
                        placeholder="Order Tables">
                </div>

                <div class="form-group mt-2">
                    <label for="" class="mb-2">Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{ $order_tables->active == true ? 'selected' : '' }} value="1">Active</option>
                        <option {{ $order_tables->active == false ? 'selected' : '' }} value="0">Inactive</option>
                    </select>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>


    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection




