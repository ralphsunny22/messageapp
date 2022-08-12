<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'phone_number' => '08066216874',
            'password' => Hash::make('Abstract9@'),
            'status' => 'active',
            'isAdmin' => true,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'phone_number' => '08031423346',
            'password' => Hash::make('Abstract9@'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Active User',
            'email' => 'active@user.com',
            'phone_number' => '08041433545',
            'password' => Hash::make('Abstract9@'),
        ]);
    }
}
