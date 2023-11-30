@extends('template.app_user')
@section('title', 'Product')
@section('main-content')

<?php 
if(!function_exists('fetch_image')) {
    function fetch_image($kd_product) {
        $data = DB::table('product')->whereRaw('kd_product = ? ', [$kd_product])->first();
        $image = explode(' ', $data->gambar);
        return $image[0];
    }
}
?>
<!-- Breadcrumb -->
<div class="breadcrumb container">
    <ol>
        <li><a href="/home">Home</a></li>
        <li><a href="#">{{ $product[0]->nama_category }}</a></li>
        <li>All Product</li>
    </ol>
</div>
<div class="container">
    <div class="row">
        @foreach($product as $data)
        <a href="/detail-product/{{ $data->kd_product }}" style="color: unset;">
            <div class="card">
                <div class="box-image">
                    <img src="{{ url('gambar/product') }}/{{ fetch_image($data->kd_product) }}" />
                </div>
                <div class="box-content">
                    <h2>{{ $data->nama_product }}</h2>
                    <span>Harga: Rp. {{ number_format($data->harga, 2, '.', '.') }}</span>
                    <div class="container-color">
                        <span>Warna: </span>
                        <ul>
                            <li class="color"></li>
                            <li class="color"></li>
                            <li class="color"></li>
                            <li class="color"></li>
                        </ul>
                    </div>
                    <span>Stok: {{ $data->qty_product }}</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection