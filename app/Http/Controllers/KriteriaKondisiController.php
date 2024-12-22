<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaKondisiController extends Controller
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
        return view('admin.kriteria_kondisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kondisi' => 'required|unique:kriteria_kondisi',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Kondisi::create([
            'kondisi' => $request->kondisi,
            'keterangan' => $request->kondisi,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Kondisi Berhasil Ditambahkan');
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
        $kondisi = Kondisi::where('id', $id)->first();
        return view('admin.kriteria_kondisi.update', compact('kondisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kondisi' => 'required',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $kondisi = Kondisi::where('id', $request->id)->first();

        $kondisi->update([
            'kondisi' => $request->kondisi,
            'keterangan' => $request->kondisi,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Kondisi Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kondisi = Kondisi::where('id', $id)->first();

        $kondisi->delete();

        return back()->with('success', 'Kriteria Kondisi Berhasil Dihapus');
    }
}
