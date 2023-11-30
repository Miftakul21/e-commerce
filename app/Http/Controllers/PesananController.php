<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PesananRepository;

class PesananController extends Controller
{
    private $pesananRepository;

    public function __construct(PesananRepository $pesananRepository) {
        $this->pesananRepository = $pesananRepository;
    }

    public function pesan_product(Request $request)
    {
        $kd_product = $request->kd_product;

        if(!Auth::check()){
            return redirect()->route('login')->with(['error' => 'You must login']);
        }

        $data = [
            'id_user' => Auth::user()->id_user,
            'kd_product' => $request->kd_product,
            'qty_pesanan' => $request->qty_pesanan,
            'size' => $request->size,
            'warna' => $request->warna,
            'status' => 'pesan'
        ];

        $insert_data = $this->pesananRepository->insert_data($data);

        if($insert_data) {
            return redirect('/pesanan')->with(['success' => 'Successfuly ordered product']);
        }
        return redirect('/detail-product/'.$kd_product)->with(['error' => 'Failed ordered product']);
    }

    public function store_checkout(Request $request)
    {
        $kd_product = $request->kd_product;
        // dd($request->all());

        // Provinsi
        $provinsi = DB::table('provinces')->select(DB::raw("DISTINCT name"))
                    ->whereRaw('province_id = ?', [$request->provinsi])
                    ->get();
        
        // Kota/Kabupaten
        $kota_kabupaten = DB::table('cities')->select(DB::raw("DISTINCT name"))
                    ->whereRaw('city_id = ?', [$request->kota_kabupaten])
                    ->get();

        // KP-001|Pos|Layanan Ekesekutif|2000|2-3 hari
        $pengiriman = explode('|', $request->layanan_pengiriman);

        for($i = 0; $i < count($request->kd_product); $i++)
        {
            $data = DB::table('detail_pesanan')->whereRaw('kd_product = ?', [$kd_product[$i]])->count();
            if($data = 1) {
                DetailPesanan::whereRaw('kd_product = ?', [$kd_product[$i]])->update([
                    'pengiriman' => $request->layanan_pengiriman.'|'.$provinsi[0]->name.'|'.$kota_kabupaten[0]->name
                ]);
            }else{
                $data = [
                    'id_user' => Auth::user()->id_user,
                    'kd_product' => $kd_product[$i],
                    'pengiriman' => $request->layanan_pengiriman.'|'.$provinsi[0]->name.'|'.$kota_kabupaten[0]->name
                ];
                DetailPesanan::insert($data);
            }
        }
        return redirect('/checkout')->with(['success' => 'Successfully chekout']);
    }
    
    
    public function checkout()
    {
        $snap = $this->pesananRepository->payment_method();
        $pesanan = $this->pesananRepository->fetch_pesanan(Auth::user()->id_user);
        $alamat = $this->pesananRepository->alamat();
        $biaya_pengiriman = $this->pesananRepository->biaya_pengiriman();
        $total_pesanan = $this->pesananRepository->total_pesanan();
        
        $data = [
            'snap' => $snap,
            'pesanan' => $pesanan,
            'provinsi' => explode('|', $alamat[0]->pengiriman)[4],
            'kota_kabupaten' => explode('|', $alamat[0]->pengiriman)[5],
            'pengiriman' => $biaya_pengiriman[0]->pengiriman,
            'total_pesanan' => $total_pesanan[0]->total_pesanan + (int) explode('|',$biaya_pengiriman[0]->pengiriman)[2]
        ];
        
        return view('page.user.checkout', $data);
    }

    public function total_pesanan()
    {
        $pesanan = $this->pesananRepository->total_pesanan();
        if($pesanan) {
            return response()->json(['success' => true, 'message' => 'Data found', 'data' => $pesanan[0]->total_pesanan],200);
        }

        return response()->json(['success' => false, 'message' => 'Data not found'],400);
    }
}