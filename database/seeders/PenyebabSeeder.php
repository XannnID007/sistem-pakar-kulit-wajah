<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyebab;

class PenyebabSeeder extends Seeder
{
    public function run()
    {
        $penyebabs = [
            // Penyebab umum untuk berbagai masalah kulit
            ['kode' => 'P001', 'nama' => 'Kulit berminyak berlebihan'],
            ['kode' => 'P002', 'nama' => 'Pori-pori tersumbat'],
            ['kode' => 'P003', 'nama' => 'Komedo hitam (blackhead)'],
            ['kode' => 'P004', 'nama' => 'Komedo putih (whitehead)'],
            ['kode' => 'P005', 'nama' => 'Benjolan merah dan nyeri'],
            ['kode' => 'P006', 'nama' => 'Benjolan bernanah'],
            ['kode' => 'P007', 'nama' => 'Kulit kemerahan'],
            ['kode' => 'P008', 'nama' => 'Kulit terasa gatal'],
            ['kode' => 'P009', 'nama' => 'Kulit kering dan mengelupas'],
            ['kode' => 'P010', 'nama' => 'Kulit bersisik'],
            ['kode' => 'P011', 'nama' => 'Bercak gelap pada wajah'],
            ['kode' => 'P012', 'nama' => 'Perubahan warna kulit tidak merata'],
            ['kode' => 'P013', 'nama' => 'Pembuluh darah tampak jelas'],
            ['kode' => 'P014', 'nama' => 'Kulit sensitif dan mudah iritasi'],
            ['kode' => 'P015', 'nama' => 'Rasa terbakar pada kulit'],
            ['kode' => 'P016', 'nama' => 'Kulit terasa kasar'],
            ['kode' => 'P017', 'nama' => 'Benjolan kecil seperti amplas'],
            ['kode' => 'P018', 'nama' => 'Kulit terasa kencang'],
            ['kode' => 'P019', 'nama' => 'Munculnya bekas luka atau noda'],
            ['kode' => 'P020', 'nama' => 'Kulit mudah berjerawat saat menstruasi'],
            ['kode' => 'P021', 'nama' => 'Paparan sinar matahari berlebihan'],
            ['kode' => 'P022', 'nama' => 'Penggunaan produk skincare yang tidak cocok'],
            ['kode' => 'P023', 'nama' => 'Stress dan kurang tidur'],
            ['kode' => 'P024', 'nama' => 'Perubahan hormonal'],
            ['kode' => 'P025', 'nama' => 'Kulit wajah mudah memerah saat panas'],
            ['kode' => 'P026', 'nama' => 'Reaksi alergi terhadap produk tertentu'],
            ['kode' => 'P027', 'nama' => 'Kulit terasa tebal dan tidak halus'],
            ['kode' => 'P028', 'nama' => 'Munculnya garis-garis halus'],
            ['kode' => 'P029', 'nama' => 'Pola makan tidak sehat'],
            ['kode' => 'P030', 'nama' => 'Kurangnya asupan air mineral']
        ];

        foreach ($penyebabs as $data) {
            Penyebab::create($data);
        }
    }
}
