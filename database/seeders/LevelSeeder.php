<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $dev = Level::firstOrCreate(
            ['name' => 'Dev'],
            ['description' => 'Developer level with full access', 'created_by' => 1]
        );

        return $dev->id;
    }
}
