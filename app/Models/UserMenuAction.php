<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuAction extends Model
{
    protected $fillable = ['user_id','menu_id','action_id'];

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function action() {
        return $this->belongsTo(Action::class);
    }
}
