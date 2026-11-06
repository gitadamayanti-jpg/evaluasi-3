<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Digicam extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_digicam';

    protected $fillable = [
        'nama',
        'merek',
        'harga',
        'stok',
        'deskripsi',
        'foto',
        'id_kategori',
    ]; 

    public function kategoriDigicam()
    {
        return $this->belongsTo(
            KategoriDigicam::class,
            'id_kategori',
            'id_kategori'
        );
    }
}
