@extends('layouts.modernize')

@section('title', 'Change Password')

@section('page', ' Change Password')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.storepassword') }} " method="POST" autocomplete="off">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>

                            <div class=" ">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label">Confirm Password<span class="text-danger">*</span></label>

                            <div class=" ">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex">
                            <a href="{{ route('user.index') }}" class="btn btn-outline-dark me-2">Back</a>
                            <button type="submit" class="btn btn-success">
                                {{ __('Submit') }}
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
