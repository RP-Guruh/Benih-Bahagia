<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\Menu;
use App\Models\Action;
use App\Models\LevelMenuAction;

class LevelMenuActionSeeder extends Seeder
{
    public function run()
    {
        $level = Level::where('name', 'Dev')->first();
        $menu = Menu::firstOrCreate(
            ['code' => 'access/permission'],
            ['name' => 'Access Permission']
        );

        

        $actions = Action::whereIn('code', ['manage', 'view'])->get();

        foreach ($actions as $action) {
            LevelMenuAction::firstOrCreate([
                'level_id'  => $level->id,
                'menu_id'   => $menu->id,
                'action_id' => $action->id,
                'created_by' => 1,
            ]);
        }
    }
}
