<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisObat extends Model
{
    protected $table = 'jenis_obat';

    protected $fillable = [
        'jenis',
        'deskripsi_jenis',
        'image_url',
    ];

    public $timestamps = true;

    // Relasi ke Product
    public function products()
    {
        return $this->hasMany(Product::class, 'idjenis', 'id');
    }
}
