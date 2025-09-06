<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jawaban;

class JawabanIntervensiRow extends Model
{
    use HasFactory;

    protected $table = 'jawaban_intervensi_row';

    protected $fillable = [
        'jawaban_id',
        'intervensi',
    ];

    public function jawaban()
    {
        return $this->belongsTo(Jawaban::class, 'jawaban_id');
    }

    

}
