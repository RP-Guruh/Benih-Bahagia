<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $level = Level::where('name', 'Dev')->first();

        User::firstOrCreate(
            ['email' => 'dev@mail.com'],
            [
                'name' => 'Dev',
                'password' => Hash::make('password1234'),
                'level_id' => $level->id
            ]
        );
    }
}
