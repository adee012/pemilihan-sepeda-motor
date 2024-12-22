<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Harga;
use App\Models\Jarak;
use App\Models\Kondisi;
use App\Models\Kriteria;
use App\Models\Motor;
use App\Models\Penilaian;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function dashboard()
    {
        return view('landing.dashboard.index');
    }

    public function dataMotor(Request $request)
    {
        $filter = $request->query('filter');

        $motors = Motor::when($filter && $filter !== 'All', function ($query) use ($filter) {
            $query->where('nama_sepeda_motor', 'LIKE', "{$filter}%");
        })->get();

        $namaMotors = Motor::selectRaw("DISTINCT SUBSTRING_INDEX(nama_sepeda_motor, ' ', 1) AS nama_awal")
            ->orderBy('nama_awal')
            ->pluck('nama_awal');


        return view('landing.data-motor.index', compact('motors', 'namaMotors'));
    }

    public function aturBobot()
    {
        $kriteria = Kriteria::all();
        $totalBobot = $kriteria->sum(function ($item) {
            return (float) $item->bobot;
        });
        return view('landing.perhitungan.bobot', compact('kriteria', 'totalBobot'));
    }

    public function editBobot(string $id)
    {
        $kriteria = Kriteria::where('id', $id)->first();
        return view('landing.perhitungan.updateBobot', compact('kriteria'));
    }

    public function updateBobot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bobot' => 'required',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = Kriteria::where('id', $request->id)->first();

        $kriteria->update([
            'bobot' => $request->bobot,
        ]);

        return redirect('/pengaturan-bobot')->with('success', 'Bobot Kriteria Berhasil Diubah');
    }

    public function tambahAlternatif()
    {
        $kondisi = Kondisi::all();
        $motors = Motor::all();
        return view('landing.perhitungan.tambahAlternatif', compact('kondisi', 'motors'));
    }

    public function storeAlternatif(string $id)
    {

        $motor = Motor::find($id);
        if (!$motor) {
            return back()->with('error', 'Motor tidak ditemukan');
        }

        // Cek apakah motor sudah ada di data alternatif
        $existingAlternatif = Alternatif::where('id_motor', $motor->id)->first();
        if ($existingAlternatif) {
            return back()->with('error', 'Motor sudah ada di data alternatif dan tidak bisa ditambahkan lagi');
        }

        // Insert motor ke dalam data alternatif
        $alternatif = Alternatif::create([
            'id_motor' => $motor->id,
        ]);

        // Bandingkan kondisi motor dengan kriteria_kondisi
        $kondisi = Kondisi::where('kondisi', $motor->kondisi)->first();
        if ($kondisi) {
            Penilaian::create([
                'id_kriteria' => 2,
                'id_alternatif' => $alternatif->id,
                'nilai' => $kondisi->nilai,
            ]);
        }

        // Bandingkan harga motor dengan kriteria_harga
        $harga = Harga::get()->filter(function ($item) use ($motor) {
            $range = explode(' - ', $item->harga);
            $min_harga = intval($range[0]);
            $max_harga = intval($range[1]);

            return $motor->harga >= $min_harga && $motor->harga <= $max_harga;
        })->first();
        if ($harga) {
            Penilaian::create([
                'id_kriteria' => 1,
                'id_alternatif' => $alternatif->id,
                'nilai' => $harga->nilai,
            ]);
        }

        $jarak = Jarak::get()->filter(function ($item) use ($motor) {
            if (strpos($item->jarak, ' - ') !== false) {
                $range = explode(' - ', $item->jarak);
                $min_jarak = intval($range[0]);
                $max_jarak = intval($range[1]);

                return $motor->jarak >= $min_jarak && $motor->jarak <= $max_jarak;
            } elseif (strpos($item->jarak, '>') !== false) {
                $min_jarak = intval(trim(str_replace('>', '', $item->jarak)));

                return $motor->jarak > $min_jarak;
            }

            return false;
        })->first();

        if ($jarak) {
            Penilaian::create([
                'id_kriteria' => 4,
                'id_alternatif' => $alternatif->id,
                'nilai' => $jarak->nilai,
            ]);
        }


        // Bandingkan tahun motor dengan kriteria_tahun
        $tahun = Tahun::get()->filter(function ($item) use ($motor) {
            $range = explode(' - ', $item->tahun);
            $min_tahun = intval($range[0]);
            $max_tahun = intval($range[1]);

            return $motor->tahun >= $min_tahun && $motor->tahun <= $max_tahun;
        })->first();
        if ($tahun) {
            Penilaian::create([
                'id_kriteria' => 3,
                'id_alternatif' => $alternatif->id,
                'nilai' => $tahun->nilai,
            ]);
        }

        return back()->with('success', 'Motor berhasil ditambahkan ke alternatif');
    }

    public function destroyAlternatif(string $id)
    {
        $penilaian = Penilaian::where('id_alternatif', $id)->delete();
        $alternatif = Alternatif::where('id', $id)->first();

        $alternatif->delete();

        return back()->with('success', 'Alternatif Berhasil Dihapus');
    }

    public function truncateAlternatif()
    {
        Penilaian::truncate();

        Alternatif::query()->delete();

        return back()->with('success', 'Semua Alternatif berhasil dihapus');
    }

    public function normalisasiData($dataAlternatif, $kriteria)
    {
        $normalisasi = [];

        foreach ($kriteria as $k) {
            $maxValue = $dataAlternatif->max($k->nama_kriteria);
            $minValue = $dataAlternatif->min($k->nama_kriteria);

            foreach ($dataAlternatif as $alt) {
                $nilai = $alt->{$k->nama_kriteria};

                $normalisasi[$alt->id][$k->id] = ($maxValue - $nilai) / ($maxValue - $minValue);
            }
        }

        return $normalisasi;
    }

    // logic Perhitungan
    public function perhitungan()
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

        return view('landing.perhitungan.index', compact('alternatif', 'normalisasi', 'kriteria', 'penilaian', 'nilaiS', 'nilaiR', 'minMaxValues', 'nilaiQ'));
    }

    // tes
    public function storeAlternatifs(Request $request)
    {
        $motorIds = $request->input('motor_ids', []);

        if (empty($motorIds)) {
            return back()->with('error', 'Tidak ada motor yang dipilih.');
        }

        foreach ($motorIds as $id) {
            $motor = Motor::find($id);
            if (!$motor) {
                continue; // Jika motor tidak ditemukan, lewati
            }

            // Cek apakah motor sudah ada di data alternatif
            $existingAlternatif = Alternatif::where('id_motor', $motor->id)->first();
            if ($existingAlternatif) {
                continue; // Jika sudah ada, lewati
            }

            // Insert motor ke dalam data alternatif
            $alternatif = Alternatif::create([
                'id_motor' => $motor->id,
            ]);

            // Tambahkan penilaian untuk setiap kriteria
            $this->createPenilaian($motor, $alternatif->id);
        }

        return redirect('perhitungan')->with('success', 'Motor yang dipilih berhasil ditambahkan ke alternatif.');
    }

    // Fungsi untuk menambahkan data penilaian berdasarkan kriteria
    private function createPenilaian($motor, $alternatifId)
    {
        // Bandingkan kondisi motor dengan kriteria_kondisi
        $kondisi = Kondisi::where('kondisi', $motor->kondisi)->first();
        if ($kondisi) {
            Penilaian::create([
                'id_kriteria' => 2,
                'id_alternatif' => $alternatifId,
                'nilai' => $kondisi->nilai,
            ]);
        }

        // Bandingkan harga motor dengan kriteria_harga
        $harga = Harga::get()->filter(function ($item) use ($motor) {
            $range = explode(' - ', $item->harga);
            $min_harga = intval($range[0]);
            $max_harga = intval($range[1]);

            return $motor->harga >= $min_harga && $motor->harga <= $max_harga;
        })->first();
        if ($harga) {
            Penilaian::create([
                'id_kriteria' => 1,
                'id_alternatif' => $alternatifId,
                'nilai' => $harga->nilai,
            ]);
        }

        // Bandingkan jarak motor dengan kriteria_jarak
        $jarak = Jarak::get()->filter(function ($item) use ($motor) {
            if (strpos($item->jarak, ' - ') !== false) {
                $range = explode(' - ', $item->jarak);
                $min_jarak = intval($range[0]);
                $max_jarak = intval($range[1]);

                return $motor->jarak >= $min_jarak && $motor->jarak <= $max_jarak;
            } elseif (strpos($item->jarak, '>') !== false) {
                $min_jarak = intval(trim(str_replace('>', '', $item->jarak)));

                return $motor->jarak > $min_jarak;
            }

            return false;
        })->first();

        if ($jarak) {
            Penilaian::create([
                'id_kriteria' => 4,
                'id_alternatif' => $alternatifId,
                'nilai' => $jarak->nilai,
            ]);
        }

        // Bandingkan tahun motor dengan kriteria_tahun
        $tahun = Tahun::get()->filter(function ($item) use ($motor) {
            $range = explode(' - ', $item->tahun);
            $min_tahun = intval($range[0]);
            $max_tahun = intval($range[1]);

            return $motor->tahun >= $min_tahun && $motor->tahun <= $max_tahun;
        })->first();
        if ($tahun) {
            Penilaian::create([
                'id_kriteria' => 3,
                'id_alternatif' => $alternatifId,
                'nilai' => $tahun->nilai,
            ]);
        }

        return Back()->with('success', 'Berhasil memilih motor');
    }
}
