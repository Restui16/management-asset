<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('employee')->latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($user) {
                    $editUrl = route('edit.user', $user->id);
                    if (Auth::user()->role == "superadmin") {
                        if ($user->id != auth()->user()->id) {
                            return '

                    <a href="' . $editUrl . '" class="icon me-3">
                        <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                        Edit 
                    </a>

                    <a href="#" class="icon text-danger"
                        onclick="confirmDelete(this)" data-id="' . $user->id . '"><i class="bi bi-x"
                            style="font-size: 1.2rem;"></i>Delete
                    </a>
                    ';
                        }
                    } elseif (Auth::user()->role == 'admin') {
                        if ($user->role == 'staff' || $user->role == 'admin') {
                            return '

                    <a href="' . $editUrl . '" class="icon me-3">
                        <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                        Edit 
                    </a>

                    <a href="#" class="icon text-danger"
                        onclick="confirmDelete(this)" data-id="' . $user->id . '"><i class="bi bi-x"
                            style="font-size: 1.2rem;"></i>Delete
                    </a>
                    ';
                        }
                    }
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

        if ($request->employee_id) {
            Employee::where('id', $request->employee_id)->update([
                'user_id' => $user->id
            ]);
        }

        return Redirect::route('index.user')->with('success', 'User has been created');
    }

    public function edit(string $id)
    {

        $users = User::find($id);
        $title = 'Edit User';
        $employees = Employee::where('user_id', null)->get();

        return view('users.edit', compact('title', 'users', 'employees'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();

        $user = User::find($id);


        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        if ($request->employee_id != $user->employee_id) {
            Employee::where('id', $request->employee_id)->first()->update([
                'user_id' => $user->id
            ]);
        }

        $user->update($data);

        return Redirect::route('index.user')->with('success', 'User has been updated');
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();

        return response()->json([
            'message' => 'User has been deleterd'
        ]);
    }
}
