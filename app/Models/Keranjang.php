<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'id_pelanggan',
        'id_obat',
        'jumlah_order',
        'harga',
        'subtotal',
    ];

    public $timestamps = false;

    public function obat()
    {
        return $this->belongsTo(\App\Models\Product::class, 'id_obat');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Pelanggan::class, 'id_pelanggan');
    }
}
