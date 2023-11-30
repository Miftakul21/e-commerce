<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;

class AdminRepository
{

    function user($email,$password)
    {
        $email = $email;
        $password = $password;
        $user = User::whereRaw('email = ?', [$email])->where('password', $password)->first();
        return $user;
    }

    function register($data)
    {
        $insert = User::create([
            'nama'=>$data['nama'],
            'email'=>$data['email'],
            'no_telepon'=>$data['no_telepon'],
            'alamat'=>$data['alamat'],
            'password'=>Hash::make($data['password']),
            'role' => $data['role']
        ]);

        return $insert;
    }

    function update($id_user, $nama, $email, $no_telepon, $alamat, $password)
    {
        $id_user = $id_user;
        
        $update = User->whereRaw('id_user = ?', [$id_user])
                ->update([
                    'nama'=>$nama,
                    'email'=>$email,
                    'no_telepon'=>$no_telepon,
                    'alamat'=>$alamat,
                    'password'=>$password
                ]);

        return update;
    }
}