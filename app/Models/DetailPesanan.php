<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    protected $priamryKey = 'id_detail';
    protected $fillable = [
        'id_user',
        'kd_product',
        'pengiriman'
    ];

    public $timestamps = false;
}