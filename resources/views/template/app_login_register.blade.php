<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('asets/templates/font-awesome/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ url('assets/templates/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ url('assets/templates/css/style.css') }}">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        @yield('main-content')

    </div>

    <!-- Bootstrap core JavaScript (Jquery 3.6.0) -->
    <script src="{{ url('assets/templates/js/jquery.min.js') }}">
    </script>

    <script src="{{ url('assets/templates/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/templates/js/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/templates/js/sb-admin-2.min.js') }}"></script>


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
</body>

</html>