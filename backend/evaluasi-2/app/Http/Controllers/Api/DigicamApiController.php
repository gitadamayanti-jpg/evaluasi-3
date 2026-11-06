<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Digicam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigicamApiController extends Controller
{
    // GET: Menampilkan semua data + pencarian dan filter
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'merek' => 'nullable|string|max:100',
            'id_kategori' => 'nullable|integer|exists:kategori_digicams,id_kategori',
            'harga_min' => 'nullable|numeric|min:0',
            'harga_max' => 'nullable|numeric|min:0|gte:harga_min',
        ]);

        $query = Digicam::with('kategoriDigicam');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('merek', 'like', "%{$search}%");
            });
        }

        if ($request->filled('merek')) {
            $query->where('merek', 'like', '%' . $request->merek . '%');
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        $digicam = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Data digicam berhasil diambil',
            'data' => $digicam
        ], 200);
    }

    // GET: Detail satu digicam
    public function show($id)
    {
        $digicam = Digicam::with('kategoriDigicam')->find($id);

        if (!$digicam) {
            return response()->json([
                'success' => false,
                'message' => 'Digicam tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail digicam berhasil diambil',
            'data' => $digicam
        ], 200);
    }

    // POST: Tambah digicam + upload foto
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_kategori' => 'nullable|exists:kategori_digicams,id_kategori',
        ]);

        if ($request->hasFile('foto')) {
            $validasi['foto'] = $request->file('foto')
                ->store('digicam', 'public');
        }

        $digicam = Digicam::create($validasi);

        return response()->json([
            'success' => true,
            'message' => 'Digicam berhasil ditambahkan',
            'data' => $digicam
        ], 201);
    }

    // PUT: Update digicam + opsional mengganti foto
    public function update(Request $request, $id)
    {
        $digicam = Digicam::find($id);

        if (!$digicam) {
            return response()->json([
                'success' => false,
                'message' => 'Digicam tidak ditemukan'
            ], 404);
        }

        $validasi = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'merek' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|numeric|min:0',
            'stok' => 'sometimes|required|integer|min:0',
            'deskripsi' => 'sometimes|nullable|string',
            'foto' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'id_kategori' => 'sometimes|nullable|exists:kategori_digicams,id_kategori',
        ]);

        if ($request->hasFile('foto')) {
            if ($digicam->foto) {
                Storage::disk('public')->delete($digicam->foto);
            }

            $validasi['foto'] = $request->file('foto')
                ->store('digicam', 'public');
        }

        $digicam->update($validasi);

        return response()->json([
            'success' => true,
            'message' => 'Digicam berhasil diperbarui',
            'data' => $digicam->fresh()->load('kategoriDigicam')
        ], 200);
    }

    // DELETE: Hapus digicam dan foto terkait
    public function destroy($id)
    {
        $digicam = Digicam::find($id);

        if (!$digicam) {
            return response()->json([
                'success' => false,
                'message' => 'Digicam tidak ditemukan'
            ], 404);
        }

        if ($digicam->foto) {
            Storage::disk('public')->delete($digicam->foto);
        }

        $digicam->delete();

        return response()->json([
            'success' => true,
            'message' => 'Digicam berhasil dihapus'
        ], 200);
    }
}
