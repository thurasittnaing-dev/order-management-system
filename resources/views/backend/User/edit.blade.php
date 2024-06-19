@extends('layouts.modernize')

@section('title', 'User Edit')

@section('page', 'User Edit')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('Name') }}</label>

                            <div class=" ">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name', $user->name) }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>

                            <div class=" ">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email', $user->email) }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">{{ __('Phone') }}</label>

                            <div class=" ">
                                <input id="phone" type="number"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone', $user->phone) }}">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">{{ __('Role') }}</label>

                            <div class=" ">
                                <select id="role" class="form-control @error('role') is-invalid @enderror"
                                    name="role" required>
                                    <option {{ old('status', $user->role) == 'admin' ? 'selected' : '' }} value="admin">
                                        Admin</option>
                                    <option {{ old('status', $user->role) == 'waiter' ? 'selected' : '' }} value="waiter">
                                        Waiter</option>
                                    <option {{ old('status', $user->role) == 'kitchen' ? 'selected' : '' }}
                                        value="kitchen">
                                        Kitchen</option>
                                    <option {{ old('status', $user->role) == 'office' ? 'selected' : '' }} value="office">
                                        Office</option>
                                </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            <div class=" ">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password', $user->password) }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>

                            <div class=" ">
                                <input id="password-confirm" type="password" class="form-control"
                                    value="{{ old('password', $user->password) }}" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="address" class="form-label">{{ __('Address') }}</label>

                            <div class=" ">
                                <input id="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror" name="address"
                                    value="{{ old('address', $user->address) }}">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">{{ __('Status') }}</label>

                            <div class=" ">
                                <select id="status" class="form-control @error('status') is-invalid @enderror"
                                    name="status" required>
                                    <option {{ old('status', $user->status) == 'active' ? 'selected' : '' }}
                                        value="active">
                                        Active</option>
                                    <option {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}
                                        value="inactive">Inactive</option>
                                </select>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-dark me-2">Back</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')

@endsection

@section('js')

@endsection