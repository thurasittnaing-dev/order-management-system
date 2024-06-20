<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $userService;


    public function __construct(UserService $userService)
    {
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
        $validated = $request->validated();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);
        return redirect()->route('user.index');
    }

    public function changePassword()
    {

        return view('backend.user.changepassword');
    }

    public function storePassword(ChangePasswordRequest $request, User $user)
    {
        $data = $request->validated();

        auth()->user()->update([
            'password' => Hash::make($data['password'])
        ]);
        return redirect()->route('user.index');
    }



    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
