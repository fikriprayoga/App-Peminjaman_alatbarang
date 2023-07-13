@extends('layouts.mainlayout')

@section('title', 'Form Alat Barang')

@section('content')
    <h1>Form Peminjaman Alat Barang</h1>
    <div>
        <form action="/alatbarang-pinjam" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="alatbarang" class="form-label">Alat barang yang akan di pinjam</label>
                    <input type="hidden" name="alatbarang_id" value="{{ $alatbarangs->id }}">
                    <input type="text" name="alatbarang" id="alatbarang" class="form-control"
                        value="{{ $alatbarangs->nama }}" disabled>
                </div>
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Peminjam</label>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="{{ Auth::user()->namapengguna }}" disabled>
                </div>
                <div class="form-group">
                    <label for="tanggal_peminjaman">Tanggal Peminjaman:</label><br>
                    <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman"><br>
                </div>
                <div class="form-group">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian:</label><br>
                    <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian"><br>
                </div>
                <button type="submit" class="btn btn-primary w-100">Pinjam</button>
            </div>
        </form>
    </div>

@endsection
