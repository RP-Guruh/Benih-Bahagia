<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'formulir_id',
        'nomor',
        'teks',
        'kategori',
        'tipe_jawaban',
        'petunjuk_gambar',
        'bobot_nilai'
    ];

    public function formulir()
    {
        return $this->belongsTo(Formulir::class, 'formulir_id');
    }
}
