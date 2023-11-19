<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::with('employee')->latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function($user){
                    $editUrl = route('edit.user', $user->id);
                    return'

                    <a href="'.$editUrl.'" class="icon me-3">
                        <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                        Edit 
                    </a>

                    <a href="#" class="icon text-danger"
                        onclick="confirmDelete(this)" data-id="'.$user->id.'"><i class="bi bi-x"
                            style="font-size: 1.2rem;"></i>Delete
                    </a>
                    ';
                })
                ->make();
        }

        $title = 'Users';
        $users = User::latest()->get(); 
        return view('users.index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'Create User';
        $employees = Employee::where('user_id', null)->get();
        return view('users.create', compact('title', 'employees'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // dd($data['role']);

        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($request['password']);
        $data['remember_token'] = Str::random(10);

        $user = User::create($data);

        if($request->employee_id){
            Employee::where('id', $request->employee_id)->update([
                'user_id' => $user->id 
            ]);
        }

        return Redirect::route('index.user')->with('success', 'User has been created');
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();

        return response()->json([
            'message' => 'User has been deleterd'
        ]);
    }
}
