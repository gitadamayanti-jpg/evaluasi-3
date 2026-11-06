<?php

namespace App\Http\Controllers;

use App\Models\Digicam;
use App\Models\KategoriDigicam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
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

        $digicam = $query->latest()->get();
        $kategoris = KategoriDigicam::all();

        return view('frontpage.landing-page', compact('digicam', 'kategoris'));
    }
}