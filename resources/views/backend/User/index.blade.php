@extends('layouts.modernize')

@section('title', 'User')

@section('page', 'User')

@section('content')
    <div class="container-fluid">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @php
            $name = $_GET['name'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body">
                    <div class="mb-3 col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            value="{{ $name }}">
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div>
                        <a href="{{ route('user.index') }}" class="btn btn-danger">Clear</a>
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
                        <h3 class="card-title">User</h3>
                        <p class="text-primary">Total Users: {{ $totalUsers }}</p>
                    </div>

                    <div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="ti ti-plus"></i> Add
                                New
                                User</a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('user.show', $user) }}"
                                                class="btn btn-sm btn-primary me-1">Details</a>
                                            <a href="{{ route('user.edit', $user) }}"
                                                class="btn btn-sm btn-warning me-1">Edit</a>
                                            <form action="{{ route('user.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onClick="return confirm('Are you sure?')"
                                                    class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer justify-content-center d-flex align-items-center py-3 px-1">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
