<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        return response()->json(Matakuliah::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required'
        ]);

        $matakuliah = Matakuliah::create($request->all());

        return response()->json($matakuliah, 201);
    }

    public function show($id)
    {
        return response()->json(Matakuliah::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'nama_matakuliah' => 'required'
        ]);

        $matakuliah->update($request->all());

        return response()->json($matakuliah);
    }

    public function destroy($id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return response()->json([
            'message' => 'berhasil dihapus'
        ]);
    }
}
