<?php

namespace App\Http\Controllers;

use App\Models\Digicam;
use App\Models\KategoriDigicam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigicamController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Digicam';

        $query = Digicam::with('kategoriDigicam');

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                    ->orWhere('merek', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $digicam = $query->latest()->paginate(5)->appends($request->query());
        $kategoris = KategoriDigicam::all();

        return view('admin.daftardigicam', compact('title', 'digicam', 'kategoris'));
    }

    public function create()
    {
        $title = 'Tambah Digicam';
        $kategoris = KategoriDigicam::all();

        return view('admin.inputdigicam', compact('title', 'kategoris'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
            'min' => 'Kolom :attribute tidak boleh kurang dari :min.',
            'max' => 'Kolom :attribute maksimal :max.',
            'exists' => 'Pilihan :attribute tidak valid.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'image' => 'File harus berupa gambar.',
            'mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'file' => 'Perhatikan format dan ukuran file.',
        ];

        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori_digicams,id_kategori',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $messages);

        $validasi['foto'] = $request->file('foto')->store('digicam', 'public');

        Digicam::create($validasi);

        return redirect()
            ->route('digicam.index')
            ->with('success', 'Digicam berhasil ditambahkan.');
    }

    public function show($id)
    {
        $digicam = Digicam::with('kategoriDigicam')->findOrFail($id);

        return view('frontpage.detaildigicam', compact('digicam'));
    }

    public function edit($id)
    {
        $title = 'Edit Digicam';
        $kategoris = KategoriDigicam::all();
        $digicam = Digicam::findOrFail($id);

        return view('admin.inputdigicam', compact('title', 'kategoris', 'digicam'));
    }

    public function update(Request $request, $id)
    {
        $digicam = Digicam::findOrFail($id);

        $messages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
            'min' => 'Kolom :attribute tidak boleh kurang dari :min.',
            'max' => 'Kolom :attribute maksimal :max.',
            'exists' => 'Pilihan :attribute tidak valid.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'image' => 'File harus berupa gambar.',
            'mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'file' => 'Perhatikan format dan ukuran file.',
        ];

        $validasi = $request->validate([
            'nama' => 'required|string|max:255',
            'merek' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'required|exists:kategori_digicams,id_kategori',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], $messages);

        if ($request->hasFile('foto')) {
            if ($digicam->foto) {
                Storage::disk('public')->delete($digicam->foto);
            }

            $validasi['foto'] = $request->file('foto')->store('digicam', 'public');
        }

        $digicam->update($validasi);

        return redirect()
            ->route('digicam.index')
            ->with('success', 'Data Digicam berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $digicam = Digicam::findOrFail($id);

        if ($digicam->foto) {
            Storage::disk('public')->delete($digicam->foto);
        }

        $digicam->delete();

        return redirect()
            ->route('digicam.index')
            ->with('success', 'Digicam berhasil dihapus.');
    }
}