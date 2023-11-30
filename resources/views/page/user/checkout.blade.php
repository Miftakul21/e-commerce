@extends('template.app_user')
@section('title', 'Checkout')

@section('main-content')
<!-- Breadcrumb -->
<div class="breadcrumb container">
    <ol>
        <li><a href="/home">Home</a></li>
        <li>Chekout</li>
    </ol>
</div>

<!-- List Order -->
<section class="table-order">
    <div class="card-checkout">
        <div class="card-logo">
            <img src="{{ url('assets/image/logo-brwk.jpeg') }}">
            <h1>BREWOK</h1>
        </div>

        <div class="container-data-pengirim">
            <div class="user">
                <p>Nama </p>
                <p>: {{ Auth::user()->nama }}</p>
            </div>
            <div class="nomor-telepon">
                <p>No. Telepon</p>
                <p>: {{ Auth::user()->no_telepon }}</p>
            </div>
            <div class="alamat">
                <p>Alamat</p>
                <p>: {{ $kota_kabupaten }} ({{ $provinsi }})</p>
            </div>
        </div>

        <hr>

        <div class="card-content-pesanan">
            @foreach($pesanan as $data)
            <div class="pesanan">
                <p class="qty-pesanan">({{$data->qty_pesanan}}x) {{ $data->nama_product }} {{ $data->harga }}</p>
                <p class="harga">{{ $data->total }}</p>
            </div>
            @endforeach
        </div>

        <div class="card-content-pengiriman">
            <div class="pengiriman">
                <p class="qty-pesanan">(1x) {{ explode('|',$pengiriman)[0] }} {{ explode('|',$pengiriman)[1] }}</p>
                <p class="harga">{{ explode('|',$pengiriman)[2] }}</p>
            </div>
        </div>

        <hr>

        <div class="container-total-harga">
            <div class="total">
                <p>Total Harga :</p>
                <p>{{ $total_pesanan }}</p>
            </div>
        </div>

        <div class="container-button">
            <button id="btn-checkout">Chekout</button>
        </div>
    </div>
</section>


<script>
// Script payment gateway (Midtrans)
// For example trigger on button clicked, or any time you need
var payButton = document.getElementById('btn-checkout');
payButton.addEventListener('click', function() {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{ $snap }}', {
        onSuccess: function(result) {
            /* You may add your own implementation here */
            alert("payment success!");
            console.log(result);
        },
        onPending: function(result) {
            /* You may add your own implementation here */
            alert("wating your payment!");
            console.log(result);
        },
        onError: function(result) {
            /* You may add your own implementation here */
            alert("payment failed!");
            console.log(result);
        },
        onClose: function() {
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
        }
    })
});
</script>


@endsection