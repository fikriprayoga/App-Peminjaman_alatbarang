<?php

namespace App\Http\Controllers;

use App\Models\Alatbarangs;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $alatbarangs = Alatbarangs::all();
        return view('alatbarangs-list', ['alatbarangs' => $alatbarangs]);
    }
}
