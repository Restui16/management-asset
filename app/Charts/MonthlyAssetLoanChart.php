<?php

namespace App\Charts;

use App\Models\Loan;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyAssetLoanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $loans = Loan::with('asset')->get();
        
        return $this->chart->barChart()
            ->setTitle('Asset Loaned')
            ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
            ->addData('Boston', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
