<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_mahasiswa')
                  ->constrained('mahasiswa','id_mahasiswa')
                  ->onDelete('cascade');
            $table->foreignId('id_tagihan')
                  ->constrained('tagihan','id_tagihan')
                  ->onDelete('cascade');   
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('metode_transaksi')->nullable();
            $table->dateTime('tanggal_bayar')->nullable();
            $table->string('foto_bukti_transaksi')->nullable();
            $table->string('order_id')->unique()->nullable();
            $table->enum('status',['pending','sukses','gagal'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};