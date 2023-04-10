<?php

namespace App\Http\Controllers;

use App\Models\PersonalExpenses;
use App\Models\PersonalIncomes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use stdClass;

class dashboardController extends Controller
{
    function calculateAvg(array $values): float
    {
        $count = count($values);
        return $count > 0 ? array_sum($values) / $count : 0;
    }


    private function getDashboardData($selectedMonth = null, $selectedYear = null){

        $year = $selectedYear ?? date('Y');
        $month = $selectedMonth ?? date('m');

        // if(request()->ajax()){
        //     dd($month, $year);
        // }

        $dashboardData = [
            'incomes' => [
                'list' => PersonalIncomes::getByYear($year)->get(),
                'totalInYear' => 0,
                'byMonth' => [],
            ],
            'expenses' => [
                'list' => PersonalExpenses::getByYear($year)->get(),
                'totalInYear' => 0,
                'byMonth' => [],
            ],
            'selectedMonth' => $month
        ];

        // Agrupa as receitas e despesas por mês
        foreach (['incomes', 'expenses'] as $type) {
            $dashboardData[$type]['byMonth'] = $dashboardData[$type]['list']
                ->groupBy(function ($item) {
                    return date('m', strtotime($item->payment_date));
                })
                ->map(function ($group) {
                    return $group->sum('value');
                })
                ->toArray();
        }

        // Calcula o total anual de receitas e despesas
        $dashboardData['incomes']['totalInYear'] = $dashboardData['incomes']['list']->sum('value');
        $dashboardData['expenses']['totalInYear'] = $dashboardData['expenses']['list']->sum('value');

        // Calcula a média mensal de receitas e despesas
        $dashboardData['incomes']['avg'] = $this->calculateAvg($dashboardData['incomes']['byMonth']);
        $dashboardData['expenses']['avg'] = $this->calculateAvg($dashboardData['expenses']['byMonth']);
        // dd($dashboardData);
        return $dashboardData;
    }

    function show()
    {
        $dashboardData = $this->getDashboardData();

        return view('dashboard.show',['dashboardData' => $dashboardData]);
    }

    function populate($mes, $ano)
    {

        $dashboardData = $this->getDashboardData($mes, $ano);
        // dd($dashboardData);
        return response()->json($dashboardData);
    }



}
