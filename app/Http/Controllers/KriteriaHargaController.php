<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Jarak;
use App\Models\Kondisi;
use App\Models\Kriteria;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaHargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $totalBobot = $kriteria->sum(function ($item) {
            return (float) $item->bobot;
        });
        $harga = Harga::all();
        $jarak = Jarak::all();
        $kondisi = Kondisi::all();
        $tahun = Tahun::all();
        return view('admin.kriteria_harga.index', compact('harga', 'jarak', 'kondisi', 'tahun', 'kriteria', 'totalBobot'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria_harga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'harga' => 'required',
            'keterangan' => 'required|unique:kriteria_harga',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Harga::create([
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Harga Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $harga = Harga::where('id', $id)->first();
        return view('admin.kriteria_harga.update',  compact('harga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'harga' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $harga = Harga::where('id', $request->id)->first();

        $harga->update([
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Harga Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $harga = Harga::where('id', $id)->first();

        $harga->delete();

        return back()->with('success', 'Kriteria Harga Berhasil Dihapus');
    }
}
