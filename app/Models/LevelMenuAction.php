<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelMenuAction extends Model
{
    protected $table = 'level_menu_action';
    protected $fillable = ['level_id','menu_id','action_id', 'created_by', 'updated_by'];

    public function level() {
        return $this->belongsTo(Level::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function action() {
        return $this->belongsTo(Action::class);
    }
}
