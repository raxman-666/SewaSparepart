<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    public $primaryKey = 'id_pengembalian';
    protected $table = 'pengembalian';
    public $fillable = ['kode_barang', 'deskripsi_kebutuhan', 'jumlah_dikembalikan', 'tanggal', 'status'];
}
