<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::latest()->get();
        $title = 'Location Asset';
        return view('locations.index', compact('title', 'locations'));
    }

    public function store(StoreLocationRequest $request)
    {
        $data = $request->validated();

        Location::create($data);
        return Redirect::back()->with('success', 'Location has been created');
    }

    public function update(StoreLocationRequest $request, string $id)
    {
        $data = $request->validated();

        Location::find($id)->update($data);
        return Redirect::back()->with('success', 'Location has been updated');
    }

    public function destroy(string $id)
    {
        Location::find($id)->delete();
        return response()->json([
            'message' => 'Location has been deleted'
        ]);
    }
}
