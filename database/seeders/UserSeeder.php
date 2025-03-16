<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin name',
            'email' => 'manager@account.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        User::create([
            'name' => 'user name',
            'email' => 'user@account.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
