<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Repositories\HelperRepository;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $productRepository;
    private $helperRepository;

    public function __construct(ProductRepository $productRepository, HelperRepository $helperRepository) 
    {
        $this->productRepository = $productRepository;
        $this->helperRepository = $helperRepository; 
    }

    public function index()
    {
        $products = Product::orderBy('kd_product')->get();
        return view('page.admin.product', compact('products'));
    }
    
    public function create()
    {
        $kode = $this->productRepository->kode_otomatis();
        $categorys = Category::all();
        return view('page.admin.crud_page.product_create', ['kode' => $kode, 'categorys' => $categorys]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'category' => 'required',
            'product' => 'required',
            'qty_product' => 'required',
            'deskripsi' => 'required',
            'berat_product' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'image.*' => 'required|max:2048|Mimes:jpg,jpeg,png,svg,',
            // 'ukuran' => 'required'
        ]);
        // Chek total image
        if(count($request->file('image')) > 4) {
            return redirect('/add-product')->with(['error' => 'Max 4 upload file']);
        }
        $file_image = $this->helperRepository->map_image('gambar/product',$request->file('image'));
        $data = [
            'kd_product' => $request->kd_product,
            'id_category' => $request->category,
            'nama_product' => $request->product,
            'qty_product' => $request->qty_product,
            'deskripsi' => $request->deskripsi,
            'berat_product' => $request->berat_product,
            'warna' => $request->warna,
            'harga' => $request->harga,
            'gambar' => implode(' ',$file_image),
            'ukuran_product' => $request->ukuran
        ];
        $insert_data = $this->productRepository->insert_data($data);
        if($insert_data) {
            return redirect('/product')->with(['success' => 'Successfully add product']);
        }
        return redirect('/add-product')->with(['error' => 'Failed add product']);
    }

    public function edit($kd) 
    {
        $product = Product::whereRaw('kd_product = ?', [$kd])->first();
        $categorys = Category::all();
        return view('page.admin.crud_page.product_edit', ['product' => $product, 'categorys' => $categorys]);
    }

    public function update(Request $request, $kd) 
    {
        $data = Product::whereRaw('kd_product = ?', [$kd])->first();
        $check_image = $request->file('image') != null ? count($request->file('image')) : 0;
        $image = count(explode(' ', $data->gambar)) + $check_image;
        
        // Chek total image
        if($image > 4) {
            return redirect('/edit-product/'.$data->kd_product)->with(['error' => 'Max 4 file upload']);
        }

        $file_image = $this->helperRepository->map_image('gambar/product',$request->file('image'));
        $images = $request->file('image') == null ? $data->gambar : $data->gambar.' '.join(' ',$file_image);
    
        $data = [
            'kd_product' => $request->kd_product,
            'id_category' => $request->category,
            'nama_product' => $request->product,
            'qty_product' => $request->qty_product,
            'deskripsi' => $request->deskripsi,
            'berat_product' => $request->berat_product,
            'warna' => $request->warna,
            'harga' => $request->harga,
            'gambar' => $images,
            'ukuran_product' => $request->ukuran
        ];
        $update_data = $this->productRepository->update_data($data);
        if($update_data) {
            return redirect('/product')->with(['success' => 'Successfully update product']);
        }
        return redirect('/edit-product/'.$kd)->with(['error' => 'Failed update product']);
    }

    public function delete($kd)
    {
        $delete_data = $this->productRepository->delete($kd);
        if($delete_data) {
            return redirect('/product')->with(['success' => 'Successfully delete product']);
        }
        return redirect('/product')->with(['error' => 'Failed delete product']);
    }

    public function delete_image($image)
    {  
        $data = Product::whereRaw('gambar Like ?', ['%'.$image.'%'])->first();
        $jumlah_image = explode(' ', $data->gambar);
        // Image must have 1 in data product
        if(count($jumlah_image) == 1){
            return redirect('/edit-product/'.$data->kd_product)->with(['error' => 'Failed delete image']);
        }

        $delete_image = $this->productRepository->delete_image($data->kd_product, $image);        
        if($delete_image) {
            return redirect('/edit-product/'.$data->kd_product)->with(['success' => 'Successfully delete image']);
        }
        return redirect('/edit-product/'.$data->kd_product)->with(['error' => 'Failed delete image']);
    }
}