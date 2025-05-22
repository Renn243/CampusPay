<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'id_user',
        'nim',
        'nama_mahasiswa',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'agama',
        'fakultas',
        'program_studi',
        'angkatan',
        'alamat',
        'no_telp',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function tagihanMahasiswa()
    {
        return $this->hasMany(TagihanMahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}