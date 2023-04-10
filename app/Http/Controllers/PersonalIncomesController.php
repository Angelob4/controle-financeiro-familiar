<?php

namespace App\Http\Controllers;

use App\Models\PersonalIncomes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PersonalIncomesController extends Controller
{

    private function getIncomesByMonthInYear($month = false, $year = false){

        $month = $month
            ? $month
            :now()->month;

        $year = $year
            ? $year
            : now()->year;

        return PersonalIncomes::getByMonthYear($month, $year)->get();
    }

    function show () {

        $incomes = $this->getIncomesByMonthInYear()
            ->filter(function($income){
                $income->day = Carbon::parse($income->payment_date)->day;
                return  $income;
            });

        return view('income.show', [
            'incomes' => $incomes
        ]);
    }

    function storage(request $request){

        $income = new PersonalIncomes([
            'name'         => $request->name,
            'value'        => brToDouble($request->value),
            'payment_date' => date($request->date_to_paid),
            'is_income'    => $request->is_already_paid ? true : false,
        ]);

        $income->save();

        return  response('',200);
    }

    function get() {
        $incomes = $this->getIncomesByMonthInYear(request()->month, request()->year)->filter(function($income){
            $income->day = Carbon::parse($income->payment_date)->day;
            return  $income;
        });

        return $incomes;
    }
}
