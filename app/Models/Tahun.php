<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;

    protected $table = 'kriteria_tahun';

    protected $fillable = [
        'tahun',
        'keterangan',
        'nilai'
    ];
}
