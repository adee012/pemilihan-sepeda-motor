<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'kriteria_harga';

    protected $fillable = [
        'harga',
        'keterangan',
        'nilai'
    ];
}
