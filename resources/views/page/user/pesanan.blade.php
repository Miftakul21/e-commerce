@extends('template.app_user')
@section('title','Pesanan')
@section('main-content')
<?php 
if(!function_exists('fetch_image')) {
    function fetch_image($kd_product) {
        $data = DB::table('pesanan')
                ->select('product.gambar')
                ->join('product', 'pesanan.kd_product', '=', 'product.kd_product')
                ->where('pesanan.kd_product', $kd_product)
                ->first();
        $image = explode(' ', $data->gambar);
        return $image[0];
    }
}
?>

<!-- Breadcrumb -->
<div class="breadcrumb container">
    <ol>
        <li><a href="/home">Home</a></li>
        <li>Order</li>
    </ol>
</div>

<!-- List Order -->
<section class="table-order">
    <table>
        <tr>
            <th>Product</th>
            <th>Warna</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        @foreach($pesanan as $data)
        <tr>
            <td>
                <img src="{{ url('gambar/product') }}/{{ fetch_image($data->kd_product) }}" />
                {{ $data->nama_product }}
            </td>
            <td>{{ $data->warna }}</td>
            <td>{{ $data->qty_pesanan }}</td>
            <td>Rp. {{ number_format($data->harga, '2', ',', '.') }}</td>
            <td>Rp. {{ number_format($data->total, '2', ',', '.') }}</td>
            <td class="delete-button">
                <a href="#"><img src="{{ url('assets/icon/icon-fa-times.svg') }}" /></a>
            </td>
        </tr>
        @endforeach
    </table>
</section>

<!-- Shipping -->
<section class="pesan">
    <form action="/checkout" method="POST">
        @csrf
        <!-- List Orderean Product -->
        @foreach($pesanan as $data)
        <input type="hidden" name="kd_product[]" value="{{ $data->kd_product }}" />
        @endforeach
        <div class="form-group-wilayah">
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select id="provinsi" name="provinsi">
                </select>
            </div>
            <div class="form-group">
                <label for="kota_kabupaten">Kota/Kabupaten</label>
                <select id="kota_kabupaten" name="kota_kabupaten">
                </select>
            </div>
        </div>
        <div class="form-group-wilayah">
            <div class="form-group">
                <label for="Pengiriman">Pengiriman</label>
                <select id="pengiriman">
                    <option value="">Layanan Pengiriman</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="layanan_pengiriman">Layanan Pengirman</label>
                <select name="layanan_pengiriman" id="layanan_pengiriman">
                </select>
            </div>
        </div>

        <h3>Total : <span id="total"></span></h3>
        <button class="btn-checkout">Checkout</button>
    </form>
</section>

@endsection