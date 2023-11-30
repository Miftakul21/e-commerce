@extends('template.app_user')
@section('title', 'Detail Product')
@section('main-content')

<?php 
if(!function_exists('map_item')) {
    function map_item($kd_product) {
        $data = DB::table('product')->whereRaw('kd_product = ? ', [$kd_product])->first();
        $category = DB::table('product')
                    ->select('nama_category')
                    ->join('category', 'product.id_category', '=', 'category.id_category')
                    ->whereRaw('kd_product = ?', [$kd_product])
                    ->get();
        $image = explode(' ', $data->gambar);
        $data = [
            'category' => $category[0]->nama_category,
            'image' => $image[0],
            'images' => array_slice($image, 1),
            'warna' => explode(' ', $data->warna),
            'size' => isset($data->ukuran_product) !=null ? explode(' ', $data->ukuran_product) : '',
        ];
        return $data;
    }
}
$data = map_item($product->kd_product);
?>

<!-- Breadcrumb -->
<div class="breadcrumb container">

    <ol>
        <li><a href="/home">Home</a></li>
        <li><a href="#">{{ $data['category'] }}</a></li>
        <li>{{ $product->nama_product }}</li>
    </ol>
</div>

<section class="detail-product container">
    <div class="row">
        <div class="col-1">
            <div class="box-image-preview">
                <img src="{{ url('gambar/product') }}/{{ $data['image'] }}" alt="">
            </div>
            <div class="box-image-preview">
                @foreach($data['images'] as $image)
                <img src="{{ url('gambar/product') }}/{{ $image }}" alt="">
                @endforeach
            </div>
        </div>

        <div class="col-2">
            <div class="title-product">
                <h1>{{ $product->nama_product }}</h1>
            </div>
            <div class="content">
                <div class="content-description">
                    <p>
                        {{ $product->deskripsi }}
                    </p>
                </div>
                <div class="price">Harga: RP. {{ number_format($product->harga,2,',','.') }}</div>
                <div class="container-color">
                    <span>Warna: </span>
                    <ul>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                    </ul>
                </div>
                <div class="stok">Stok: 280</div>

                <form action="/pesan" method="POST">
                    @csrf
                    <div>
                        <input type="hidden" value="{{ $product->kd_product }}" name="kd_product">
                        @if(!empty($data['size']))
                        <div class="form-group">
                            <label for="size">Ukuran :</label>

                            <select name="size" id="size">
                                <option value="" selected>Size</option>
                                @foreach($data['size'] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                                @endforeach
                            </select>


                        </div>
                        @endif
                        <div class="form-group">
                            <label for="warna">Warna :</label>

                            <select name="warna" id="warna">
                                @if($product->warna != null)
                                <option value="" selected>Warna</option>
                                @foreach($data['warna'] as $warna)
                                <option value="{{ $warna }}">{{ $warna }}</option>
                                @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="">Jumlah : </label>
                            <input type="number" min="1" max="20" value="1" name="qty_pesanan" />
                        </div>
                    </div>
                    <button class="btn-order">Order</button>
                </form>



            </div>
        </div>
    </div>
</section>
@endsection