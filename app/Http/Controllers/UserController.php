<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $pengguna = User::where('role_id', 2)->get();
        return view('pengguna', ['pengguna' => $pengguna]);
    }

    public function aktifkan($slug)
    {
        $pengguna = User::where('slug', $slug)->first();
        $pengguna->status = 'active';
        $pengguna->save();
        return redirect('pengguna')->with('status', 'User Berhasil di Aktifkan');
    }

    public function nonaktifkan($slug)
    {
        $pengguna = User::where('slug', $slug)->first();
        $pengguna->status = 'inactive';
        $pengguna->save();
        return redirect('pengguna')->with('status', 'User Berhasil di Aktifkan');
    }

    public function edit(Request $request, $slug)
    {
        $pengguna = User::where('slug', $slug)->first();
        $pengguna->update($request->all());
        return redirect('pengguna')->with('status', 'Data Pengguna Berhasil di Update');
    }

    public function destroy(Request $request, $slug)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();

            User::where(['slug' => $slug])->delete([$data]);
            return redirect('pengguna')->with('status', 'Nama Penggua yang dipilih Berhasil di Hapus');
        }
    }
}
