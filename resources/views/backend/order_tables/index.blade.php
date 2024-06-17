@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')

@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-end">
        <a href="{{route ('order_tables.create') }}" class="btn my-2 btn-sm btn-primary">Create New Order_Tables</a>
    </div>
    <div>
        <form action="">
            @php
                $keyword = $_GET['keyword'] ?? '';
            @endphp
            <div class="mb-3 col-md-3">
                <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{ $keyword }}">
            </div>
        </form>
    </div>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Table_No</th>
                <th scope="col">Max person</th>
                <th scope="col">Status</th>
                <th scope="col">Created at</th>
                <th scope="col">
                    <center>Action</center>
                </th>
            </tr>
        </thead>
        <tbody>

            @forelse ($order_tables as $key => $order_table)
                <tr>
                    <td>{{ ++$i }}.</td>

                    <td>{{ $order_table->table_no }}</td>
                    <td>{{ $order_table->max_person }}</td>
                    <td>
                        @if ($order_table->active)
                            <span class="text-success">Active</span>
                        @else
                            <span class="text-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $order_table->created_at }}</td>
                    <td align="center">
                        <div class="d-flex justify-content-center">

                            <a href="{{ route('order_tables.edit', [$order_table->id]) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                            <form action="{{ route('order_tables.destroy', $order_table->id) }}" method="POST">
                                @csrf
                                @method('delete')

                                <button type="submit" onClick="return confirm('Are you sure?')"class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td align="center" colspan="6">There is no major yet!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $order_tables->links() }}

</div>


@endsection

@section('css')

@endsection

@section('js')

@endsection




