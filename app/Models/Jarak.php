<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jarak extends Model
{
    use HasFactory;

    protected $table = 'kriteria_jarak';

    protected $fillable = [
        'jarak',
        'keterangan',
        'nilai'
    ];
}
