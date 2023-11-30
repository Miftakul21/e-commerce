<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PesananRepository;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    private $pesananRepository;

    public function __construct(PesananRepository $pesananRepository)
    {
        $this->pesananRepository = $pesananRepository;
    }

    public function index()
    {
            $product = Product::paginate(4);
            $category = Category::all();
            return view('page.user.index', ['product' => $product, 'category' => $category]);
    }

    // Nanti ditambahakan sesuai kategori
    public function product()
    {
        $product = Product::all();
        return view('page.user.product', ['product' => $product]);
    }

    public function product_kategori($id)
    {
        $product = DB::table('category')
                    ->join('product', 'category.id_category', '=', 'product.id_category')
                    ->where('category.id_category', $id)
                    ->get();
                
        if(count($product) != 0) {
            return view('page.user.product_kategori', ['product' => $product]);
        }
        
        return view('not_found');
    }

    public function pesanan() 
    {
        if(!Auth::check()){
            return view('not_found');
        }
        $pesanan = $this->pesananRepository->fetch_pesanan(Auth::user()->id_user);
        return view('page.user.pesanan', ['pesanan' => $pesanan]);
    }

    public function settings()
    {
        if(!Auth::check()){
            return redirect()->route('login')->with(['error' => 'You must login']);
        }
        return view('page.user.settings');
    }
}