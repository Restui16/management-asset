<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class VendorController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()){
            $vendors = Vendor::latest()->get();
            return DataTables::of($vendors)
            ->addIndexColumn()
            ->addColumn('action', function($vendor){
                $editUrl = route('edit.vendor', $vendor->id);
                return'
                <a href="'.$editUrl.'" class="icon me-3">
                    <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                    Edit 
                </a>

                <a href="#" class="icon text-danger"
                    onclick="confirmDelete(this)" data-id="'.$vendor->id.'"><i class="bi bi-x"
                        style="font-size: 1.2rem;"></i>Delete
                </a>
                ';
            })
            ->rawColumns(['action'])
            ->make();
        }

        $title = 'Vendors';
        return view('vendors.index', compact('title'));
    }

    public function create()
    {
        $title = 'Create Vendor';
        return view('vendors.create', compact('title'));
    }

    public function store(StoreVendorRequest $request)
    {
        $data = $request->validated();
        
        Vendor::create($data);

        return Redirect::route('index.vendor')->with('success', 'Vendor has been created');
    }

    public function edit(string $id)
    {
        $vendors = Vendor::find($id);

        $title = 'Edit Vendor';
        return view('vendors.edit', compact('title','vendors'));
    }

    public function update(StoreVendorRequest $request, string $id)
    {
        $data = $request->validated();

        Vendor::find($id)->update($data);
        return Redirect::route('index.vendor')->with('success', 'Vendor has been updated');
    }

    public function destroy(string $id)
    {
        $data = Vendor::find($id);
        $data->delete();

        return response()->json([
            'message' => 'Vendor has been deleted'
        ]);
    }
}
