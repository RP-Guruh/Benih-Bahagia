<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Menu extends Model
{
    use LogsActivity;

    protected $table = 'menus';
    protected $fillable = ['code','name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Menus')
            ->logOnly(['id', 'code', 'name'])
            ->setDescriptionForEvent(fn(string $eventName) => "Model Menu telah di {$eventName}");
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'user_menu_actions')
                    ->withPivot('user_id');
    }


}
