<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Felix Salcher',
            'email' => 'felix.salcher@gmail.com',
            'password' => 'password'
        ]);

        User::factory()->create([
            'name' => 'Lorenz Alber',
            'email' => 'lorenz.alber@gmail.com',
            'password' => 'password'
        ]);

        User::factory(10)->create();
    }
}
