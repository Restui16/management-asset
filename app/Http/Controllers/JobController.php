<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        $title = 'Jobs';
        return view('jobs.index', compact('jobs', 'title'));
    }

    public function store(StoreJobRequest $request)
    {
        $data = $request->validated();

        Job::create($data);
        return Redirect::back()->with('success', 'Job has been created');
    }

    public function update(StoreJobRequest $request, string $id)
    {
        $data = $request->validated();

        Job::find($id)->update($data);
        return Redirect::back()->with('success', 'Job has been updated');
    }

    public function destroy(string $id)
    {
        Job::find($id)->delete();

        return response()->json([
            'message' => 'Job has been deleted'
        ]);
    }
}
