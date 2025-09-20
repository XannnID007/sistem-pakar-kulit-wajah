<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengetahuan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pengetahuan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'permasalahan_id',
        'penyebab_id',
        'mb',
        'md',
    ];

    /**
     * Relasi ke tabel permasalahan
     */
    public function permasalahan()
    {
        return $this->belongsTo(PermasalahanKulit::class, 'permasalahan_id', 'id');
    }

    /**
     * Relasi ke tabel penyebab
     */
    public function penyebab()
    {
        return $this->belongsTo(Penyebab::class, 'penyebab_id', 'id');
    }
}
