<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\Employee;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $loans = Loan::with('asset', 'employee')->latest()->get();
            return DataTables::of($loans)
                ->addIndexColumn()
                ->addColumn('action', function ($loan) {
                    $showUrl = route('show.loan', $loan->id);
                    $editUrl = route('edit.loan', $loan->id);
                    return '
                    <div class="dropstart">
                        <a class="btn btn-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="' . $showUrl . '" class="dropdown-item icon text-info me-3">
                                    <i class="bi bi-eye" style="font-size: 1.2rem;"></i>
                                    Show
                                </a>
                            </li>
                            <li>
                                <a href="' . $editUrl . '" class="dropdown-item icon me-3">
                                    <i class="bi bi-pencil-fill" style="font-size:0.8rem;"></i>
                                    Edit 
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item icon text-danger"
                                    onclick="confirmDelete(this)" data-id="' . $loan->id . '"><i class="bi bi-x"
                                        style="font-size: 1.2rem;"></i>Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                    ';
                })
                ->addColumn('returnDate', function ($loan) {
                    if ($loan->return_date == null) {
                        return '
                            <span class="badge text-bg-secondary">Empty</span>
                        ';
                    } else {
                        return '<span class="badge text-bg-success">' . $loan->return_date . '</span>';
                    }
                })
                ->addColumn('photoReceipt', function($loan){
                    return '
                        <div class="text-center">
                            <a href="#" class="icon text-info" data-bs-toggle="modal"
                                data-bs-target="#galleryModal'.$loan->id.'" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="See Photo">
                                <i class="bi bi-camera-fill" style="font-size: 1.2rem;"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'returnDate', 'photoReceipt'])
                ->make();
        }

        $title = 'Loans';
        $loans = Loan::get();

        return view('loans.index', compact('title', 'loans'));
    }

    public function create()
    {
        $assets = Asset::where('status', '=', 'available')->get();
        $employees = Employee::get();
        $title = 'Create Loan';
        return view('loans.create', compact('title', 'assets', 'employees'));
    }

    public function store(StoreLoanRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        $assetsIds = $request->asset_id;
        // dd($assetsIds);

        if ($request->hasFile('photo_receipt')) {
            $photo_path = $request->file('photo_receipt');
            $photo_name = uniqid() . "." . $photo_path->getClientOriginalExtension(); //jpg, jpeg, png
            $photo_path->storeAs('public/photo_receipt/loan/', $photo_name);
            $data['photo_receipt'] = $photo_name;
        }

        // signature Admin
        $admin_name = Auth::user()->name;
        // dd($admin_name);
        $image_partsAdmin = explode(";base64,", $request->signature_admin);

        $image_type_auxAdmin = explode("image/", $image_partsAdmin[0]);
        // dd($image_type_aux);
        $image_typeAdmin = $image_type_auxAdmin[1];
        $image_base64Admin = base64_decode($image_partsAdmin[1]);

        $signature_nameAdmin = uniqid() . '_' . $admin_name . '.' . $image_typeAdmin;

        Storage::put('public/signature_loan/admin/' . $signature_nameAdmin, $image_base64Admin);

        // signature borrower
        $employee_id = Employee::where('id', '=', $request->employee_id)->first();
        $employee_name = $employee_id->name;
        // dd($employee_name);

        $image_partsEmployee = explode(";base64,", $request->signature_employee);

        $image_type_auxEmployee = explode("image/", $image_partsEmployee[0]);
        // dd($image_type_auxEmployee);
        $image_typeEmployee = $image_type_auxEmployee[1];
        // dd($image_partsEmployee);
        $image_base64Employee = base64_decode($image_partsEmployee[1]);

        $signatureEmployee = uniqid() . '_' . $employee_name . '.' . $image_typeEmployee;

        Storage::put('public/signature_loan/employee/' . $signatureEmployee, $image_base64Employee);

        $data['signature_admin'] = $signature_nameAdmin;
        $data['signature_employee'] = $signatureEmployee;
        $data['pic'] = Auth::user()->name;
        // dd($data);
        $loan = Loan::create($data);
        // dd($loan);

        // Input multiple AssetLoans
        foreach ($assetsIds as $assetId) {
            AssetLoan::create([
                'loan_id' => $loan->id,
                'asset_id' => $assetId
            ]);

            // Update status as "loaned" for each asset
            Asset::where('id', '=', $assetId)->update([
                'status' => 'loaned'
            ]);
        }

        return Redirect::route('index.loan')->with('success', 'Loan has been created');
    }

    public function show(string $id)
    {
        $loans = Loan::find($id);
        $assetLoans = AssetLoan::where('loan_id', $loans->id)->get();
        $title = 'Detail Loan';
        return view('loans.show', compact('loans', 'title', 'assetLoans'));
    }

    public function edit(string $id)
    {
        $loans = Loan::find($id);
        $assets = Asset::where('status', '=', 'available')->get();
        $assetLoans = AssetLoan::get();
        $employees = Employee::get();
        $title = 'Edit Loan';
        return view('loans.edit', compact('title', 'loans', 'employees', 'assets', 'assetLoans'));

    }

    public function destroy(string $id)
    {
        $loans = Loan::find($id);
        
        $assetLoanData = AssetLoan::where('loan_id', '=' , $loans->id)->get();
        // dd($assetLoanData);
        foreach ($assetLoanData as $assetLoan) {
            Asset::where('id', '=', $assetLoan->asset_id)->update([
                'status' => 'available'
            ]);
        }

        if ($loans->photo_receipt != null) {
            Storage::delete('public/photo_receipt/loan/'. $loans->photo_receipt);
        }

        Storage::delete('public/signature_loan/admin/' . $loans->signature_admin);
        Storage::delete('public/signature_loan/employee/' . $loans->signature_employee);

        $loans->delete();

        return response()->json([
            'message' => 'Loan has been deleted'
        ]);
    }
}
