<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Action;


class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Action::insert([
            ['code' => 'view',   'name' => 'View'],
            ['code' => 'create', 'name' => 'Create'],
            ['code' => 'update', 'name' => 'Update'],
            ['code' => 'delete', 'name' => 'Delete'],
            ['code' => 'manage', 'name' => 'Manage'],
            
        ]);
    }
}
