<?php

namespace App\Http\Controllers;

use App\Models\Jarak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaJarakController extends Controller
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
        return view('admin.kriteria_jarak.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jarak' => 'required',
            'keterangan' => 'required|unique:kriteria_jarak',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Jarak::create([
            'jarak' => $request->jarak,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Jarak Berhasil Ditambahkan');
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
        $jarak = Jarak::where('id', $id)->first();
        return view('admin.kriteria_jarak.update', compact('jarak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jarak' => 'required',
            'keterangan' => 'required',
            'nilai' => 'required|numeric',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $jarak = Jarak::where('id', $request->id)->first();

        $jarak->update([
            'jarak' => $request->jarak,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect('/kriteria')->with('success', 'Kriteria Jarak Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jarak = Jarak::where('id', $id)->first();

        $jarak->delete();

        return back()->with('success', 'Kriteria Jarak Berhasil Dihapus');
    }
}
