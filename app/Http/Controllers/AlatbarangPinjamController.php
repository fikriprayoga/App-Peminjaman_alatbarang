<?php

namespace App\Http\Controllers;

use App\Models\Alatbarangs;
use App\Models\Rentlogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AlatbarangPinjamController extends Controller
{
    public function index($id)
    {
        $alatbarangs = Alatbarangs::where('id', $id)->first();
        return view('alatbarang-pinjam', ['alatbarangs' => $alatbarangs]);
    }

    public function pinjam(Request $request)
    {
        $validate = $request->validate([
            'alatbarang_id' => 'integer|required',
            'user_id' => 'integer',
            'tanggal_peminjaman' => 'date',
            'tanggal_pengembalian' => 'date',
        ]);

        $rent = Rentlogs::create($request->all());
        return redirect('alatbarangs')->with('status', 'Peminjaman Berhasil!!!');
    }
}
