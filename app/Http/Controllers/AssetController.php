<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Models\Asset;
use App\Models\CategoryAsset;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $assets = Asset::with(['Vendor', 'CategoryAsset', 'Location'])->latest()->get();
            return DataTables::of($assets)
                ->addIndexColumn()
                ->addColumn('condition_asset', function($asset){
                    if($asset->condition == 'good'){
                        return '<span class="badge text-bg-success">Good</span>';
                    } elseif($asset->condition == 'not bad') {
                        return '<span class="badge text-bg-secondary">Not Bad</span>';
                    } else {
                        return '<span class="badge text-bg-warning">Bad</span>';
                    }
                })
                ->addColumn('status_asset', function($asset){
                    if($asset->status == 'available'){
                        return '<span class="badge text-bg-success">Available</span>';
                    } else {
                        return '<span class="badge text-bg-secondary">Loaned</span>';
                    }
                })
                ->addColumn('action', function($asset){
                    $showUrl = route('show.asset', $asset->id);
                    $editUrl = route('edit.asset', $asset->id);
                    return'
                    <div class="dropstart">
                        <a class="btn btn-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="'.$showUrl.'" class="dropdown-item icon text-info me-3">
                                    <i class="bi bi-eye" style="font-size: 1.2rem;"></i>
                                    Show
                                </a>
                            </li>
                            <li>
                                <a href="'.$editUrl.'" class="dropdown-item icon me-3">
                                    <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                                    Edit 
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item icon text-danger"
                                    onclick="confirmDelete(this)" data-id="'.$asset->id.'"><i class="bi bi-x"
                                        style="font-size: 1.2rem;"></i>Delete
                                </a>
                            </li>
                        </ul>
                    </div>

                    
                    ';
                })
                ->rawColumns(['action', 'condition_asset', 'status_asset'])
                ->make();
        };
        $title = 'Asset';
        return view('assets.index', compact('title'));
    }

    public function getLimitedAssets()
    {
        // Mengambil 10 data terbaru dari tabel assets
        $assets = Asset::where('status', 'available')->latest()->take(10)->get();

        return response()->json($assets);
    }

    public function create()
    {
        $title = 'Create Asset';
        $vendors = Vendor::get();
        $locations = Location::get();
        $categories = CategoryAsset::get();

        return view('assets.create', compact('title', 'vendors', 'locations', 'categories'));
    }

    public function store(StoreAssetRequest $request)
    {
        $data = $request->validated();

        Asset::create($data);
        return Redirect::route('index.asset')->with('success', 'Asset has been created');
    }

    public function edit(string $id)
    {
        $assets = Asset::find($id);
        $title = 'Edit Asset';
        $vendors = Vendor::get();
        $locations = Location::get();
        $categories = CategoryAsset::get();

        return view('assets.edit', compact('title', 'vendors', 'locations', 'categories', 'assets'));
    }

    public function update(StoreAssetRequest $request, string $id)
    {
        $data = $request->validated();

        Asset::find($id)->update($data);
        return Redirect::route('index.asset')->with('success', 'Asset has been updated');
    }

    public function show(string $id)
    {
        $assets = Asset::find($id);
        $title = 'Detail Asset';
        return view('assets.show', compact('title', 'assets'));
    }

    public function destroy(string $id)
    {
        Asset::find($id)->delete();
        
        return response()->json([
            'message' => 'Asset has been deleted'
        ]);
    }
}
