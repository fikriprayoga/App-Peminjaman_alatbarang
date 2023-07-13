<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function authenticating(Request $request)
    {
        $credentials = $request->validate([
            'namapengguna' => ['required'],
            'password' => ['required'],
        ]);

        // cek apakah login valid?
        if (Auth::attempt($credentials)) {
            // cek apakah user status = active
            if (Auth::user()->status != 'active') {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Akun kamu belum aktif, dimohon untuk menghubungi admin 🙏');
                return redirect('/login');
            }

            if(Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }

            if (Auth::user()->role_id == 2) {
                return redirect('alatbarangs');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Login gagal');
        return redirect('/login');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'namapengguna' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'telepon' => 'required|max:255',
            'alamat' => 'required',
        ], [
            'namapengguna.required' => 'Nama pengguna wajib diisi',
            'namapengguna.unique' => 'Nama pengguna sudah terdaftar',
            'namapengguna.max' => 'Nama pengguna maksimal 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.max' => 'Password maksimal 255 karakter',
            'telepon.required' => 'Nomor Telepon wajib diisi',
            'telepon.max' => 'Nomor telepon maksimal 255 karakter',
            'alamat.required' => 'Alamat wajib diisi'
        ]);


        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());

        Session::flash('status', 'success');
        Session::flash('message', 'Pendaftaran Berhasil 🎉. Harap Tuggu Admin Mengaktifkan Akun Anda 🙏');
        return redirect('register');
    }
}
