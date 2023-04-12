@extends('layouts.app')

@section('title', 'Dahsboard')

@section('body_id','dashboard')

@section('content')
    <x-col class="pb-3">
        <x-col-row>

            <x-row class="g-2 mt-8">
                <x-col class="col-4 d-flex align-items-center">
                    <h1>Dashboard</h1>
                </x-col>
                <x-col class="py-3 ">
                    <x-select.month />
                </x-col>
                <x-col class="py-3">
                    <x-select.year />
                </x-col>
            </x-row>

        </x-col-row>

        <x-row class="g-2">
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Ganho Total Mês</h5>
                        <p class="card-text text-start"><span id="total-incomes-month"
                                class="text-success display-6">
                            </span></p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Despesas Totais do Mês</h5>
                        <div class="card-text text-start"><span id="total-expenses-month"
                                class="text-danger display-6">
                            </span></div>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Líquido</h5>
                        <div class="card-text text-start"><span id="rest-month" class="text-primary display-6">
                            </span></div>

                    </div>
                </div>
            </div>
        </x-row>

        <x-row class="g-2 mt-8">
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Média de provento anual</h5>
                        <p class="card-text text-start"><span id="year-avg-incomes"
                                class="text-success display-6">
                            </span></p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Média de Despesas Anual</h5>
                        <p class="card-text text-start"><span id="year-avg-expenses"
                                class="text-danger display-6">
                            </span></p>

                    </div>
                </div>
            </div>
        </x-row>

        <x-row class="g-2 mt-8 ">
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Total de ganho no ano</h5>
                        <p class="card-text text-start"><span id="total-incomes-year"
                                class="text-success display-6"></span></p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Total de gastos no ano</h5>
                        <p class="card-text text-start"><span id="total-expenses-year"
                                class="text-danger display-6"></span></p>

                    </div>
                </div>
            </div>
        </x-row>

        <x-row>
            <div class="col-6">
               <canvas id="myChartIncomes"></canvas>
            </div>
            <div class="col-6">
                <canvas id="myChartExpenses"></canvas>
             </div>
        </x-row>

    </x-col>
@endsection

</html>
