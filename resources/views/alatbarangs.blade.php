@extends('layouts.mainlayout')

@section('title', 'Alat Barang')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alat dan Barang</h1>
    </div>

    @if (Auth::user()->role_id == 1)
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addAlatbarangModal">Tambah
            Alat dan Barang</a>

        <div class="mt-5 mw-50">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="table-responsive my-5">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="text-align: center">
                        <th>No.</th>
                        <th>Kode Alat dan Barang</th>
                        <th>Nama Alat dan Barang</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alatbarangs as $items)
                        <tr style="text-align: center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $items->kode_alatbarang }}</td>
                            <td>{{ $items->nama }}</td>
                            <td>
                                @foreach ($items->categories as $category)
                                    {{ $category->nama }}
                                @endforeach
                            </td>
                            <td>{{ $items->status }}</td>
                            <td style="display: block">
                                @if ($items->cover != '')
                                    <img src="{{ asset('storage/cover/' . $items->cover) }}" alt="" width="300px"
                                        height="300px">
                                @else
                                    <img src="{{ asset('img/Cover.jpg') }}" alt="" width="300px height="300px">
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-warning btn-edit" data-toggle="modal"
                                    data-target="#editAlatbarangModal-{{ $items->slug }}">Edit</a>
                                <a href="" class="btn btn-danger btn-delete" data-toggle="modal"
                                    data-target="#deleteAlatbarangModal-{{ $items->slug }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal Tambah Alat dan Barang -->
        <div class="modal fade" id="addAlatbarangModal" tabindex="-1" role="dialog"
            aria-labelledby="addAlatbarangModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAlatbarangModalLabel">Tambah Alat dan Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="alatbarangs" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="code" class="form-label">Kode</label>
                                <input type="text" class="form-control" name="kode_alatbarang" id="code"
                                    placeholder="Kode Alat dan Barang" value="{{ old('kode_alatbarang') }}">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Nama Alat dan Barang" value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label for="category" class="form-label">Kategori</label>
                                <select name="categories[]" id="category" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="img" class="form-label">Gambar</label>
                                <input type="file" name="img" class="form-control-file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($alatbarangs as $data)
            <!-- Modal Edit Alatbarang -->
            <div class="modal fade" id="editAlatbarangModal-{{ $data->slug }}" tabindex="-1" role="dialog"
                aria-labelledby="editAlatbarangModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAlatbarangModalLabel">Edit Alat Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/alatbarangs/edit{{ $data->slug }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nama" id="nama">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="code" class="form-label">Kode</label>
                                    <input type="text" class="form-control" name="kode_alatbarang" id="code"
                                        placeholder="Kode Alat dan Barang" value="{{ $data->kode_alatbarang }}">
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Alat dan Barang" value="{{ $data->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select name="categories[]" id="category" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="form-label">Kategori</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Pilih Status</option>
                                        <option value="stok ada">Stock Ada</option>
                                        <option value="sedang di pinjam">Sedang di pinjam</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="img" class="form-label">Gambar</label>
                                    <input type="file" class="form-control-file" name="img" id="img">
                                </div>
                                <div class="mb-3">
                                    <label for="currentCategory">Kategori Saat Ini</label>
                                    <ul>
                                        @foreach ($data->categories as $category)
                                            <li>{{ $category->nama }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Hapus Kategori -->
            <div class="modal fade" id="deleteAlatbarangModal-{{ $data->slug }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteAlatbarangModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAlatbarangLabel">Hapus Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/alatbarangs/delete' . $data->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="nama" id="nama">
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Alat Barang ini? {{ $data->nama }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <form action="{{ url('/kategori/delete' . $data->slug) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="mt-5 mw-50">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="table-responsive my-5">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="text-align: center">
                        <th>No.</th>
                        <th>Kode Alat dan Barang</th>
                        <th>Nama Alat dan Barang</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alatbarangs as $items)
                        <tr style="text-align: center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $items->kode_alatbarang }}</td>
                            <td>{{ $items->nama }}</td>
                            <td>
                                @foreach ($items->categories as $category)
                                    {{ $category->nama }}
                                @endforeach
                            </td>
                            <td>{{ $items->status }}</td>
                            <td style="display: block">
                                @if ($items->cover != '')
                                    <img src="{{ asset('storage/cover/' . $items->cover) }}" alt=""
                                        width="300px" height="300px">
                                @else
                                    <img src="{{ asset('img/Cover.jpg') }}" alt="" width="300px height="300px">
                                @endif
                            </td>
                            <td>
                                <a href="/alatbarang-pinjam{{ $items->id }}" class="btn btn-primary">Pinjam</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
