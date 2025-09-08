<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'teaching_place',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function menuActions()
    {
        return $this->hasManyThrough(
            \App\Models\LevelMenuAction::class,
            \App\Models\Level::class,
            'id',     
            'level_id',
            'level_id',
            'id'  
        );
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function permissions()
    {
        return $this->hasManyThrough(
            LevelMenuAction::class, 
            Level::class,          
            'id',                   // foreignKey di Level
            'level_id',             // foreignKey di LevelMenuAction
            'level_id',             // localKey di User
            'id'                    // localKey di Level
        );
    }
}
