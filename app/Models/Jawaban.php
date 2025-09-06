<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawbaan';

    protected $fillable = [
        'nilai_min',
        'nilai_max',
        'interpretasi',
        'intervensi',
    ];

}
