<!DOCTYPE html>
<html>
<head>
    <title>Log Peminjaman</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Log Peminjaman</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr style="text-align: center">
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>Alat dan Barang</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentlogs as $items)
                    <tr style="text-align: center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $items->user->namapengguna }}</td>
                        <td>{{ $items->alatbarang->nama }}</td>
                        <td>{{ $items->tanggal_peminjaman }}</td>
                        <td>{{ $items->tanggal_pengembalian }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
