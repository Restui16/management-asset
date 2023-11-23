<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyAssetLoanChart;
use App\Models\Asset;
use App\Models\CategoryAsset;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(MonthlyAssetLoanChart $chart)
    {
        $totalAsset = Asset::count();
        $assetLoan = Asset::where('status', 'loaned')->count();;
        $assetAvailable = Asset::where('status', 'available')->count();
        $loanEmployees = Loan::with('employee')->latest()->take(3)->get();

        $mAssetLoanchart = $chart->build();
        // dd($loanEmployee);
        // dd($assetLoan);
        $totalLoans = Loan::count();
        return view('dashboard', compact('totalAsset', 'totalLoans', 'assetLoan', 'assetAvailable', 'loanEmployees', 'mAssetLoanchart'));
    }
}
