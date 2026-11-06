<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        return response()->json(
            Nilai::with(['mahasiswa', 'matakuliah'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'matakuliah_id' => 'required|exists:matakuliah,matakuliah_id',
            'semester' => 'required|integer',
            'nilai' => 'required|integer'
        ]);

        $nilai = Nilai::create($request->all());

        return response()->json($nilai, 201);
    }

    public function show($id)
    {
        return response()->json(
            Nilai::with(['mahasiswa', 'matakuliah'])->findOrFail($id)
        );
    }
}