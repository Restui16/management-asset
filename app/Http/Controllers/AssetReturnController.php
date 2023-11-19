<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReturnRequest;
use App\Http\Requests\UpdateReturnRequest;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\AssetReturn;
use App\Models\Employee;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class AssetReturnController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $returns = AssetReturn::with('loan')->latest()->get();
            return DataTables::of($returns)
                ->addIndexColumn()
                ->addColumn('action', function ($return) {
                    $showUrl = route('show.return', $return->id);
                    $editUrl = route('edit.return', $return->id);
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
                                    onclick="confirmDelete(this)" data-id="' . $return->id . '"><i class="bi bi-x"
                                        style="font-size: 1.2rem;"></i>Delete
                                </a>
                            </li>
                        </ul>
                    </div>
                    ';
                })
                ->addColumn('photoReceipt', function($return){
                    return '
                        <div class="text-center">
                            <a href="#" class="icon text-info" data-bs-toggle="modal"
                                data-bs-target="#galleryModal'.$return->id.'" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="See Photo">
                                <i class="bi bi-camera-fill" style="font-size: 1.2rem;"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['action', 'photoReceipt'])
                ->make();
        }

        $title = 'Return';
        $returns = AssetReturn::get();
        return view('returns.index', compact('title', 'returns'));
    }

    public function create()
    {
        $title = 'Create Return';

        $loans = Loan::where('return_date', null)->get();

        return view('returns.create', compact('title', 'loans' ));
    }

    public function store(StoreReturnRequest $request)
    {
        $data = $request->validated();
        $assetLoanData = AssetLoan::where('loan_id', '=' , $data['loan_id'])->get();
        // dd($assetLoanData);

        if ($request->hasFile('photo_receipt')) {
            $photo_path = $request->file('photo_receipt');
            $photo_name = uniqid() . "." . $photo_path->getClientOriginalExtension(); //jpg, jpeg, png
            $photo_path->storeAs('public/photo_receipt/return/', $photo_name);
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

        Storage::put('public/signature_return/admin/' . $signature_nameAdmin, $image_base64Admin);

        // signature borrower
        $loanEmplolyee = Loan::where('id', $request->loan_id)->with('employee')->first();
        $employee_name = $loanEmplolyee->employee->name;
        // dd($employee_name);

        $image_partsEmployee = explode(";base64,", $request->signature_employee);

        $image_type_auxEmployee = explode("image/", $image_partsEmployee[0]);
        // dd($image_type_auxEmployee);
        $image_typeEmployee = $image_type_auxEmployee[1];
        // dd($image_partsEmployee);
        $image_base64Employee = base64_decode($image_partsEmployee[1]);

        $signatureEmployee = uniqid() . '_' . $employee_name . '.' . $image_typeEmployee;

        Storage::put('public/signature_return/employee/' . $signatureEmployee, $image_base64Employee);

        $data['signature_admin'] = $signature_nameAdmin;
        $data['signature_employee'] = $signatureEmployee;

        AssetReturn::create($data);

        Loan::where('id', $data['loan_id'])->update([
            'return_date' => $request->return_date
        ]);
        // dd($assetLoanData);
        foreach ($assetLoanData as $assetLoan) {
            Asset::where('id', '=', $assetLoan->asset_id)->update([
                'status' => 'available'
            ]);
        }

        return Redirect::route('index.return')->with('success', 'Return form has been created');

    }

    public function show(string $id)
    {
        $returns = AssetReturn::find($id)->with('loan')->first();
        // dd($returns);
        $title = 'Detail Return';

        return view('returns.show', compact('title', 'returns'));
        
    }

    public function edit(string $id)
    {
        $returns = AssetReturn::find($id);
        $title = 'Edit Return';
        $loanSelected = Loan::where('id', $returns->loan_id)->first();
        $loans = Loan::where('return_date', null)->get();

        return view('returns.edit', compact('title', 'returns', 'loans', 'loanSelected'));
    }

    public function update(UpdateReturnRequest $request, string $id)
    {
        $data = $request->validated();
        $returns = AssetReturn::find($id);
        // dd($returns->loan_id);
     
        $loan = Loan::where('id', $returns->loan->id)->first();

        $assetLoanData = AssetLoan::where('loan_id', $loan->id)->get();
        // dd($assetLoanData);
        $reqAssetLoans = AssetLoan::where('loan_id', $request->loan_id)->get();
        // dd($reqAssetLoans);
        

        if ($request->loan_id != $loan->id){
            Loan::where('id', $returns->loan->id)->update([
                'return_date' => null
            ]);

            Loan::where('id', $request->loan_id)->update([
                'return_date' => $request->return_date
            ]);

            foreach ($assetLoanData as $assetLoan) {
                Asset::where('id', '=', $assetLoan->asset_id)->update([
                    'status' => 'loaned'
                ]);
            }

            foreach ($reqAssetLoans as $reqAssetLoan) {
                Asset::where('id', '=', $reqAssetLoan->asset_id)->update([
                    'status' => 'available'
                ]);
            }
        } 
        

        if ($request->hasFile('photo_receipt')) {
            $file = $request->file('photo_receipt');
            $fileName = uniqid()."_". "." .$file->getClientOriginalExtension();
            $file->storeAs('public/photo_receipt/return/', $fileName); // public/back/12314weq.jpg

            //unlink img/delete oldImg
            Storage::delete('public/photo_receipt/return/'. $request->oldPhoto);

            $data['photo_receipt'] = $fileName;
        } else {
            $data['photo_receipt'] = $request->oldPhoto_receipt;
        }

        $returns->update($data);
        return Redirect::route('index.return')->with('succes', 'Return form has been updated');
        
    }

    public function destroy(string $id)
    {
        $assetReturn = AssetReturn::find($id);
        // dd($assetReturn);
        

        Storage::delete('public/signature_return/admin/' . $assetReturn->signature_admin);
        Storage::delete('public/signature_return/employee/' . $assetReturn->signature_employee);

        $assetReturn->delete();

        $loan = Loan::where('id', $assetReturn->loan_id)->first();
        // dd($loanId);
        $assetLoanData = AssetLoan::where('loan_id', $loan->id)->get();
        // dd($assetLoanData);
        foreach ($assetLoanData as $assetLoan) {
            Asset::where('id', '=', $assetLoan->asset_id)->update([
                'status' => 'loaned'
            ]);
        }

       $loan->update([
            'return_date' => null
       ]);

        if ($assetReturn->photo_receipt != null) {
            Storage::delete('public/photo_receipt/return/'. $assetReturn->photo_receipt);
        }

        return response()->json([
            'message' => 'Return form has been deleted'
        ]);


    }
}
