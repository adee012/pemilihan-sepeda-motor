<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'data_alternatif';

    protected $fillable = [
        'id_motor'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'id_motor', 'id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }
}
