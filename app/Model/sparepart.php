<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class sparepart extends Model
{
    public $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'sparepart';
    public $fillable = ['kode_barang', 'image', 'nama', 'jenis_barang', 'jumlah', 'created_at'];
}
