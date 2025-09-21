<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengetahuan;

class PengetahuanSeeder extends Seeder
{
    public function run()
    {
        $pengetahuan = [
            // Rules untuk Jerawat (Acne Vulgaris) - Pk001
            ['permasalahan_id' => 1, 'penyebab_id' => 1, 'mb' => 0.8, 'md' => 0.1], // Kulit berminyak
            ['permasalahan_id' => 1, 'penyebab_id' => 2, 'mb' => 0.9, 'md' => 0.0], // Pori tersumbat
            ['permasalahan_id' => 1, 'penyebab_id' => 3, 'mb' => 0.85, 'md' => 0.0], // Komedo hitam
            ['permasalahan_id' => 1, 'penyebab_id' => 4, 'mb' => 0.85, 'md' => 0.0], // Komedo putih
            ['permasalahan_id' => 1, 'penyebab_id' => 5, 'mb' => 0.8, 'md' => 0.0], // Benjolan merah
            ['permasalahan_id' => 1, 'penyebab_id' => 6, 'mb' => 0.9, 'md' => 0.0], // Benjolan bernanah
            ['permasalahan_id' => 1, 'penyebab_id' => 20, 'mb' => 0.7, 'md' => 0.1], // Jerawat saat menstruasi
            ['permasalahan_id' => 1, 'penyebab_id' => 23, 'mb' => 0.6, 'md' => 0.1], // Stress
            ['permasalahan_id' => 1, 'penyebab_id' => 24, 'mb' => 0.7, 'md' => 0.1], // Perubahan hormonal
            ['permasalahan_id' => 1, 'penyebab_id' => 29, 'mb' => 0.5, 'md' => 0.1], // Pola makan buruk

            // Rules untuk Dermatitis Seboroik - Pk002
            ['permasalahan_id' => 2, 'penyebab_id' => 7, 'mb' => 0.8, 'md' => 0.0], // Kulit kemerahan
            ['permasalahan_id' => 2, 'penyebab_id' => 8, 'mb' => 0.7, 'md' => 0.1], // Kulit gatal
            ['permasalahan_id' => 2, 'penyebab_id' => 9, 'mb' => 0.6, 'md' => 0.1], // Kulit kering mengelupas
            ['permasalahan_id' => 2, 'penyebab_id' => 10, 'mb' => 0.9, 'md' => 0.0], // Kulit bersisik
            ['permasalahan_id' => 2, 'penyebab_id' => 1, 'mb' => 0.7, 'md' => 0.0], // Kulit berminyak
            ['permasalahan_id' => 2, 'penyebab_id' => 23, 'mb' => 0.6, 'md' => 0.1], // Stress
            ['permasalahan_id' => 2, 'penyebab_id' => 22, 'mb' => 0.5, 'md' => 0.2], // Produk tidak cocok

            // Rules untuk Melasma - Pk003
            ['permasalahan_id' => 3, 'penyebab_id' => 11, 'mb' => 0.9, 'md' => 0.0], // Bercak gelap
            ['permasalahan_id' => 3, 'penyebab_id' => 12, 'mb' => 0.8, 'md' => 0.0], // Warna tidak merata
            ['permasalahan_id' => 3, 'penyebab_id' => 21, 'mb' => 0.8, 'md' => 0.0], // Paparan sinar matahari
            ['permasalahan_id' => 3, 'penyebab_id' => 24, 'mb' => 0.7, 'md' => 0.1], // Perubahan hormonal
            ['permasalahan_id' => 3, 'penyebab_id' => 20, 'mb' => 0.6, 'md' => 0.1], // Menstruasi

            // Rules untuk Rosacea - Pk004
            ['permasalahan_id' => 4, 'penyebab_id' => 7, 'mb' => 0.9, 'md' => 0.0], // Kulit kemerahan
            ['permasalahan_id' => 4, 'penyebab_id' => 13, 'mb' => 0.8, 'md' => 0.0], // Pembuluh darah tampak
            ['permasalahan_id' => 4, 'penyebab_id' => 14, 'mb' => 0.8, 'md' => 0.0], // Kulit sensitif
            ['permasalahan_id' => 4, 'penyebab_id' => 15, 'mb' => 0.7, 'md' => 0.1], // Rasa terbakar
            ['permasalahan_id' => 4, 'penyebab_id' => 25, 'mb' => 0.7, 'md' => 0.0], // Mudah memerah saat panas
            ['permasalahan_id' => 4, 'penyebab_id' => 23, 'mb' => 0.6, 'md' => 0.1], // Stress

            // Rules untuk Dermatitis Atopik - Pk005
            ['permasalahan_id' => 5, 'penyebab_id' => 8, 'mb' => 0.9, 'md' => 0.0], // Kulit gatal
            ['permasalahan_id' => 5, 'penyebab_id' => 9, 'mb' => 0.8, 'md' => 0.0], // Kulit kering mengelupas
            ['permasalahan_id' => 5, 'penyebab_id' => 7, 'mb' => 0.7, 'md' => 0.1], // Kulit kemerahan
            ['permasalahan_id' => 5, 'penyebab_id' => 14, 'mb' => 0.8, 'md' => 0.0], // Kulit sensitif
            ['permasalahan_id' => 5, 'penyebab_id' => 18, 'mb' => 0.6, 'md' => 0.1], // Kulit kencang
            ['permasalahan_id' => 5, 'penyebab_id' => 26, 'mb' => 0.7, 'md' => 0.0], // Reaksi alergi
            ['permasalahan_id' => 5, 'penyebab_id' => 23, 'mb' => 0.5, 'md' => 0.1], // Stress

            // Rules untuk Keratosis Pilaris - Pk006
            ['permasalahan_id' => 6, 'penyebab_id' => 16, 'mb' => 0.9, 'md' => 0.0], // Kulit kasar
            ['permasalahan_id' => 6, 'penyebab_id' => 17, 'mb' => 0.9, 'md' => 0.0], // Benjolan seperti amplas
            ['permasalahan_id' => 6, 'penyebab_id' => 9, 'mb' => 0.7, 'md' => 0.1], // Kulit kering
            ['permasalahan_id' => 6, 'penyebab_id' => 27, 'mb' => 0.8, 'md' => 0.0], // Kulit tebal tidak halus

            // Rules untuk Hiperpigmentasi Post-Inflammatory - Pk007
            ['permasalahan_id' => 7, 'penyebab_id' => 19, 'mb' => 0.9, 'md' => 0.0], // Bekas luka/noda
            ['permasalahan_id' => 7, 'penyebab_id' => 11, 'mb' => 0.8, 'md' => 0.0], // Bercak gelap
            ['permasalahan_id' => 7, 'penyebab_id' => 12, 'mb' => 0.7, 'md' => 0.0], // Warna tidak merata
            ['permasalahan_id' => 7, 'penyebab_id' => 21, 'mb' => 0.6, 'md' => 0.1], // Paparan matahari
            ['permasalahan_id' => 7, 'penyebab_id' => 5, 'mb' => 0.5, 'md' => 0.2], // Benjolan merah sebelumnya

            // Rules untuk Kulit Kering - Pk008
            ['permasalahan_id' => 8, 'penyebab_id' => 9, 'mb' => 0.9, 'md' => 0.0], // Kulit kering mengelupas
            ['permasalahan_id' => 8, 'penyebab_id' => 16, 'mb' => 0.8, 'md' => 0.0], // Kulit kasar
            ['permasalahan_id' => 8, 'penyebab_id' => 18, 'mb' => 0.8, 'md' => 0.0], // Kulit kencang
            ['permasalahan_id' => 8, 'penyebab_id' => 8, 'mb' => 0.6, 'md' => 0.1], // Kulit gatal
            ['permasalahan_id' => 8, 'penyebab_id' => 10, 'mb' => 0.7, 'md' => 0.1], // Kulit bersisik
            ['permasalahan_id' => 8, 'penyebab_id' => 30, 'mb' => 0.6, 'md' => 0.1], // Kurang minum air
            ['permasalahan_id' => 8, 'penyebab_id' => 22, 'mb' => 0.5, 'md' => 0.2], // Produk tidak cocok
        ];

        foreach ($pengetahuan as $data) {
            Pengetahuan::create($data);
        }
    }
}
