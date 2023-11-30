<?php 

namespace App\Repositories;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryRepository
{
    public function insert_data($category, $image)
    {
        $insert_data = Category::create([
            'nama_category' => $category,
            'gambar' => $image
        ]);

        return $insert_data;
    }

    public function delete_data($id)
    {
        $file = Category::whereRaw('id_category = ?', [$id])->first();
        // Delete File
        $image = $file->gambar;
        File::delete('gambar/category/'.$image);
        
        $delete_data = $file->delete();
        return $delete_data;
    }
    
    public function update_data($id, $category, $image) {
        $update_data = Category::whereRaw('id_category = ?', [$id])
                    ->update([
                        'nama_category' => $category,
                        'gambar' => $image
                    ]);
        return $update_data;
    }

    public function delete_image($id) {
        $file = Category::whereRaw('id_category = ?', [$id])->first();
        // Delete File
        File::delete('gambar/category/'.$file->gambar);   

        // Update null gambar
        $delete_image = Category::whereRaw('id_category = ?', [$id])->update(['gambar' => '']);
        return $delete_image;
    }
}