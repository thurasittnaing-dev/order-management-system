<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = array(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('admin1234'),
                'status' => 'active',
            ],
            [
                'name' => 'Waiter',
                'email' => 'waiter@gmail.com',
                'role' => 'waiter',
                'password' => Hash::make('waiter1234'),
                'status' => 'active',
            ],
            [
                'name' => 'Office',
                'email' => 'office@gmail.com',
                'role' => 'office',
                'password' => Hash::make('office1234'),
                'status' => 'active',
            ],
            [
                'name' => 'Kitchen',
                'email' => 'kitchen@gmail.com',
                'role' => 'kitchen',
                'password' => Hash::make('kitchen1234'),
                'status' => 'active',
            ]
        );

        foreach($data as $user) User::create($user);
    }
}
