@extends('layouts.mainlayout')

@section('title', 'Kategori')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
    </div>

    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Tambah
        Kategori</a>

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
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $items)
                    <tr style="text-align: center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $items->nama }}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-edit" data-toggle="modal"
                                data-target="#editCategoryModal-{{ $items->slug }}">Edit</a>
                            <a href="" class="btn btn-danger btn-delete" data-toggle="modal"
                                data-target="#deleteCategoryModal-{{ $items->slug }}">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="kategori" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Nama Kategori">
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

    @foreach ($categories as $data)
        <!-- Modal Edit Kategori -->
        <div class="modal fade" id="editCategoryModal-{{ $data->slug }}" tabindex="-1" role="dialog"
            aria-labelledby="editCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/kategori/edit' . $data->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="nama" id="nama">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Kategori Baru</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $data->nama }}" placeholder="Nama Kategori Baru">
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
        <div class="modal fade" id="deleteCategoryModal-{{ $data->slug }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCategoryModalLabel">Hapus Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/kategori/delete' . $data->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="nama" id="nama">
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus kategori ini? {{ $data->nama }}
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

@endsection
