<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'firstname' => 'Test',
            'lastname' => 'Admin',
            'email' => 'admin@example.com',
            'midname' => 'AdminTest',
            'dob' => '1997-07-09',
            'street' => 'street',
            'city' => 'city',
            'state' => 'state',
            'gender' => 'm',
            'image' => null,
            'phone' => 992309334,
            'role' => 'admin',
            'status' => 'status',
            'password' => Hash::make(123456)
            ]);
    }
}
