<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PesananRepository;

class RegionController extends Controller
{
    private $pesananRepository;

    public function __construct(PesananRepository $pesananRepository) {
        $this->pesananRepository = $pesananRepository;
    }

    public function provinces()
    {
        $data = Province::all();
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data found',
                'data' => $data
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data not found'
        ],500);
    }

    public function cities($id)
    {
        $data = City::select(DB::raw('DISTINCT name'), 'province_id', 'city_id', 'name')
                ->whereRaw('province_id = ?', [$id])
                ->get();
        if($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data found',
                'data' => $data
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data not found!'
        ],500);
    }

    public function ongkir_pengiriman(Request $request)
    {

        $province_id = $request->province_id;
        $city_id = $request->city_id;
        $pengiriman = $request->pengiriman;

        // Butuh berat barang dari hasil total pesanan

        $berat = DB::table('pesanan AS a')->select(DB::raw('SUM(a.qty_pesanan * b.berat_product) AS berat_product'))
                        ->leftjoin('product AS b', 'a.kd_product', '=', 'b.kd_product')
                        ->where('a.status','pesan')->where('a.id_user', Auth::user()->id_user)
                        ->get();


        $biaya = RajaOngkir::ongkosKirim([
            'origin' => $province_id,
            'destination' => $city_id,
            'weight' => $berat[0]->berat_product,
            'courier' => $pengiriman
        ])->get();


        if($biaya) {
            return response()->json([
                'success' => true, 
                'message' => 'Data found', 
                'data' => $biaya, 
                'berat_pesanan' => $berat[0]->berat_product, 
            ],200);
        }
        return response()->json([
            'success' => false, 
            'message' => 'Data not found'
        ],401);
    }
}