<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Customer',
            'last_name' => '01',
            'username' => 'customer1',
            'email' => 'customer1@gmail.com',
            'password' => 'password',
            'role' => 'pelanggan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Customer',
            'last_name' => '02',
            'username' => 'customer2',
            'email' => 'customer2@gmail.com',
            'password' => 'password',
            'role' => 'pelanggan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
