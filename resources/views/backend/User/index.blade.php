@extends('layouts.modernize')

@section('title', 'User')

@section('page', 'User')

@section('content')
    <div class="container-fluid">
        @php
            $name = $_GET['name'] ?? '';
            $email = $_GET['email'] ?? '';
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
                        <select id="role" class="form-control lib-s2" name="role">
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
                        <select id="status" class="form-control lib-s2" name="status">
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
                    <table class="table table-bordered mb-0">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucfirst($user->role )}}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @if ($user->status == 'active')
                                            <span class=" text-success">Active</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td align="centers">
                                        <div class="d-flex justify-content-center">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                  Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton{{ $user->id }}">
                                                    <!-- Button trigger modal -->
                                                    <li class="mt-2"><button type="button" class="dropdown-item text-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#changePasswordModal{{ $user->id }}">
                                                        Change Password
                                                        </button>
                                                    </li>
                                                    <li class="mt-2"><a href="{{ route('user.edit', $user) }}"
                                                        class="dropdown-item text-warning">Edit</a>
                                                    </li>
                                                  <li class="mt-2">
                                                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onClick="return confirm('Are you sure?')"
                                                            class="dropdown-item text-warning">Delete</button>
                                                    </form>
                                                  </li>
                                                </ul>
                                              </div>
                                        </div>
                                    </td>
                                </tr>

                                @include('backend.user.modal')
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
    <script>
        $(document).ready(function() {
            $('.change-pw-btn').on('click', function() {
                let id = $(this).data('id');
                let pwdValue = $(`#pwd-${id}`).val();
                let cpwdValue = $(`#cpwd-${id}`).val();

                if (pwdValue == "" || cpwdValue == "") {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: "Please fill all required informations.",
                        showConfirmButton: true,
                        timer: 2000
                    });
                    return;
                }

                $(this).prop('disabled', true);
                $(this).text('Processing...');
                $(`#change-pw-form-${id}`).submit();
            });
        });
    </script>
@endsection
