<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePDF()
    {
        $alternatif = Alternatif::with(['motor', 'penilaian.kriteria'])->get();
        $kriteria = Kriteria::all();
        $penilaian = Penilaian::with('alternatif', 'kriteria')->get();

        $hasil = $this->hitungVIKOR($alternatif, $kriteria, $penilaian);

        $pdf = Pdf::loadView('landing.pdf.hasilPerhitungan', $hasil);

        return $pdf->download('hasil_perhitungan.pdf');
    }

    private function hitungVIKOR($alternatif, $kriteria, $penilaian)
    {
        $penilaian = Penilaian::with('alternatif', 'kriteria')->get();
        $alternatif = Alternatif::with(['motor', 'penilaian.kriteria'])->get();
        $kriteria = Kriteria::all();

        // Normalisasi
        $normalisasi = [];

        foreach ($kriteria as $k) {
            $maxValue = Penilaian::where('id_kriteria', $k->id)->get()->map(function ($item) {
                return floatval($item->nilai);
            })->max();

            $minValue = Penilaian::where('id_kriteria', $k->id)->get()->map(function ($item) {
                return floatval($item->nilai);
            })->min();

            foreach ($alternatif as $alt) {
                $penilaian = Penilaian::where('id_kriteria', $k->id)
                    ->where('id_alternatif', $alt->id)
                    ->first();

                if ($penilaian) {
                    $nilai = floatval($penilaian->nilai);


                    if ($maxValue == $minValue) {
                        $normalisasi[$alt->id][$k->id] = 1;
                    } else {
                        $normalisasi[$alt->id][$k->id] = ($maxValue - $nilai) / ($maxValue - $minValue);
                    }
                } else {
                    $normalisasi[$alt->id][$k->id] = 'N/A';
                }
            }
        }

        // Bobot untuk dinormalisasi
        $totalBobot = $kriteria->sum('bobot');

        // Mencari Nilai S
        $nilaiS = [];
        $sMax = null;
        $sMin = null;

        foreach ($alternatif as $alt) {
            $totalS = 0;
            $detailNilai = [];

            foreach ($kriteria as $krt) {
                $nilaiPenilaian = $alt->penilaian->firstWhere('id_kriteria', $krt->id);

                $maxValue = Penilaian::where('id_kriteria', $krt->id)->max('nilai');
                $minValue = Penilaian::where('id_kriteria', $krt->id)->min('nilai');

                if ($nilaiPenilaian && $totalBobot > 0) {
                    // Normalisasi bobot
                    $bobotTernormalisasi = floatval($krt->bobot) / $totalBobot;

                    if ($maxValue == $minValue) {
                        $nilaiKriteria = $bobotTernormalisasi * 1;
                    } else {
                        $nilaiKriteria = $bobotTernormalisasi * (($maxValue - $nilaiPenilaian->nilai) / ($maxValue - $minValue));
                    }

                    $totalS += $nilaiKriteria;

                    $detailNilai[] = [
                        'kriteria' => $krt->nama_kriteria,
                        'nilai' => $nilaiPenilaian->nilai,
                        'bobot' => $bobotTernormalisasi,
                        'nilai_max' => $maxValue,
                        'nilai_min' => $minValue,
                        'nilai_kriteria' => $nilaiKriteria,
                    ];
                }
            }

            $nilaiS[] = [
                'alternatif' => $alt->motor->nama_sepeda_motor,
                'total_s' => $totalS,
                'detail' => $detailNilai,
            ];

            if ($sMax === null || $totalS > $sMax) $sMax = $totalS;
            if ($sMin === null || $totalS < $sMin) $sMin = $totalS;
        }

        // Mencari Nilai R
        $nilaiR = [];
        $rMax = null;
        $rMin = null;

        foreach ($alternatif as $alt) {
            $nilaiRAlt = [];
            $maxR = 0;

            foreach ($kriteria as $krt) {
                $nilaiPenilaian = $alt->penilaian->firstWhere('id_kriteria', $krt->id);

                $maxValue = Penilaian::where('id_kriteria', $krt->id)->max('nilai');
                $minValue = Penilaian::where('id_kriteria', $krt->id)->min('nilai');

                if ($nilaiPenilaian && $totalBobot > 0) {
                    $bobotTernormalisasi = floatval($krt->bobot) / $totalBobot;

                    if ($maxValue == $minValue) {
                        $nilaiRPerKriteria = $bobotTernormalisasi * 1;
                    } else {
                        $nilaiRPerKriteria = $bobotTernormalisasi * (($maxValue - $nilaiPenilaian->nilai) / ($maxValue - $minValue));
                    }

                    if ($nilaiRPerKriteria > $maxR) {
                        $maxR = $nilaiRPerKriteria;
                    }
                }
            }

            $nilaiR[] = [
                'alternatif' => $alt->motor->nama_sepeda_motor,
                'nilai_r' => $maxR,
            ];

            if ($rMax === null || $maxR > $rMax) $rMax = $maxR;
            if ($rMin === null || $maxR < $rMin) $rMin = $maxR;
        }

        // Menentukan Nilai Index dan Menghitung Ranking
        $v = 0.5;
        $nilaiQ = [];

        if (!empty($nilaiS) && !empty($nilaiR)) {
            foreach ($alternatif as $alt) {
                $s = $nilaiS[array_search($alt->motor->nama_sepeda_motor, array_column($nilaiS, 'alternatif'))]['total_s'];
                $r = $nilaiR[array_search($alt->motor->nama_sepeda_motor, array_column($nilaiR, 'alternatif'))]['nilai_r'];

                $q = $v * (($sMax == $sMin ? 0 : ($s - $sMin) / ($sMax - $sMin))) +
                    (1 - $v) * (($rMax == $rMin ? 0 : ($r - $rMin) / ($rMax - $rMin)));

                $nilaiQ[] = [
                    'alternatif' => $alt->motor->nama_sepeda_motor,
                    'nilai_q' => $q,
                ];
            }

            // Mengurutkan berdasarkan nilai Q
            usort($nilaiQ, function ($a, $b) {
                return $a['nilai_q'] <=> $b['nilai_q'];
            });

            // Peringkat
            foreach ($nilaiQ as $index => $item) {
                $nilaiQ[$index]['rank'] = $index + 1;
            }
        }

        //  minMaxValues
        $minMaxValues = [
            'sMax' => $sMax,
            'sMin' => $sMin,
            'rMax' => $rMax,
            'rMin' => $rMin,
        ];

        return compact('nilaiS', 'nilaiR', 'nilaiQ', 'alternatif', 'kriteria');
    }
}
