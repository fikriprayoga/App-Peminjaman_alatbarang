<?php

namespace App\Http\Controllers;

use App\Models\Alatbarangs;
use App\Models\Category;
use App\Models\Rentlogs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AlatbarangController extends Controller
{
    public function index()
    {
        $pengguna = User::where('id', '!=', 1)->get();
        $categories = Category::all();
        $alatbarangs = Alatbarangs::all();
        return view('alatbarangs', ['alatbarangs' => $alatbarangs, 'categories' => $categories, 'pengguna' => $pengguna]);
    }

    public function create()
    {
        return view('alatbarangs');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_alatbarang' => 'required|unique:alatbarangs|max:255',
            'nama' => 'required|max:255',
            'status' => 'string|max:255'
        ]);

        $newName = '';
        if ($request->file('img')) {
            $extension = $request->file('img')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->storeAs('cover', $newName);
        }

        $request['cover'] = $newName;
        $alatbarang = Alatbarangs::create($request->all());
        $alatbarang->categories()->sync($request->categories);
        return redirect('alatbarangs')->with('status', 'Data Alat dan Barang Sukses di tambahkan');
    }

    public function edit(Request $request, $slug)
    {

        if ($request->file('img')) {
            $extension = $request->file('img')->getClientOriginalExtension();
            $newName = $request->nama . '-' . now()->timestamp . '.' . $extension;
            $request->file('img')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $alatbarang = Alatbarangs::where('slug', $slug)->first();
        $alatbarang->update($request->all());
        $alatbarang->status = $request->status;
        $alatbarang->save();


        if ($request->categories) {
            $alatbarang->categories()->sync($request->categories);
        }

        // Simpan perubahan ke database
        $alatbarang->save();

        return redirect('alatbarangs')->with('status', 'Data Alat dan Barang Sukses di update');
    }


    public function destroy(Request $request, $slug)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();

            Alatbarangs::where(['slug' => $slug])->delete([$data]);
            return redirect('alatbarangs')->with('status', 'Data Alat dan Barang yang dipilih Berhasil di Hapus');
        }
    }
}
