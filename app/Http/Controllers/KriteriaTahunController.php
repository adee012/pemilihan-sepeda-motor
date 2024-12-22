<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaTahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria_tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'keterangan' => 'required|unique:kriteria_tahun',
            'nilai' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Tahun::create([
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Tahun Berhasil Ditambahkan');
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
        $tahun = Tahun::where('id', $id)->first();
        return view('admin.kriteria_tahun.update', compact('tahun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $tahun = Tahun::where('id', $request->id)->first();

        $tahun->update([
            'tahun' => $request->tahun,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Tahun Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahun = Tahun::where('id', $id)->first();

        $tahun->delete();

        return back()->with('success', 'Kriteria Tahun Berhasil Dihapus');
    }
}
