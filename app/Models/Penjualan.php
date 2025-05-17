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

    public function metodeBayar()
    {
        return $this->belongsTo(MetodeBayar::class, 'id_metode_bayar');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function jenisPengiriman()
    {
        return $this->belongsTo(\App\Models\JenisPengiriman::class, 'id_jenis_kirim');
    }
}
