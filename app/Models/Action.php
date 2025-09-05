<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $fillable = ['code','name'];

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'user_menu_actions')
                    ->withPivot('user_id');
    }
}

