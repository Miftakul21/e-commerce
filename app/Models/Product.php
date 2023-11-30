<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; 
    protected $primaryKey = 'kd_product';
    
    protected $fillable = [
        'kd_product',
        'id_category',
        'nama_product',
        'qty_product',
        'deskripsi',
        'berat_product',
        'warna',
        'harga',
        'gambar',
        'ukuran_product'
    ];

    public $incrementing = false;

    public $timestamps = false;
}