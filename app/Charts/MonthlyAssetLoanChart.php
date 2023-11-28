<?php

namespace App\Charts;

use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\Loan;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class MonthlyAssetLoanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // dd($assetLoan);
        $year = date('Y');
        $month = date('m');


        for ($i = 1; $i <= $month; $i++) { 
            $totalLoanAsset = AssetLoan::whereHas('loan', function ($query) use ($year, $i) {
                $query->whereYear('loan_date', $year)->whereMonth('loan_date', $i);
            })->count('asset_id');
            
            $totalAsset = Asset::whereYear('purchase_date', $year)->whereMonth('purchase_date', $i)->count('id');
            

            $monthData[] = Carbon::create()->month($i)->format('F');
            $dataTotalLoanAsset[] = $totalLoanAsset;
            $dataTotalAsset[] = $totalAsset;
        }
        
        return $this->chart->barChart()
            ->setTitle('Data Asset')
            ->addData('Asset Loaned', $dataTotalLoanAsset)
            ->addData('Asset', $dataTotalAsset)
            ->setXAxis($monthData);
    }
}
