<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

     protected $table = 'matakuliah';
    protected $primaryKey = 'matakuliah_id';

    protected $fillable = [
        'nama_matakuliah'
    ];

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'matakuliah_id');
    }

}
