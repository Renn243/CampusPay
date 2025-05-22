<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa'); // Primary Key
             $table->foreignId('id_user')->constrained('users', 'id')              // references users.id
                    ->onDelete('cascade');  // Foreign Key ke users.id_user
            $table->string('nim', 20)->unique();
            $table->string('nama_mahasiswa', 100);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 100);
            $table->string('no_telp', 20);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']);
            $table->enum('fakultas', ['teknik', 'ekonomi', 'kedokteran', 'hukum', 'fisip']);
            $table->enum('program_studi', ['teknik informatika', 'teknik sipil', 'teknik elektro']);
            $table->enum('angkatan', ['2023', '2022', '2021', '2020']);
            $table->string('alamat', 255);
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa'); 
    }
}
