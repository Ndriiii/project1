<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nama_Produk',
        'Harga_Produk',
        'Tipe_Produk',
        'Detail_Produk',
        'Kategori_Produk',
        'Foto_Produk',
        'Diskon',
        'Harga_Diskon'
    ];
}
