@extends('template.app_login_register')
@section('title', 'login page')

@section('main-content')
<!-- Outer Row -->
<div class="row justify-content-center mt-5">
    <div class="col-xl-6 col-lg-6 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="container-logo">
                                <img src="{{ url('assets/image/logo-brwk.jpeg') }}">
                            </div>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                            </div>
                            <form class="user" action="/authlogin" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        placeholder="Enter Email Address..." name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid  @enderror"
                                        placeholder="Enter Password..." name="password">
                                    @error('password')
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span>{{ $message }}</span>
                                    </div>
                                    @enderror
                                </div>
                                <button href="#" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <small>Create an Account!</small>
                                <a class="small" href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection