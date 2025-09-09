<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSkrinning extends Model
{
    use HasFactory;

    protected $table = 'hasil_skrining';

    protected $fillable = [
        'nama_siswa',
        'nama_orangtua',
        'tanggal_lahir',
        'formulir_id',
        'usia_aktual',
        'usia_pembulatan',
        'jawaban',         
        'total_ya',
        'total_tidak',
        'total_skor',
        'jawaban_id',    
        'user_id'   
    ];

    protected $casts = [
        'jawaban' => 'array',   
    ];

    /**
     * Relasi ke siswa
     */


    /**
     * Relasi ke formulir
     */
    public function formulir()
    {
        return $this->belongsTo(Formulir::class);
    }

    /**
     * Relasi ke tabel jawaban evaluasi (misalnya hasil interpretasi)
     */
    public function evaluasi()
    {
        return $this->belongsTo(Jawaban::class, 'jawaban_id');
    }
}
