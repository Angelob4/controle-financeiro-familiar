<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\PersonalExpensesController;
use App\Http\Controllers\PersonalIncomesController;
use App\Models\PersonalExpenses;
use App\Models\PersonalIncomes;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('dashboard',[dashboardController::class, 'show'])->name('dashboard.index');
Route::get('proventos', [PersonalIncomesController::class, 'show'])->name('income.index');
Route::get('despesas', [PersonalExpensesController::class, 'show'])->name('expense.index');

// ajax routes
Route::post('ajax/storage/incomes', [PersonalIncomesController::class, 'storage'])->name('personalExpenses.storage');
Route::post('ajax/storage/expenses', [PersonalExpensesController::class, 'storage'])->name('personalExpenses.storage');
Route::get('ajax/atualizar-dashboard/mes/{mes}/ano/{ano}', [dashboardController::class, 'populate']);
Route::get('ajax/get/incomes', [PersonalIncomesController::class, 'get']);
Route::get('ajax/get/expenses', [PersonalExpensesController::class, 'get']);

Route::get('teste/mes/{mes}/ano/{ano}', function($mes, $ano){

    $personalExpenses = PersonalExpenses::whereMonth('payment_date', $mes)->whereYear('payment_date', $ano)->get();
    $personalIncomes = PersonalIncomes::whereMonth('payment_date', $mes)->whereYear('payment_date', $ano)->get();



});
