<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Repositories\AdminRepository;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pesanan;

class AdminController extends Controller
{
    private $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $product = Product::all()->count();
        $category = Product::all()->count();
        $pesanan = Pesanan::all()->count();

        $data = [
            'product' => $product,
            'category' => $category,
            'pesanan' => $pesanan 
        ];
        return view('page.admin.dashboard', $data);
    }   

    public function login()
    {
        return view('page.admin.login');
    }

    public function register()
    {
        return view('page.admin.register');
    }

    public function authlogin(Request $request)
    {
        $validation = $request->validate([
            'email' => 'required|email',
            'password' => [
                'required', 
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->symbols()
            ]
        ]);

        if(Auth::attempt($validation)) {
            $password = Auth::user()->password;
            $data = $this->adminRepository->user($request->email, $password);
        
            // Role page
            if($data->role == 'admin') {
                return redirect()->route('dashboard-admin')->with(['success' => 'Login successfully']);
            }else if($data->role == 'user') {
                return redirect()->route('home')->with(['success' => 'Login successfully']);
            }
            return redirect()->route('login')->with(['error' => 'Login failed, role not found']);
        }
        return redirect()->route('login')->with(['error' => 'Login failed']);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:dns',
            'no_telepon' => 'required|max:13',
            'password' => [
                'required', 
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->symbols()
            ],
            'role' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => '',
            'password' => $request->password,
            'role' => $request->role,
        ];

        $insert_data = $this->adminRepository->register($data);

        if($insert_data) {
            return redirect()->route('login')->with(['success' => 'Register successfuly']);
        }
        return redirect()->route('register')->with(['error' => 'Register failed']);
    }

    public function logout()
    {
        if(Auth::user()->role == 'user' || null) {
            Auth::logout();
            return redirect('/home');
        }
        
        Auth::logout();
        return redirect()->route('login');
    }
} 