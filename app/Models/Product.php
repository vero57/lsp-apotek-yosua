<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'obat'; // atau nama tabel sesuai database Anda
    protected $fillable = [
        'nama_obat',
        'idjenis',
        'harga_jual',
        'deskripsi_obat',
        'foto1',
        'foto2',
        'foto3',
        'stok',
    ];
}
    