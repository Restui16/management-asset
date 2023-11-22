<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;

class MonitoringAssetController extends Controller
{
    public function index()
    {
        $title = 'Monitoring Asset';
        $categoryAssets = CategoryAsset::with('Asset')->get();

        return view('monitoring_asset.index', compact('categoryAssets', 'title'));
    }
}
