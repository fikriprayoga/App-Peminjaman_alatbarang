<?php

namespace App\Http\Controllers;

use App\Models\Alatbarangs;
use App\Models\Rentlogs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        $rentlogs = Rentlogs::with(['user', 'alatbarang'])->get();
        return view('rentlogs', ['rentlogs' => $rentlogs]);
    }
}
