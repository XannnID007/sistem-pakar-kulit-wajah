<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermasalahanKulit;

class PermasalahanKulitSeeder extends Seeder
{
    public function run()
    {
        $permasalahanKulit = [
            [
                'kode' => 'Pk001',
                'nama_permasalahan' => 'Jerawat (Acne Vulgaris)',
                'deskripsi' => 'Kondisi kulit yang ditandai dengan munculnya komedo, papula, pustula, dan nodul pada wajah',
                'saran' => 'Bersihkan wajah 2x sehari dengan sabun khusus jerawat, gunakan produk non-comedogenic, hindari memencet jerawat, konsultasi dengan dokter kulit jika jerawat parah'
            ],
            [
                'kode' => 'Pk002',
                'nama_permasalahan' => 'Dermatitis Seboroik',
                'deskripsi' => 'Peradangan kulit yang menyebabkan kulit kering, bersisik, dan kemerahan terutama di area berminyak',
                'saran' => 'Gunakan sampo anti-ketombe, hindari stress, jaga kebersihan kulit, gunakan pelembab yang tepat, konsultasi dokter untuk pengobatan medis'
            ],
            [
                'kode' => 'Pk003',
                'nama_permasalahan' => 'Melasma',
                'deskripsi' => 'Hiperpigmentasi yang menyebabkan bercak gelap pada wajah, sering terjadi pada wanita hamil',
                'saran' => 'Gunakan sunscreen SPF 30+ setiap hari, hindari paparan sinar matahari langsung, gunakan produk pencerah yang aman, konsultasi dokter kulit'
            ],
            [
                'kode' => 'Pk004',
                'nama_permasalahan' => 'Rosacea',
                'deskripsi' => 'Peradangan kronis yang menyebabkan kemerahan, pembuluh darah tampak, dan kadang benjolan pada wajah',
                'saran' => 'Hindari trigger seperti makanan pedas dan alkohol, gunakan sunscreen, pilih produk skincare yang gentle, konsultasi dokter kulit'
            ],
            [
                'kode' => 'Pk005',
                'nama_permasalahan' => 'Dermatitis Atopik (Eksim)',
                'deskripsi' => 'Kondisi kulit kering, gatal, dan meradang yang sering kambuh-kambuhan',
                'saran' => 'Gunakan pelembab secara teratur, hindari sabun keras, kenakan pakaian yang lembut, hindari allergen, konsultasi dokter kulit'
            ],
            [
                'kode' => 'Pk006',
                'nama_permasalahan' => 'Keratosis Pilaris',
                'deskripsi' => 'Kondisi kulit yang menyebabkan benjolan-benjolan kecil dan kasar, terutama di lengan dan paha',
                'saran' => 'Gunakan pelembab dengan kandungan urea atau asam laktat, hindari scrubbing berlebihan, mandi dengan air hangat tidak panas'
            ],
            [
                'kode' => 'Pk007',
                'nama_permasalahan' => 'Hiperpigmentasi Post-Inflammatory',
                'deskripsi' => 'Bercak gelap yang muncul setelah peradangan kulit seperti jerawat atau luka',
                'saran' => 'Gunakan sunscreen, hindari memencet jerawat, gunakan produk dengan vitamin C atau niacinamide, konsultasi dokter kulit'
            ],
            [
                'kode' => 'Pk008',
                'nama_permasalahan' => 'Kulit Kering (Xerosis)',
                'deskripsi' => 'Kondisi kulit yang kekurangan kelembaban, terasa kasar, dan mudah mengelupas',
                'saran' => 'Gunakan pelembab secara teratur, mandi dengan air hangat, hindari sabun keras, gunakan humidifier di ruangan'
            ]
        ];

        foreach ($permasalahanKulit as $data) {
            PermasalahanKulit::create($data);
        }
    }
}
