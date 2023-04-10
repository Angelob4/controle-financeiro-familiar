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
            </x-col>
@endsection



<div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="expenseModalLabel">Nova despesa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- action="{{ route('personalExpenses.storage') }}" method="POST" --}}
            <form class="register-event">
                <div class="row g-3 modal-body">
                    @csrf

                    <div class="col-md-11">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" required class="form-control" id="event_name"
                            placeholder="Conta de Agua">
                    </div>
                    <div class="col-md-1">
                        <label for="paid-date" class="form-label">Dia</label>
                        <input type="number" class="form-control text-center input-day" min="1" max="31" value="1">
                        <input type="hidden" name="date_to_paid">
                    </div>

                    <div class="col">

                        <div class="input-group mb-3">
                            <span class="btn btn-outline-danger input-group-text" aria-expanded="false">Valor R$</span>
                            <input type="hidden" name="transection_type" value="expensive">
                            <input type="text" required name="value" class="form-control"
                                aria-label="Input de Texto com um botão de opções">
                        </div>

                    </div>

                    <div class=" d-none col-xl-4 col-md-12 ">
                        <input type="checkbox" class="btn-check" name="is_already_paid" id="btn-already-paid"
                            autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btn-save" class="btn btn-outline-danger px-5"
                        data-endpoint="{{ route('personalExpenses.storage') }}">Salvar</a>
                    <button type="button" class="btn btn-outline-secondary px-5" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


</html>
