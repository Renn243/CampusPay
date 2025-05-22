<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->string('nama_tagihan');
            $table->enum('kategori', ['spp','kkn','ujian','wisuda','lainnya']);
            $table->decimal('nominal', 15, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_batas');
            $table->enum('angkatan', ['2023','2022','2021','2020']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};