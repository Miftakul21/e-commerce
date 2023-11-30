@extends('template.app_user')
@section('title', 'Settings')
@section('main-content')

<!-- Breadcrumb -->
<div class="breadcrumb container">
    <ol>
        <li><a href="/home">Profile</a></li>
        <li>Setting</li>
    </ol>
</div>

<section class="settings-card">
    <div class="card-setting">
        <div class="card-title">
            <h1>Settings</h1>
        </div>
        <form action="">
            <div class="card-setting-content">
                <div class="container-user-detail">
                    <h5>Profile Detail</h5>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-user">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="{{ Auth::user()->nama }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-user">
                                <label for="nama">Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-user">
                                <label for="nama">Nomor Telepon</label>
                                <input type="text" name="no_telepon" value="{{ Auth::user()->no_telepon }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-user-address">
                    <h5>Alamat User</h5>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-address">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-address">
                                <label for="kota_kabupaten">Kota/Kabupaten</label>
                                <select name="kota_kabupaten" id="kota_kabupaten">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button>Update</button>
            </div>
        </form>
    </div>
</section>


@endsection