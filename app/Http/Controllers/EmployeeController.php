<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::with(['Department', 'Job', 'user'])->latest()->get();
            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function ($employee) {
                    $showUrl = route('show.employee', $employee->id);
                    $editUrl = route('edit.employee', $employee->id);
                    return '

                    <a href="' . $showUrl . '" class="icon text-info me-3">
                        <i class="bi bi-eye" style="font-size: 1.2rem;"></i>
                        Show
                    </a>

                    <a href="' . $editUrl . '" class="icon me-3">
                        <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                        Edit 
                    </a>

                    <a href="#" class="icon text-danger"
                        onclick="confirmDelete(this)" data-id="' . $employee->id . '"><i class="bi bi-x"
                            style="font-size: 1.2rem;"></i>Delete
                    </a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        // dd($employees);

        $title = 'Employee';
        return view('employees.index', compact('title'));
    }

    public function create()
    {
        $departments = Department::get();
        $jobs = Job::get();
        $title = 'Create Employee';
        $users = User::where('employee_id', null)->get();

        return view('employees.create', compact('departments', 'jobs', 'title', 'users'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        $employeeName = $data['name'];

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . "_" . $employeeName . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_profile', $fileName);
            $data['photo'] = $fileName;
        }


        $employee =  Employee::create($data);

        if ($request->user_id) {
            User::where('id', $request->user_id)->update([
                'employee_id' => $employee->id
            ]);
        }

        return Redirect::route('index.employee')->with('success', 'Employee has been created');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $employees = Employee::find($id);
        // dd($employees->user);
        $departments = Department::orderBy('name', 'asc')->get();
        $jobs = Job::orderBy('job_title', 'asc')->get();
        $users = User::where('employee_id', null)->get();
        $title = 'Edit Employee';
        // dd($users);
        // dd($employees);
        return view('employees.edit', compact('employees', 'departments', 'jobs', 'title', 'users'));
    }

    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $data = $request->validated();

        // dd($data);
        $employeeName = $data['name'];
        $employee = Employee::find($id);
        // dd($employee);


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . "_" . $employeeName . "." . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_profile', $fileName); // public/back/12314weq.jpg

            //unlink img/delete oldImg
            Storage::delete('public/foto_profile/' . $request->oldPhoto);

            $data['photo'] = $fileName;
        } else {
            $data['photo'] = $request->oldPhoto;
        }



        if ($request->user_id != $employee->user_id) {
            User::where('id', $request->user_id)->first()->update([
                'employee_id' => $employee->id
            ]);


            // User::where('id', $employee->user_id)->first()->update([
            //     'employee_id' => null
            // ]);
        }

        $employee->update($data);





        return Redirect::route('index.employee')->with('success', 'Employee has been updated');
    }

    public function destroy(string $id)
    {
        $data =  Employee::find($id);
        Storage::delete('public/foto_profile/' . $data->photo);

        $data->delete();

        return response()->json([
            'message' => 'Employee has been deleted'
        ]);
    }
}
