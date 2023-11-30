<?php 

namespace App\Repositories;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use DB;

class PesananRepository
{
    public function fetch_pesanan($id_user)
    {
        $pesanan = DB::table('pesanan AS a')
                ->select('a.kd_product', 'b.nama_product', 'a.warna', 'a.qty_pesanan', 'b.harga',
                        DB::raw('SUM(b.harga * a.qty_pesanan) AS total'))
                ->leftjoin('product as b', 'a.kd_product', '=', 'b.kd_product')
                ->whereRaw('a.id_user = ?', [$id_user])->where('a.status', 'pesan')
                ->groupBy('a.kd_product', 'b.nama_product', 'a.warna', 'a.qty_pesanan', 'b.harga')
                ->get();
        return $pesanan;
    }

    public function insert_data($data)
    {
        $pesanan = Pesanan::where('id_user', $data['id_user'])->where('kd_product', $data['kd_product'])->get();
        $insert_data = '';
        if(count($pesanan) != 0) {
            $insert_data = Pesanan::whereRaw('id_user = ?', [$data['id_user']])
                        ->whereRaw('kd_product = ?', [$data['kd_product']])
                        ->update(['qty_pesanan' => $pesanan[0]->qty_pesanan + $data['qty_pesanan']]);
        } else {
            $insert_data =  Pesanan::create([
                                'id_user' => $data['id_user'],
                                'kd_product' => $data['kd_product'],
                                'qty_pesanan' => $data['qty_pesanan'],
                                'warna' => $data['warna'],
                                'status' => $data['status'] 
                            ]);
        }
        return $insert_data;
    }

    public function total_pesanan() {
        $total_biaya = DB::table('pesanan AS a')->select(DB::raw('SUM(a.qty_pesanan * b.harga) AS total_pesanan'))
                        ->leftjoin('product AS b', 'a.kd_product', '=', 'b.kd_product')
                        ->where('a.status','pesan')->where('a.id_user', Auth::user()->id_user)
                        ->get();
        return $total_biaya;
    }

    public function alamat(){
        $data = DB::table('detail_pesanan AS a')->select('a.pengiriman')
                ->leftjoin('pesanan as b', 'a.kd_product', '=', 'b.kd_product')
                ->where('b.status', 'pesan')
                ->where('a.id_user', Auth::user()->id_user)
                ->get();
        return $data;
    }

    public function biaya_pengiriman(){
        $data = DB::table('detail_pesanan AS a')
                ->select(DB::raw('DISTINCT a.pengiriman'))
                ->leftjoin('pesanan AS b', 'a.kd_product', '=', 'b.kd_product')
                ->where('b.id_user', Auth::user()->id_user)
                ->where('b.status', 'pesan')
                ->get();
        return $data;
    }

    public function payment_method()
    {
        \Midtrans\Config::$serverKey = env('SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Data Pesanan
        $data = [];
        $index = 0;
        $data_pesanan = DB::table('pesanan AS a')
                        ->select('a.kd_product', 'b.nama_product', 'b.harga', 'a.qty_pesanan', 'a.warna')
                        ->leftjoin('product AS b', 'a.kd_product', '=', 'b.kd_product')
                        ->where('a.id_user', Auth::user()->id_user)
                        ->where('a.status','pesan')
                        ->groupBy('a.kd_product', 'b.nama_product', 'b.harga', 'a.qty_pesanan', 'a.warna')
                        ->get();
        foreach ($data_pesanan as $pesanan) {
            $data[$index]['id'] = $pesanan->kd_product;
            $data[$index]['price'] = $pesanan->harga;
            $data[$index]['quantity'] = $pesanan->qty_pesanan;
            $data[$index]['name'] = $pesanan->nama_product;
            $index++;
        }
        // Data Pilihan Pengimrian
        $data_pengiriman = DB::table('detail_pesanan AS a')->select(DB::raw("DISTINCT a.pengiriman"))
                            ->leftjoin('pesanan AS b', 'a.kd_product', '=', 'b.kd_product')
                            ->where('a.id_user',Auth::user()->id_user)
                            ->where('b.status','pesan')
                            ->get();
        $pengiriman = explode('|', $data_pengiriman[0]->pengiriman);

        $data[$index]['id'] = 'KP-'.$pengiriman[0];
        $data[$index]['price'] = $pengiriman[2];
        $data[$index]['quantity'] = 1;
        $data[$index]['name'] = $pengiriman[0].' '.$pengiriman[1];


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            "item_details" => $data,
            'customer_details' => array(
                'first_name' => Auth::user()->nama,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_telepon,
            ),
        );

        return \Midtrans\Snap::getSnapToken($params);
    }
}