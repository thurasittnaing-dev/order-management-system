<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Display a listing of users.
    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'asc')->get();
        $users = User::query();
        if($request->keyword){
            $users=$users->where('name', 'LIKE', '%' . $request->keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $request->keyword . '%');
        }
        $users = $users->paginate(8);
        $i=(request('page',1)-1)*8;
        $totalUsers = User::count();
        return view('backend.user.index', compact('users','i','totalUsers'));
    }

    // Show the form for creating a new user.
    public function create()
    {
        $users=User::all();
        return view('backend.user.create',compact('users'));
    }

    // Store a newly created user in storage.
    public function store(StoreUserRequest $request)
    {
        $validated=$request->validated();
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password) ,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);
        return redirect()->route('user.index');

    }

    // Display the specified user.
    public function show($id)
    {
        return view('backend.user.show',);
    }

    // Show the form for editing the specified user.
    public function edit($id)
    {
        $user=User::find($id);
        return view('backend.user.edit',compact('user'));
    }

    // Update the specified user in storage.
    public function update(UserUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password) ,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);
        return redirect()->route('user.index');
    }

    // Remove the specified user from storage.
    public function destroy(User $user)
    {
        // User::destroy($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
