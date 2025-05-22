<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanMahasiswa extends Model
{
    protected $table = 'tagihan_mahasiswa';

    protected $fillable = [
        'id_mahasiswa',
        'id_tagihan',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }
}