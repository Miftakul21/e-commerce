<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ url('assets/templates/css/style2.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/templates/css/style3.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/templates/css/style4.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/templates/css/style5.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/templates/css/style6.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/templates/css/style7.css') }}" />

    <!-- Sweet Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Jquery -->
    <script src="{{ url('assets/templates/js/jquery.min.js') }}"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('CLIENT_KEY') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

</head>

<body>
    <!-- Navbar -->
    <nav class="container">
        <a class="logo">
            <img src="{{ url('assets/image/logo-brwk.jpeg') }}" />
            BREWOK
        </a>
        <div class="navigation">
            <ul>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/bag-shopping.svg') }}" /></a>
                </li>
                <li>
                    <a href="/pesanan"><img src="{{ url('assets/icon/cart-shopping.svg') }}" /></a>
                </li>
            </ul>
            @if(!Auth::check())
            <div class="nav-account">
                <a href="/" class="btn-sign-in">Sign In</a>
                <a href="/register" class="btn-sign-up">Sign Up</a>
            </div>
            @else
            <a class="profile">
                <img src="{{ url('assets/image/girl-8.jpg') }}" />
                <span>{{ Auth::user()->nama }}</span>
            </a>
            <div class="dropdown-menu">
                <a href="/settings" class="dropdown-item"><img src="{{ url('assets/icon/settings.svg') }}" /> Settings
                </a>
                <form action="/logout" method="POST" style="display: inline-block;">
                    @csrf
                    <button class="dropdown-item"><img src="{{ url('assets/icon/logout.svg') }}" /> Logout</button>
                </form>
            </div>
            @endif
        </div>
    </nav>

    @yield('main-content')

    <!-- Footer -->
    <footer>
        <div class="logo-footer">
            <img src="{{ url('assets/image/logo-brwk.jpeg') }}" />
            <h3>Copyright 2023 BREWOK</h3>
        </div>
        <div class="customer-service">
            <h3>Customer Service</h3>
            <ul>
                <li><a href="">Helper Center</a></li>
            </ul>
            <ul>
                <li><a href="">Report Abuse</a></li>
            </ul>
            <ul>
                <li><a href="">Open a Case</a></li>
            </ul>
            <ul>
                <li><a href="">Policies & Rules</a></li>
            </ul>
        </div>
        <div class="history">
            <h3>History</h3>
            <ul>
                <li>
                    <a href="">Our</a>
                </li>
                <li>
                    <a href="">About Brwk</a>
                </li>
            </ul>
        </div>
        <div class="navigation-sosial">
            <h3>Customer Service</h3>
            <ul>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/facebook.svg') }}" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/instagram.svg') }}" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/twitter.svg') }}" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/linkendin.svg') }}" /></a>
                </li>
                <li>
                    <a href="#"><img src="{{ url('assets/icon/whatsapp.svg') }}" /></a>
                </li>
            </ul>
            <button><img src="{{ url('assets/icon/apple-store.svg') }}" />Google Play</button>
            <button><img src="{{ url('assets/icon/google-play-store.svg') }}" />Apps Store</button>
        </div>
    </footer>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @if(session()->has('success'))
    <script>
    Swal.fire({
        position: 'top-right',
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: true,
        timer: 1500
    })
    </script>
    @php
    session()->forget('message');
    session()->forget('success');
    @endphp
    @endif

    @if(session()->has('error'))
    <script>
    Swal.fire({
        position: 'top-right',
        icon: 'error',
        title: '{{ session("error") }}',
        showConfirmButton: true,
        timer: 1500
    })
    </script>
    @php
    session()->forget('message');
    session()->forget('error');
    @endphp
    @endif
    <script>
    // Script pengirman dan biaya pengiriman
    $(document).ready(function() {
        $(".profile").click(function() {
            $(".dropdown-menu").toggle();
        });
        $('#provinsi, #kota_kabupaten, #pengiriman, #layanan_pengiriman').select2();

        //total pesanan
        total_pesanan()

        function total_pesanan() {
            $.ajax({
                url: 'total_pesanan',
                type: 'GET',
                data_type: 'JSON',
                success: (res) => {
                    if (res) {
                        let totalPesanan = res.data;
                        $('#total').html(`Rp. ${totalPesanan}`)
                    }
                },
                error: (res) => {
                    console.log(res);
                }
            })
        }



        province();

        function province() {
            $.ajax({
                url: '/provinces',
                type: 'GET',
                dataType: "JSON",
                success: (res) => {
                    let html = "";

                    $('#provinsi').html('');
                    $('#provinsi').empty();
                    $('#provinsi').append("<option>Pilih Provinsi</option>");

                    for (let i = 0; i < res.data.length; i++) {
                        html +=
                            `<option name="id_provinsi" value="${res.data[i].province_id}">${res.data[i].name}</option>`;
                        $('#provinsi').append(html);

                    }
                },
                error: (res) => {}
            })
        }

        city();

        function city() {
            $('#provinsi').change(function() {
                let province_id = $(this).val();

                $.ajax({
                    url: '/cities/' + province_id,
                    type: 'GET',
                    dataType: "JSON",
                    success: (res) => {
                        let html = '';

                        $('#kota_kabupaten').html('');
                        $('#kota_kabupaten').empty();
                        $('#kota_kabupaten').append(
                            "<option>Pilih Kota/Kabupaten</option>");
                        for (let i = 0; i < res.data.length; i++) {
                            html +=
                                `<option name="id_kota" value="${res.data[i].city_id}">${res.data[i].name}</option>`;
                            $('#kota_kabupaten').append(html);
                        }
                    },
                    error: (res) => {}
                })
            })
        }

        $('#pengiriman').change(function() {
            let token = $('meta[name="csrf-token"]').attr('content');
            let province_id = $('#provinsi').val();
            let city_id = $('#kota_kabupaten').val();
            let pengiriman = $(this).val();

            $.ajax({
                url: '/ongkir',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    _token: token,
                    province_id: province_id,
                    city_id: city_id,
                    pengiriman: pengiriman
                },
                success: (res) => {
                    if (res.success) {
                        let html = '';
                        let pengiriman = res.data[0].code.toUpperCase();
                        let data = res.data[0].costs;

                        $('#layanan_pengiriman').html('');
                        $('#layanan_pengiriman').append('');
                        $('#layanan_pengiriman').append(
                            '<option value="">Pilih layanan pengiriman</option>');
                        for (let i = 0; i < data.length; i++) {
                            let layanan = data[i].service.toUpperCase();
                            let biaya = data[i].cost[0].value;
                            let estimasi = data[i].cost[0].etd.replace('HARI', '');
                            html +=
                                `<option value="${pengiriman}|${layanan}|${biaya}|${estimasi} hari">${pengiriman} : ${layanan} ${biaya} ${estimasi} hari</option>`
                            $('#layanan_pengiriman').append(html);
                        }
                    }
                },
                error: (res) => {
                    console.log(JSON.stringify(res));
                }
            })
        });

        $("#layanan_pengiriman").change(function() {
            let biayaPengiriman = $(this).val().split('|')[2];
            $.ajax({
                url: 'total_pesanan',
                type: 'GET',
                data_type: 'JSON',
                success: (res) => {
                    if (res) {
                        let totalPesanan = res.data + Number(biayaPengiriman);
                        $('#total').html(`Rp. ${totalPesanan}`)
                    }
                },
                error: (res) => {
                    console.log(res);
                }
            })
        });


        // Animation Slider
        var swiper = new Swiper('.mySwiper', {
            autoplay: {
                delay: 2500,
                disableOnInteration: false
            }
        })

    });
    </script>
</body>

</html>