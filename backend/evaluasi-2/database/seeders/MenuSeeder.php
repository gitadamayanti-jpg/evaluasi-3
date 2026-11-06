<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Kategori;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $paketNasi = Kategori::firstOrCreate([
            'nama_kategori' => 'Paket Nasi'
        ]);

        $lauk = Kategori::firstOrCreate([
            'nama_kategori' => 'Lauk & Sayuran'
        ]);

        $minuman = Kategori::firstOrCreate([
            'nama_kategori' => 'Minuman'
        ]);

        $menus = [
            [
                'nama' => 'Paket Nasi Ayam Pop',
                'deskripsi' => 'Nasi hangat + Ayam Pop + Daun Singkong Rebus + Gulai Nangka + Sambal Pop Khusus/Sambal Ijo + Kuah Gulai/Bumbu Rendang terpisah.',
                'harga' => 38000,
                'rating' => 4.9,
                'gambar' => '/imeges/PaketNasiAyamPop.png',
                'kategori_id' => $paketNasi->id
            ],
            [
                'nama' => 'Paket Nasi Rendang',
                'deskripsi' => 'Nasi hangat + Rendang Daging Sapi + Daun Singkong + Gulai Nangka + Sambal Ijo + Siraman Kuah Gulai.',
                'harga' => 42000,
                'rating' => 4.8,
                'gambar' => '/imeges/PaketNasiRendang.png',
                'kategori_id' => $paketNasi->id
            ],
            [
                'nama' => 'Paket Nasi Spesial',
                'deskripsi' => 'Nasi hangat + Lauk Utama (Ayam Pop/Rendang) + Pendamping (Telur Dadar Padang/Perkedel Kentang) + Sayur Komplit + Sambal.',
                'harga' => 52000,
                'rating' => 5.0,
                'gambar' => '/imeges/PaketNasiKombinasi.png',
                'kategori_id' => $paketNasi->id
            ],
            [
                'nama' => 'Ayam Pop',
                'deskripsi' => 'Ayam kampung olahan khas dengan warna pucat, tekstur super lembut, dan disajikan dengan sambal petai manis-gurih.',
                'harga' => 28000,
                'rating' => 4.9,
                'gambar' => '/imeges/ayampop.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Rendang Daging Sapi',
                'deskripsi' => 'Daging sapi khas Pagi Sore dengan bumbu hitam pekat, kaya rempah, dan tekstur empuk.',
                'harga' => 32000,
                'rating' => 4.9,
                'gambar' => '/imeges/rendang.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Gulai Tunjang',
                'deskripsi' => 'Kikil sapi lembut disiram kuah gulai santan kental yang gurih.',
                'harga' => 30000,
                'rating' => 4.7,
                'gambar' => '/imeges/GulaiTunjang.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Telur Dadar Padang',
                'deskripsi' => 'Telur dadar tebal khas Padang dengan campuran daun bawang dan bumbu halus.',
                'harga' => 15000,
                'rating' => 4.8,
                'gambar' => '/imeges/TelurDadar.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Dendeng Balado',
                'deskripsi' => 'Irisan daging sapi tipis renyah disiram dengan balado cabai merah khas Minang.',
                'harga' => 34000,
                'rating' => 4.8,
                'gambar' => '/imeges/dendengbalado.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Telur Balado',
                'deskripsi' => 'Telur rebus goreng yang dibaluri bumbu balado cabai merah gurih pedas.',
                'harga' => 12000,
                'rating' => 4.6,
                'gambar' => '/imeges/telurbalado.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Gulai Kepala Kakap',
                'deskripsi' => 'Kepala ikan kakap segar dimasak dengan kuah gulai kuning kaya rempah dan asam keping yang segar.',
                'harga' => 65000,
                'rating' => 4.9,
                'gambar' => '/imeges/gulaikepalakakap.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Perkedel Kentang',
                'deskripsi' => 'Olahan kentang tumbuk gurih dengan rempah dan daun seledri, digoreng dengan baluran telur.',
                'harga' => 8000,
                'rating' => 4.7,
                'gambar' => '/imeges/Perkedel.png',
                'kategori_id' => $lauk->id
            ],
            [
                'nama' => 'Jus Martabe',
                'deskripsi' => 'Jus kombinasi asam-manis khas rumah makan Padang kelas atas.',
                'harga' => 22000,
                'rating' => 4.8,
                'gambar' => '/imeges/JusMartabe.png',
                'kategori_id' => $minuman->id
            ],
            [
                'nama' => 'Teh Talua',
                'deskripsi' => 'Minuman khas Minang dari racikan teh pekat, kuning telur, dan perasan jeruk nipis.',
                'harga' => 18000,
                'rating' => 4.9,
                'gambar' => '/imeges/TehTalua.png',
                'kategori_id' => $minuman->id
            ],
            [
                'nama' => 'Es Jeruk',
                'deskripsi' => 'Minuman segar dari perasan jeruk asli.',
                'harga' => 18000,
                'rating' => 4.6,
                'gambar' => '/imeges/EsJeruk.png',
                'kategori_id' => $minuman->id
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(
                ['nama' => $menu['nama']],
                $menu
            );
        }
    }
}