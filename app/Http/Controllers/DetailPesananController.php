<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailPesananController extends Controller
{
    public function detail_product($kd)
    {
        $product = Product::whereRaw('kd_product = ?', [$kd])->first();
        return view('page.user.product_detail', compact('product'));
    }
}