<!-- Modal -->
<div class="modal fade" id="changePasswordModal{{ $user->id }}" tabindex="-1" value="{{ $user->id }}"
    aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password for {{ $user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action=" {{ route('user.storeuserpassword', $user->id) }}" method="POST" autocomplete="off"
                id="change-pw-form-{{ $user->id }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="mb-2">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="pwd-{{ $user->id }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="mb-2">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="cpwd-{{ $user->id }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex">
                        <a href="{{ route('user.index') }}" class="btn btn-outline-dark me-2">Back</a>
                        <button type="button" data-id="{{ $user->id }}" class="btn btn-success change-pw-btn">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
