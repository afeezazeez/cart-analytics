<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'uuid' => Str::uuid(),
            'name' => 'Afeez Azeez',
            'email' => 'azeezafeez212@gmail.com',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}
