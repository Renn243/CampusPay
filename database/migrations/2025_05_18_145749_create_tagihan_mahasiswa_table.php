<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tagihan_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tagihan')
                  ->constrained('tagihan','id_tagihan')
                  ->onDelete('cascade');
            $table->foreignId('id_mahasiswa')
                  ->constrained('mahasiswa','id_mahasiswa')
                  ->onDelete('cascade');
            $table->enum('status', ['belum bayar','lunas'])->default('belum bayar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihan_mahasiswa');
    }
};