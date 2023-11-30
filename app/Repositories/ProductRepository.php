<?php

namespace App\Repositories;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductRepository
{
    // Logical CRUD 
    public function kode_otomatis()
    {
        $record_product = Product::max('kd_product');
        $last_number = (int) substr($record_product, 3, 3) + 1;
        return "KD-".sprintf('%03s', $last_number);
    }
    
    public function insert_data($data) 
    {
        $insert_data = Product::create([
            'kd_product' => $data['kd_product'],
            'id_category' => $data['id_category'],
            'nama_product' => $data['nama_product'],
            'qty_product' => $data['qty_product'],
            'deskripsi' => $data['deskripsi'],
            'berat_product' => $data['berat_product'],
            'warna' => $data['warna'],
            'harga' => $data['harga'], 
            'gambar' => $data['gambar'],
            'ukuran_product' => $data['ukuran_product']
        ]);

        return $insert_data;
    }

    public function update_data($data) 
    {
        $update_data = Product::whereRaw('kd_product = ?', [$data['kd_product']])->update([
            'kd_product' => $data['kd_product'],
            'id_category' => $data['id_category'],
            'nama_product' => $data['nama_product'],
            'qty_product' => $data['qty_product'],
            'deskripsi' => $data['deskripsi'],
            'berat_product' => $data['berat_product'],
            'warna' => $data['warna'],
            'harga' => $data['harga'], 
            'gambar' => $data['gambar'],
            'ukuran_product' => $data['ukuran_product']
        ]);

        return $update_data;
    }

    public function delete($kd_product)
    {
        $data = Product::whereRaw('kd_product = ?', [$kd_product])->first();
        foreach(explode(' ', $data->gambar) as $image) {
            File::delete('gambar/product/'.$image);
        }
        return $data->delete();
    }

    public function delete_image($kd_product, $image) 
    {
        $data = Product::whereRaw('gambar Like ?', ["%".$image."%"])->first();
        $delete_file = str_contains($data->gambar, $image) ? File::delete('gambar/product/'.$image) : false; 
        $images = str_replace($image, null, $data->gambar);
        $update_image = Product::whereRaw('kd_product = ?', [$kd_product])->update(['gambar' => trim($images)]);
        return $update_image;
    }
}