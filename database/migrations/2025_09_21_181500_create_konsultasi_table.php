<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('pakar_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('no_antrian')->unique()->nullable();
            $table->string('nama_pasien');
            $table->integer('usia');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('permasalahan_kulit');
            $table->text('keluhan');
            $table->text('hasil_diagnosa')->nullable();
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->datetime('tanggal_konsultasi')->nullable();
            $table->text('catatan_pakar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsultasi');
    }
};
