<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataMotorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::all();
        return view('admin.data_motor.index', compact('motors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data_motor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sepeda_motor' => 'required',
            'harga' => 'required|numeric|min:6',
            'kondisi' => 'required',
            'jarak' => 'required|numeric|min:3',
            'tahun' => 'required|numeric',
            'spesifikasi' => 'required',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('gambar')) {
            $name = $request->file('gambar');
            $fileName = 'motor_' . time() . '.' . $name->getClientOriginalExtension();

            $path = Storage::putFileAs('public/gambar_motor', $request->file('gambar'), $fileName);

            if (!$path) {
                return back()->with('error', 'File upload failed');
            }
        }

        Motor::create([
            'nama_sepeda_motor' => $request->nama_sepeda_motor,
            'harga' => $request->harga,
            'kondisi' => $request->kondisi,
            'jarak' => $request->jarak,
            'tahun' => $request->tahun,
            'spesifikasi' => $request->spesifikasi,
            'gambar' => $fileName,
        ]);

        return redirect('/data-motor')->with('success', 'Data Motor Berhasil Ditambahkan');
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
        $motor = Motor::where('id', $id)->first();
        return view('admin.data_motor.update', compact('motor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sepeda_motor' => 'required',
            'harga' => 'required|numeric|min:6',
            'kondisi' => 'required',
            'jarak' => 'required|numeric|min:3',
            'tahun' => 'required|numeric',
            'spesifikasi' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $motor = Motor::where('id', $request->id)->first();
        if ($request->hasFile('gambar')) {
            $delete = Storage::delete('public/gambar_motor/' . $motor->gambar);

            $name = $request->file('gambar');
            $fileName = 'motor_' . time() . '.' . $name->getClientOriginalExtension();

            $path = Storage::putFileAs('public/gambar_motor', $request->file('gambar'), $fileName);

            $motor->update([
                'gambar' => $fileName,
            ]);
        }

        $motor->update([
            'nama_sepeda_motor' => $request->nama_sepeda_motor,
            'harga' => $request->harga,
            'kondisi' => $request->kondisi,
            'jarak' => $request->jarak,
            'tahun' => $request->tahun,
            'spesifikasi' => $request->spesifikasi,
        ]);

        return redirect('/data-motor')->with('success', 'Data Motor Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motor = Motor::where('id', $id)->first();

        // Menghapus file lama dari storage
        $delete = Storage::delete('public/gambar_motor/' . $motor->gambar);
        // Delete data dari database 
        $motor->delete();

        return back()->with('success', 'Data Motor Berhasil Dihapus');
    }
}
