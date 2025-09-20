<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermasalahanKulit extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'permasalahan_kulits';

    // Primary key (default: id, jadi opsional kalau memang "id")
    protected $primaryKey = 'id';

    // Field yang bisa diisi mass assignment
    protected $fillable = [
        'kode',
        'nama_permasalahan',
        'deskripsi',
        'saran',
    ];

    // Relasi ke tabel pengetahuan
    public function pengetahuans()
    {
        return $this->hasMany(Pengetahuan::class, 'permasalahan_id');
    }
}
