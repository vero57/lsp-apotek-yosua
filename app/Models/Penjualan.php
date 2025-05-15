<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = [
        'id_metode_bayar',
        'tgl_penjualan',
        'url_resep',
        'ongkos_kirim',
        'biaya_app',
        'total_bayar',
        'status_order',
        'keterangan_status',
        'id_jenis_kirim',
        'id_pelanggan',
        'created_at',
        'updated_at',
    ];
}
