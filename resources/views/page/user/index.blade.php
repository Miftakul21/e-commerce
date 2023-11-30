@extends('template.app_user')
@section('title', 'Brework Ecommerce')
@section('link-css')
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

<!-- Hero Section -->
<section class="container swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="hero-1 swiper-slide">
            <img src="{{ url('assets/image/fashion-girl.jpg') }}" />
        </div>
        <div class="hero-1 swiper-slide">
            <img src="{{ url('assets/image/shoes.jpg') }}" />
        </div>
        <div class="hero-1 swiper-slide">
            <img src="{{ url('assets/image/keyboard-mechanical.jpg') }}" />
        </div>
    </div>

</section>

<!-- Category -->
<section class="category container">
    <div class="row">
        @foreach($category as $data)
        <a href="/product-category/{{ $data->id_category }}" class="box">
            <img src="{{ url('gambar/category') }}/{{ $data->gambar }}" />
            {{ $data->nama_category }}
        </a>
        @endforeach
    </div>
</section>

<!-- Product -->
<section class="product">
    <h1>New Arrival</h1>
    <h5>Latest Collection</h5>
    <div class="row">
        @foreach($product as $data)
        <a href="/detail-product/{{ $data->kd_product }}" style="color: unset;">
            <div class="card">
                <div class="box-image">
                    <img src="{{ url('gambar/product') }}/{{ fetch_image($data->kd_product) }}" />
                </div>
                <div class="box-content">
                    <h2>{{ $data->nama_product }}</h2>
                    <span>Harga: {{ $data->harga }}</span>
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
    <div class="container-tag-more">
        <a href="/list-product" class="tag-more">See More &#129058;</a>
    </div>
</section>

<!-- Product -->
<section class="product">
    <h1>Blog</h1>
    <h5>Latest Collection</h5>
    <div class="row">
        @foreach($product as $data)
        <div class="card">
            <div class="box-image">
                <img src="{{ url('gambar/product') }}/{{ fetch_image($data->kd_product) }}" />
            </div>
            <div class="box-content">
                <h2>{{ $data->nama_product }}</h2>
                <span>Harga: {{ $data->harga }}</span>
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
        @endforeach
    </div>
    <div class="container-tag-more">
        <a href="/list-product" class="tag-more">See More &#129058;</a>
    </div>
</section>

<!-- Blog -->
<section class="blog">
    <h1>Blog</h1>
    <div class="row">
        <div class="card">
            <img src="{{ url('assets/image/img-blog-2.jpg') }}" />
        </div>
        <div class="card">
            <img src="{{ url('assets/image/img-blog-3.jpg') }}" />
        </div>
        <div class="card">
            <img src="{{ url('assets/image/img-blog-2.jpg') }}" />
        </div>
    </div>
</section>

@endsection