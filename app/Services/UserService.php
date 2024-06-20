<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
  public function index()
  {
    $query = User::query()
      ->when(request('name'), fn ($q) =>  $q->where('name', 'LIKE', '%' . request('name') . '%'))
      ->when(request('email'), fn ($q) =>  $q->where('email', 'LIKE', '%' . request('email') . '%'))
      ->when(request('role'), fn ($q) =>  $q->where('role', request('role')))
      ->when(request('phone'), fn ($q) =>  $q->where('phone', request('phone')))
      ->when(request('status'), fn ($q) =>  $q->where('status', request('status')));

    return [
      'i' => getTableIndexer(10),
      'users' => $query->orderBy('created_at', 'desc')->paginate(10),
      'totalUsers' => $query->count(),
    ];
  }

  public function store($request)
  {
    try {
      $validatedData = $request->validated();
      $validatedData['password'] = Hash::make($validatedData['password']);
      User::create($validatedData);

      return [
        'status' => 'success',
        'message' => 'User Created Success',
      ];
    } catch (\Exception $e) {

      // dd($e->getMessage());
      return [
        'status' => 'error',
        'message' => 'Something went wrong.',
      ];
    }
  }
}
