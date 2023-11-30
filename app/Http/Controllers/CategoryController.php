<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Repositories\CategoryRepository;
use App\Repositories\HelperRepository;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $helperRepository;

    public function __construct(CategoryRepository $categoryRepository, HelperRepository $helperRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->helperRepository = $helperRepository;
    }

    public function index()
    {
        $categorys = Category::orderBy('id_category')->get();
        return view('page.admin.category', compact('categorys'));
    }

    public function create()
    {
        return view('page.admin.crud_page.category_create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'category' => 'required',
            'image' => 'required|Mimes:jpg,png,svg|max:1024'
        ]);

        $category = $request->category;

        // Request File
        $file = $request->file('image');
        $file_name = uniqid().'-'.$file->getClientOriginalName();
        $file->move('gambar/category',$file_name);
        
        $insert_category = $this->categoryRepository->insert_data($category, $file_name);

        if($insert_category) {
            return redirect()->route('category')->with(['success' => 'Successfully add category']);
        }
        return redirect()->route('create_category')->with(['error' => 'Failed add category']);
    }

    public function edit($id) 
    {
        $category = Category::whereRaw('id_category = ?', [$id])->first();
        return view('page.admin.crud_page.category_edit', compact('category'));
    }

    public function update(Request $request, $id) 
    {
        $validation = $request->validate([
            'category' => 'required',
            'image' => 'Mimes:jpg,png,svg|max:1024'
        ]);

        $category = $request->category;
        $image = Category::whereRaw('id_category = ?', [$id])->first();
        
        // Request File
        $file = $request->file('image');
        $file_name = uniqid().'-'.$file->getClientOriginalName();
        $file->move('gambar/category',$file_name);

        $gambar = $request->file('image') != '' ? $file_name : $image->gambar;
        $update_data = $this->categoryRepository->update_data($id, $category, $gambar);

        if($update_data) {
            return redirect()->route('category')->with(['success' => 'Successfully update category']);
        }
        return redirect()->route('edit-category')->with(['error' => 'Failed update category']);
    }

    public function delete($id)
    {   
        $delete_data = $this->categoryRepository->delete_data($id);
        if($delete_data) {
            return redirect()->route('category')->with(['success' => 'Successfully delete category']);
        }
        return redirect()->route('category')->with(['error' => 'Failed delete category']);
    }
    public function delete_image($id) 
    {
        $delete_image = $this->categoryRepository->delete_image($id);
        
        if($delete_image) {
            return redirect('/edit-category/'.$id)->with(['success' => 'Successfully delete image']);
        }
        return redirect('/edit-category/'.$id)->with(['error' => 'Failed delete image']);
    }
}