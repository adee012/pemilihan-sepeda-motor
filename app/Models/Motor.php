<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $table = 'data_motor';

    protected $fillable = [
        'nama_sepeda_motor',
        'harga',
        'jarak',
        'kondisi',
        'tahun',
        'gambar',
        'spesifikasi'
    ];
}
