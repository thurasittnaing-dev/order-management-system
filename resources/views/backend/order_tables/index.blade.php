@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Main Dashboard')

@section('content')

<div class="container-fluid">

   <div class="d-flex justify-content-between align-items-center">
    <div class="col-md-4">
        <form action="" autocomplete="off">
            @php
                $keyword = $_GET['keyword'] ?? '';
            @endphp
            <div class="mb-3">
                <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{ $keyword }}">
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{route ('order_tables.create') }}" class="btn my-2 btn-primary">Create New Table</a>
    </div>
   </div>

   <div class="my-2">Total {{$count}}</div>

    <div class="table-responsive">
        <table class="table table-sm">
            <thead class="thead bg-primary text-light">
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

                @forelse ($order_tables as $key =>  $order_table)
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
    </div>
    {{ $order_tables->links() }}

</div>


@endsection

@section('css')

@endsection

@section('js')

@endsection




