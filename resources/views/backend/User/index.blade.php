@extends('layouts.modernize')

@section('title', 'User')

@section('page', 'User')

@section('content')
    <div>

        <div class="container">
            <div class="d-flex justify-content-end">
                <a href="{{route('user.create')}}" class="btn btn-primary">Create New User</a>
            </div>
            @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endif
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                    <p>Total Users: {{ $totalUsers }}</p>
                </div>
                <div class="card-body p-0">
                   <div class="table-responsive">
                    <table class="table table-sm table-bordered text-center mb-0">
                        <thead>
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
                                <td>{{++$i}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('user.show',$user) }}" class="btn btn-sm btn-primary me-1">Details</a>
                                        <a href="{{route('user.edit', $user)}}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{route('user.destroy', $user)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onClick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection
