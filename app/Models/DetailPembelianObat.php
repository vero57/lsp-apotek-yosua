<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelianObat extends Model
{
    protected $table = 'detail_pembelian';

    protected $fillable = [
        'id_obat',
        'jumlah_beli',
        'harga_beli',
        'subtotal',
        'id_pembelian',
    ];

    public function obat()
    {
        return $this->belongsTo(Product::class, 'id_obat');
    }

    public function pembelian()
    {
        return $this->belongsTo(PembelianObat::class, 'id_pembelian');
    }
}
