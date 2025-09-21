<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Nama tabel sesuai properti $table di model Anda
        Schema::create('pengetahuan', function (Blueprint $table) {
            $table->id();

            // Foreign key untuk relasi ke permasalahan
            // Mengasumsikan nama tabelnya adalah 'permasalahan_kulits'
            $table->foreignId('permasalahan_id')->constrained('permasalahan_kulits')->onDelete('cascade');

            // Foreign key untuk relasi ke penyebab
            $table->foreignId('penyebab_id')->constrained('penyebabs')->onDelete('cascade');

            // Kolom untuk nilai Measure of Belief (MB)
            $table->float('mb');

            // Kolom untuk nilai Measure of Disbelief (MD)
            $table->float('md');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengetahuan');
    }
};
