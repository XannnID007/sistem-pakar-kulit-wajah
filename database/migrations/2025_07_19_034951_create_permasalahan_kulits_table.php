<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermasalahanKulitsTable extends Migration
{
    public function up()
    {
        Schema::create('permasalahan_kulits', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama_permasalahan');
            $table->text('deskripsi')->nullable();
            $table->text('saran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permasalahan_kulits');
    }
}
