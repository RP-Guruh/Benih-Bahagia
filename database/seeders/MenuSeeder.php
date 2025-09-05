<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            ['code' => 'settings/menu',   'name' => 'Menu'],
            ['code' => 'settings/menu_action', 'name' => 'Menu Action'],
            ['code' => 'access/level', 'name' => 'Access Level']
        ]);
    }
}
