<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i=0; $i<10000; $i++) {
            User::insert([
                'name' => Str::random(rand(5,9)),
                'email' => Str::random(rand(10,15)).'@gmail.com',
                'type' => Arr::random(User::USER_TYPES['clients']),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
