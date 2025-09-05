<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\{Action, Menu};
use App\Services\TypesenseService;

class TypesenseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'typesense:sync';
   
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Menu & Action Model to Typesense';

    /**
     * Execute the console command.
     */
    public function handle(TypesenseService $typesense)
    {
        foreach (Menu::all() as $menu) {
            $typesense->addDocument('menus', [
                'id' => (string) $menu->id,
                'name' => $menu->name,
                'code' => $menu->code,
            ]);
        }

        foreach (Action::all() as $menu) {
            $typesense->addDocument('actions', [
                'id' => (string) $menu->id,
                'name' => $menu->name,
                'code' => $menu->code,
            ]);
        }

        $this->info('Data synced to Typesense!');

    }
}
