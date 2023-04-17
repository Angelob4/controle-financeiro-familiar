@extends('layouts.app')

@section('title', 'Dahsboard')

@section('body_id','dashboard')

@section('content')
    <x-col class="col-sm-9 pb-3">
        <x-col-row>

            <x-row class="g-2 mt-8">
                <x-col class="col-4 d-flex align-items-center">
                    <h1>Dashboard</h1>
                </x-col>
                <x-col class="py-3 d-none">
                    <x-select.month />
                </x-col>
                <x-col class="py-3">
                    <x-select.year />
                </x-col>
            </x-row>

        </x-col-row>

        <x-row>
            <div class="col">
               <canvas id="myChartIncomes" height="70px"></canvas>
            </div>
        </x-row>

        <x-row class="g-2 mt-8">

            <div class="col-sm-6 col-md">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="small card-title text-start text-dark text-start">Média aritmética - Ganhos</h5>
                        <p class="card-text text-start">
                            <span id="year-avg-incomes" class="text-success display-6"></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="small card-title text-start text-dark text-start">Mediana - Ganhos</h5>
                        <p class="card-text text-start">
                            <span id="year-median-incomes" class="text-success display-6">0</span>
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md">
                <div class="card text-center mb-3 h-100 mx-3" data-tippy-content="A média é a soma de todos os gastos dividida pelo número total de gastos.<br> <br> Ela representa a <b>tendência central</b> dos gastos e pode ajudá-lo a entender qual é a quantidade média de dinheiro que você gasta em um mês.">
                    <div class="card-body">
                        <h5 class="small card-title text-start text-dark text-start">Média aritmética - Gastos</h5>
                        <p class="card-text text-start">
                            <span class="text-danger display-6" >-</span>
                            <span id="year-avg-expenses" class="text-danger display-6"></span>
                        </p>

                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md">
                <div class="card text-center mb-3 h-100 mx-3" data-tippy-content="A mediana é o valor central que separa a metade superior da metade inferior dos gastos ordenados. Ela pode ser uma medida mais robusta em caso de valores extremos ou discrepantes.<br><br> mediana é menos afetada por <b>valores extremos</b> e pode ajudá-lo a identificar possíveis outliers ou variações significativas nos gastos.">
                    <div class="card-body">
                        <h5 class="small card-title text-start text-dark text-start">Mediana - Gastos</h5>
                        <p class="card-text text-start">
                            <span class="text-danger display-6" >-</span>
                            <span id="year-median-expenses" class="text-danger display-6"></span>
                        </p>

                    </div>
                </div>
            </div>

        </x-row>

        <x-row class="g-2 mt-8 ">
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Faturamento anual</h5>
                        <p class="card-text text-start"><span id="total-incomes-year"
                                class="text-success display-6"></span></p>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center mb-3 h-100 mx-3">
                    <div class="card-body">
                        <h5 class="card-title text-start text-dark text-start">Gastos anuais</h5>
                        <p class="card-text text-start"><span class="text-danger display-6" >-</span><span id="total-expenses-year" class="text-danger display-6"></span></p>

                    </div>
                </div>
            </div>
        </x-row>

    </x-col>
@endsection

</html>
