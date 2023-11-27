<?php

namespace App\Charts;

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
        
            

            $monthData[] = Carbon::create()->month($i)->format('F');
            $dataTotalLoanAsset[] = $totalLoanAsset;
        }
        
        return $this->chart->barChart()
            ->setTitle('Asset Loaned')
            ->addData('Data Asset Loaned', $dataTotalLoanAsset)
            ->setXAxis($monthData);
    }
}
