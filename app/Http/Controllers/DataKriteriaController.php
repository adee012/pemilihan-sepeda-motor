<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataKriteriaController extends Controller
{
    public function edit(string $id)
    {
        $kriteria = Kriteria::where('id', $id)->first();
        return view('admin.data_krtieria.update', compact('kriteria'));
    }

    public function update(Request $request)
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

        return redirect('/kriteria')->with('success', 'Bobot Kriteria Berhasil Diubah');
    }
}
