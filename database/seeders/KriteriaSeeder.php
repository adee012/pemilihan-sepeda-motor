<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::create([
            'kode_kriteria' => 'C1',
            'nama_kriteria' => 'Harga',
            'bobot' => '20',
        ]);
        Kriteria::create([
            'kode_kriteria' => 'C2',
            'nama_kriteria' => 'Kondisi',
            'bobot' => '30',
        ]);
        Kriteria::create([
            'kode_kriteria' => 'C3',
            'nama_kriteria' => 'Tahun',
            'bobot' => '20',
        ]);
        Kriteria::create([
            'kode_kriteria' => 'C4',
            'nama_kriteria' => 'Jarak',
            'bobot' => '30',
        ]);
    }
}
