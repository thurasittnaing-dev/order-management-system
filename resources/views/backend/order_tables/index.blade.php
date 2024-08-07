@extends('layouts.modernize')

@section('title', 'Main Dashboard')

@section('page', 'Table')

@section('content')
    <div class="container-fluid">
        @php
            $table_no = $_GET['table_no'] ?? '';
            $status = $_GET['status'] ?? '';
            $max_person = $_GET['max_person'] ?? '';
            $room = $_GET['room'] ?? '';
            $in_used = $_GET['in_used'] ?? '';

        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">

                    <div class="row">
                        <div class="mb-3 col-md-2">
                            <input type="text" name="table_no" class="form-control" placeholder="Table No"
                                value="{{ $table_no }}">
                        </div>

                        <div class="col-md-2">
                            <select id="max person" class="form-control lib-s2" name="max person">
                                <option value="">Max Person</option>
                                @foreach ($maxPersons as $max_person)
                                    <option value="{{ $max_person }}" @if (request('max_person') == $max_person) selected @endif>
                                        {{ $max_person }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select id="status" class="form-control lib-s2" name="status">
                                <option value="" selected>Status</option>
                                <option value="1" @if ($status == '1') selected @endif>Active</option>
                                <option value="0" @if ($status == '0') selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-2">
                            <select id="room" class="form-control lib-s2" name="room">
                                <option value=" ">Room</option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" @if (request('room') == $room->id) selected @endif>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select id="in_used" class="form-control lib-s2" name="in_used">
                                <option value="" selected>In Used</option>
                                <option value="0" @if ($in_used == '0') selected @endif>No</option>
                                <option value="1" @if ($in_used == '1') selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('order_tables.index') }}" class="btn btn-danger">Clear</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-search me-1"></i>Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title">Order Tables</h3>
                        <p class="text-primary">Total Tables: {{ $count }}</p>
                    </div>

                    <div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('order_tables.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i>
                                Add
                                New Table</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Table No</th>
                                <th scope="col">Max person</th>
                                <th scope="col">Status</th>
                                <th scope="col">Room</th>
                                <th scope="col">In Used</th>
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
                                    <td>{{ $order_table->room->name }}</td>
                                    <td>
                                        @if ($order_table->in_used)
                                            <span class="text-success">Yes</span>
                                        @else
                                            <span class="text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>{{ $order_table->created_at->format('d/m/Y') }}</td>
                                    <td align="center">
                                        <div class="d-flex justify-content-center">

                                            <a href="{{ route('order_tables.edit', ['order_table' => $order_table]) }}"
                                                class="btn btn-sm btn-warning me-1">Edit</a>
                                            <form
                                                action="{{ route('order_tables.destroy', ['order_table' => $order_table]) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')

                                                <button type="submit"
                                                    onClick="return confirm('Are you sure?')"class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td align="center" colspan="8">There is no tables yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
                {{ $order_tables->links() }}
            </div>
        </div>
    </div>


@endsection

@section('css')

@endsection

@section('js')
@endsection
