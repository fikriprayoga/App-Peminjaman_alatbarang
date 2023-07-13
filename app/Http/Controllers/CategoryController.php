<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('kategori', ['categories' => $categories]);
    }

    public function create()
    {
        return view('kategori');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:categories|max:100',
        ], [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.unique' => 'Nama kategori sudah terdaftar',
            'nama.max' => 'Nama kategori maksimal 100 karakter'
        ]);


        $category = Category::create($request->all());
        return redirect('kategori')->with('status', 'Nama Kategori Sukses di tambahkan');
    }

    public function edit(Request $request, $slug)
    {
        if ($request->isMethod('put')) {
            $data = $request->all();

            Category::where(['slug' => $slug])->update(['nama' => $data['nama']]);
            return redirect('kategori')->with('status', 'Nama Kategori Berhasil di Update');
        }
    }

    public function destroy(Request $request, $slug)
    {
        if ($request->isMethod('delete')) {
            $data = $request->all();

            Category::where(['slug' => $slug])->delete(['nama' => $data['nama']]);
            return redirect('kategori')->with('status', 'Nama Kategori Berhasil di Hapus');
        }
    }
}
