<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
     use HasFactory;

     protected $table = 'konsultasi';

     protected $fillable = [
          'user_id',
          'pakar_id',
          'no_antrian',
          'nama_pasien',
          'usia',
          'jenis_kelamin',
          'permasalahan_kulit',
          'keluhan',
          'hasil_diagnosa',
          'status',
          'tanggal_konsultasi',
          'catatan_pakar'
     ];

     protected $casts = [
          'tanggal_konsultasi' => 'datetime',
     ];

     // Relasi ke User (sebagai pasien)
     public function user()
     {
          return $this->belongsTo(User::class, 'user_id');
     }

     // Relasi ke User (sebagai pakar)
     public function pakar()
     {
          return $this->belongsTo(User::class, 'pakar_id');
     }

     // Generate nomor antrian otomatis
     public static function generateNoAntrian()
     {
          $today = now()->format('Ymd');
          $lastKonsultasi = self::whereDate('created_at', today())
               ->orderBy('id', 'desc')
               ->first();

          if ($lastKonsultasi && $lastKonsultasi->no_antrian) {
               $lastNumber = intval(substr($lastKonsultasi->no_antrian, -3));
               $newNumber = $lastNumber + 1;
          } else {
               $newNumber = 1;
          }

          return 'K' . $today . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
     }

     // Scope untuk filter berdasarkan status
     public function scopeByStatus($query, $status)
     {
          return $query->where('status', $status);
     }
}
