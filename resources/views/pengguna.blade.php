@extends('layouts.mainlayout')

@section('title', 'Pengguna')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
    </div>

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
                    <th>Nama Pengguna</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengguna as $items)
                    <tr style="text-align: center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $items->namapengguna }}</td>
                        <td>
                            @if ($items->telepon)
                                {{ $items->telepon }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $items->alamat }}</td>
                        <td>{{ $items->status }}</td>
                        <td class="text-center">
                            @if ($items->status == 'inactive')
                                <a href="{{ url('/pengguna/aktifkan' . $items->slug) }}" class="btn btn-info">Aktifkan User</a>
                            @else
                                <a href="{{ url('/pengguna/nonaktifkan' . $items->slug) }}" class="btn btn-danger">Non-aktifkan User</a>
                            @endif
                            <a href="" class="btn btn-warning btn-edit" data-toggle="modal"
                                data-target="#editUserModal-{{ $items->slug }}">Edit</a>
                            <a href="" class="btn btn-danger btn-delete" data-toggle="modal"
                                data-target="#deleteUserModal-{{ $items->slug }}">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($pengguna as $data)
    <!-- Modal Edit Kategori -->
        <div class="modal fade" id="editUserModal-{{ $data->slug }}" tabindex="-1" role="dialog"
            aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/pengguna/edit' . $data->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama" id="nama">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namapengguna" class="form-label">Nama Pengguna</label>
                                <input type="text" class="form-control" name="namapengguna" id="namapengguna"
                                    value="{{ $data->namapengguna }}" placeholder="Nama Pengguna Baru">
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" name="telepon" id="telepon"
                                    value="{{ $data->telepon }}" placeholder="Telepon Baru">
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    value="{{ $data->alamat }}" placeholder="Alamat Baru">
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

        <!-- Modal Hapus Pengguna -->
        <div class="modal fade" id="deleteUserModal-{{ $data->slug }}" tabindex="-1" role="dialog"
            aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Hapus Pengguna</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/pengguna/delete' . $data->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="nama" id="nama">
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus pengguna ini? {{ $data->namapengguna }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <form action="{{ url('/pengguna/delete' . $data->slug) }}" method="POST">
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
