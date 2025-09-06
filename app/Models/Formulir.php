<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    protected $table = 'formulir';

    protected $fillable = [
        'judul',
        'jumlah_pertanyaan',
        'usia_min',
        'usia_max',
        'deskripsi',
        'status',
    ];

   
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'formulir_id');
    }
}
