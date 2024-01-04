<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    public $primaryKey = 'id_peminjaman';
    protected $table = 'peminjaman';
    public $fillable = ['kode_barang', 'deskripsi_kebutuhan', 'jumlah_dipinjam', 'tanggal', 'status'];
}
