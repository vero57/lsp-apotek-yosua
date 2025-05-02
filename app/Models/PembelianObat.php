<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianObat extends Model
{
    protected $table = 'pembelian';

    protected $fillable = [
        'nonota',
        'tgl_pembelian',
        'total_bayar',
        'id_distributor',
        'created_at',
        'updated_at',
    ];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }
}
