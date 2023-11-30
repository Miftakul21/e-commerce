<?php 

namespace App\Repositories;
use App\Models\Iklan;
use Illuminate\Support\Facades\File;

class IklanRepository
{
    public function insert_data($iklan, $image)
    {
        $insert_data = Iklan::create([
            'nama_iklan' => $iklan,
            'gambar' => $image
        ]);
        return $insert_data;
    }

    public function delete_data($id)
    {
        $file = Iklan::whereRaw('id_iklan = ?', [$id])->first();
        $image = $file->gambar;
        File::delete('gambar/iklan/'.$image);
        return $file->delete();
    }

    public function update_data($id, $iklan, $image)
    {
        $update_data = Iklan::whereRaw('id_iklan = ?', [$id])
                    ->update([
                        'nama_iklan' => $iklan,
                        'gambar' => $image
                    ]);
        return $update_data;
    }

    public function delete_image($id) {
        $file = Iklan::whereRaw('id_iklan = ?', [$id])->first();
        File::delete('gambar/iklan/'.$file->gambar);   
        $delete_image = Iklan::whereRaw('id_iklan = ?', [$id])->update(['gambar' => '']);
        return $delete_image;
    }
}