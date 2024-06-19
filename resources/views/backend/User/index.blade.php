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
            $email= $_GET['email'] ?? '';
            $role = $_GET['role'] ?? '';
            $phone = $_GET['phone'] ?? '';
            $status = $_GET['status'] ?? '';
        @endphp
        <div class="card">
            <div class="card-header">Filter</div>
            <form action="" method="GET" autocomplete="off">
                <div class="card-body row">
                    <div class="mb-3 col-md-2">
                        <input type="text" name="name" class="form-control" placeholder="Name"
                            value="{{ $name }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <input type="text" name="email" class="form-control" placeholder="Email"
                            value="{{ $email }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <select id="role" class="form-control" name="role">
                            <option value="">--Select Role--</option>
                            <option value="admin">Admin</option>
                            <option value="waiter">Waiter</option>
                            <option value="kitchen">Kitchen</option>
                            <option value="office">Office</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-2">
                        <input type="text" name="phone" class="form-control num-only" placeholder="Phone"
                            value="{{ $phone }}">
                    </div>
                    <div class="mb-3 col-md-2">
                        <select id="status" class="form-control" name="status">
                            <option value="">---Status---</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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
                                    <td>
                                        @if ( $user->status == 'active')
                                            <span class=" text-success">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>
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
                            <tr>
                                <td align="center" colspan="12">There is no user yet!</td>
                            </tr>
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
