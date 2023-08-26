<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    protected array $users = [
        [
            'username'  => 'SuperAdmin',
            'email'     => 'admin@gym.com',
            'password'  => 'Admin123!',
            'role'      => 'Super Admin',
        ],
        [
            'username'  => 'testClient',
            'email'     => 'Customer@gym.com',
            'password'  => 'Customer1!',
            'role'      => 'Customer',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $user) {
            $newUser = User::updateOrCreate(
                [   'email' => $user['email']   ],
                [
                    'username' => $user['username'],
                    'password' => Hash::make($user['password']),
                ]
            );

            $newUser->markEmailAsVerified();
            $newUser->assignRole($user['role']);
        }
    }
}
