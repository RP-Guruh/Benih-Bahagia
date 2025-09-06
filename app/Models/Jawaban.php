<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JawabanIntervensiRow;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';

    protected $fillable = [
        'nilai_min',
        'nilai_max',
        'interpretasi',
    ];

    public function intervensiRows()
    {
        return $this->hasMany(JawabanIntervensiRow::class, 'jawaban_id');
    }

}
