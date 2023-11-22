<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAsset = Asset::count();
        return view('dashboard', compact('totalAsset'));
    }
}
