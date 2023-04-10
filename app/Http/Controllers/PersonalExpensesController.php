<?php

namespace App\Http\Controllers;

use App\Models\PersonalExpenses;
use App\Models\PersonalIncomes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonalExpensesController extends Controller
{

    public function storage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'value' => 'required',
                'date_to_paid' => 'date|required',
                'transection_type' => 'string|required',
            ],

            [
                'required' => 'Há campos obrigatórios que não foram preenchidos',
                'date' => 'A data está incorreta!'
            ]
        );

        if ($validator->fails())
            return response()->json([
                $validator->errors(),
                $request->all(),
        ]);

        $expense = new PersonalExpenses([
            'name'         => $request->name,
            'value'        => brToDouble($request->value),
            'payment_date' => date($request->date_to_paid),
            'is_paid'      => $request->is_already_paid ? true : false,
        ]);

        $expense->save();

        return response('',200);
    }

    private function getExpensesByMonthInYear($month = false, $year = false)
    {
        $month = $month
            ? $month
            :now()->month;

        $year = $year
            ? $year
            : now()->year;

        return PersonalExpenses::getByMonthYear($month, $year)->orderBy('payment_date')->get();
    }

    function show ()
    {
        $expenses = $this->getExpensesByMonthInYear()
            ->filter(function($expense){
                $expense->day = Carbon::parse($expense->payment_date)->day;
                return  $expense;
            });

        return view('expenses.show', [
            'expenses' => $expenses
        ]);
    }

    function get() {
        $expenses = $this->getExpensesByMonthInYear(request()->month, request()->year)->filter(function($expense){
            $expense->day = Carbon::parse($expense->payment_date)->day;
            return  $expense;
        });

        return $expenses;
    }
}
