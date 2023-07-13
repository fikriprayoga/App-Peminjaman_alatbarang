<?php

namespace App\Http\Controllers;

use App\Models\Alatbarangs;
use App\Models\Category;
use App\Models\Rentlogs;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $alatbarangCount = Alatbarangs::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentlogs = Rentlogs::with(['user', 'alatbarang'])->get();
        return view('dashboard', ['alatbarang_count' => $alatbarangCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'rentlogs' => $rentlogs]);
    }
}
