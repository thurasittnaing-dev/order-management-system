<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserpasswordUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService;


    public function __construct(UserService $userService)
    {
        $this->middleware('admin');
        $this->userService = $userService;
    }

    // Display a listing of users.
    public function index()
    {
        $data = $this->userService->index();
        return view('backend.user.index', $data);
    }

    // Show the form for creating a new user.
    public function create()
    {
        return view('backend.user.create');
    }

    // Store a newly created user in storage.
    public function store(StoreUserRequest $request)

    {
        $data = $this->userService->store($request);
        return redirect()->route('user.index')->with($data['status'], $data['message']);
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    // Update the specified user in storage.
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $this->userService->update($request, $user);
        return redirect()->route('user.index')->with($data['status'], $data['message']);;
    }

    //Show change password form of current login user
    public function changePassword()
    {
        return view('backend.user.changepassword');
    }

    //Store updated value of current login user password
    public function storePassword(ChangePasswordRequest $request)
    {
        $data = $this->userService->storePassword($request);
        return redirect()->route('user.index')->with($data['status'], $data['message']);
    }

    public function storeUserpassword(UserpasswordUpdateRequest $request, $id)
    {
        $data = $this->userService->storeUserpassword($request, $id);
        return redirect()->route('user.index')->with($data['status'], $data['message']);
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        $data = $this->userService->destroy($user);
        return redirect()->route('user.index')->with($data['status'], $data['message']);
    }
}