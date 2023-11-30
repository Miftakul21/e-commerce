<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Repositories\IklanRepository;
use App\Repositories\HelperRepository;

class IklanController extends Controller
{
    private $iklanRepository;
    private $helperRepository;

    public function __construct(IklanRepository $iklanRepository, HelperRepository $helperRepository)
    {
        $this->iklanRepository = $iklanRepository;
        $this->helperRepository = $helperRepository;
    }

    public function index()
    {
        $iklans = Iklan::all();
        return view('page.admin.iklan', compact('iklans'));
    }

    public function create()
    {
        return view('page.admin.crud_page.iklan_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'iklan' => 'required',
            'image' => 'required|Mimes:jpg,png,svg|max:1024'
        ]);

        $iklan = $request->iklan;
        // Request File
        $file = $request->file('image');
        $file_name = uniqid().'-'.$file->getClientOriginalName();
        $file->move('gambar/iklan',$file_name);
        
        $insert_iklan = $this->iklanRepository->insert_data($iklan,$file_name);
        if($insert_iklan) {
            return redirect()->route('iklan')->with(['success' => 'Successfully add iklan']);
        }
        return redirect()->route('create_iklan')->with(['error' => 'Successfully add iklan']);
    }

    public function edit($id)
    {
        $iklan = Iklan::whereRaw('id_iklan = ?', [$id])->first();
        return view('page.admin.crud_page.iklan_edit', compact('iklan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'iklan' => 'required',
            'image' => 'Mimes:jpg,png,svg|max:1024'
        ]);
        
        $iklan = $request->iklan;
        $image = Iklan::whereRaw('id_iklan = ?', [$id])->first();

        // Request File
        $file = $request->file('image');
        $file_name = uniqid().'-'.$file->getClientOriginalName();
        $file->move('gambar/iklan',$file_name);
        
        $gambar = $request->file('image') != '' ? $file_name : $image->gambar;
        $update_data = $this->iklanRepository->update_data($id, $iklan, $gambar);

        if($update_data) {
            return redirect()->route('iklan')->with(['success' => 'Successfully update iklan']);
        }
        return redirect()->route('edit-iklan')->with(['error' => 'Failed update iklan']);
    }

    public function delete($id)
    {
        $delete_data = $this->iklanRepository->delete_data($id);
        if($delete_data) {
            return redirect()->route('iklan')->with(['success' => 'Successfully delete iklan']);
        }
        return redirect()->route('edit-iklan')->with(['error' => 'Failed delete iklan']);
    }

    public function delete_image($id)
    {
        $delete_image = $this->iklanRepository->delete_image($id);
        
        if($delete_image) {
            return redirect('/edit-iklan/'.$id)->with(['success' => 'Successfully delete image']);
        }
        return redirect('/edit-iklan/'.$id)->with(['error' => 'Failed delete image']);
    }
}