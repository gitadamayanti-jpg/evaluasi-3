<?php

namespace App\Http\Controllers;

use App\Models\KategoriDigicam;
use Illuminate\Http\Request;

class KategoriDigicamController extends Controller
{
    public function index()
    {
        $title = "Daftar Kategori Digicam";
        $kategoris = KategoriDigicam::all();

        return view('admin.kategoridigicam', compact(
        'title',
        'kategoris'
        ));
    }

    public function create()
    {
        $title = "Tambah Kategori Digicam";

        return view('admin.inputkategoridigicam', compact('title'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        KategoriDigicam::create($validasi);

        return redirect()->route('kategori-digicam.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = "Edit Kategori Digicam";
        $kategori = KategoriDigicam::findOrFail($id);

        return view(
            'admin.inputkategoridigicam',
            compact('title', 'kategori')
        );
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriDigicam::findOrFail($id);
        $kategori->update($validasi);

        return redirect()->route('kategori-digicam.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriDigicam::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-digicam.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
