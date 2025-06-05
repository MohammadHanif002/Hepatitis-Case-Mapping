<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    // Nama tabel di database
    protected $table = 'jember'; // Pastikan ini nama tabel kamu

    // Jika tabel tidak punya kolom created_at dan updated_at
    public $timestamps = false;

    // Kolom yang bisa diisi (optional, tapi direkomendasikan untuk keamanan)
    protected $fillable = [
        'gid',
        'kecamatan',
        'jumlah_kasus',
        'tahun',
    ];
}
