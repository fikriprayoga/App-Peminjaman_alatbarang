<?php

namespace App\Http\Controllers;

use App\Models\Rentlogs;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{
    public function cetakPdf()
    {
        $rentlogs = Rentlogs::with(['user', 'alatbarang'])->get();

        view()->share('rentlogs', $rentlogs);
        $pdf = PDF::loadview('cetak-pdf');
        return $pdf->download('Laporan Peminjaman.pdf');
    }

}
