@extends('layouts.modernize')

@section('title', 'Rooms')

@section('page', 'Rooms')

@section('content')
<div class="container-fluid">
    @php
        $name = $_GET['name'] ?? '';
        $type = $_GET['type'] ?? '';
    @endphp
    <div class="card">
        <div class="card-header">Filter</div>
        <form action="" method="GET" autocomplete="off">
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            value="{{ $name }}">
                    </div>
                    <div class="col-md-3">
                        <select id="type" class="form-control lib-s2" name="type">
                            <option value="" selected></option>
                            <option value="normal" @if ($type == 'normal') selected @endif>Normal</option>
                            <option value="family" @if ($type == 'family') selected @endif>Family</option>
                            <option value="private" @if ($type == 'private') selected @endif>Private</option>
                            <option value="vip" @if ($type == 'vip') selected @endif>Vip</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end">
                <div>
                    <a href="{{ route('room.index') }}" class="btn btn-danger">Clear</a>
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
                    <h3 class="card-title">Room</h3>
                    <p class="text-primary">Total Rooms: {{ $count }}</p>
                </div>

                <div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('room.create') }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i>Add New Room
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th style="width: 20rem">Room Name</th>
                            <th>Type</th>
                            <th>Total Tables</th>
                            <th>Service Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $key => $room)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/rooms/' . $room->image) }}" alt=""
                                            class="image-img img-thumbnail img me-4">
                                        <div class="fw-bold">
                                            {{ $room->name }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $room->type }}</td>
                                <td>
                                    <a href="{{ route('order_tables.index',['room_id'=>$room->id])}}">
                                        <span class="badge bg-primary">{{ $room->order_tables_count }}</span>
                                    </a>
                                </td>

                                <td>{{ $room->service_fee }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('room.edit', $room) }}"
                                            class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('room.destroy', $room) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td align="center" colspan="6">There is no room yet!</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
