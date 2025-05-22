<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';
    protected $primaryKey = 'id_tagihan';

    protected $fillable = [
        'nama_tagihan',
        'kategori',
        'nominal',
        'tanggal_mulai',
        'tanggal_batas',
        'angkatan',
    ];

    public function tagihanMahasiswa()
    {
        return $this->hasMany(TagihanMahasiswa::class, 'id_tagihan', 'id_tagihan');
    }
}