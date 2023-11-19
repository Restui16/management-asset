<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryAssetRequest;
use App\Models\CategoryAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryAssetController extends Controller
{
    public function index()
    {
        $categories = CategoryAsset::latest()->get();
        $title = 'Category Asset';
        return view('category_asset.index', compact('categories', 'title'));
    }

    public function store(StoreCategoryAssetRequest $request)
    {
        $data = $request->validated();

        CategoryAsset::create($data);
        return Redirect::back()->with('success', 'Category has been created');
    }

    public function update(StoreCategoryAssetRequest $request, string $id)
    {
        $data = $request->validated();

        CategoryAsset::find($id)->update($data);
        return Redirect::back()->with('success', 'Category has been updated');
    }

    public function destroy(string $id)
    {
        CategoryAsset::find($id)->delete();

        return response()->json([
            'message' => 'Category has been deleted'
        ]);
    }
}
