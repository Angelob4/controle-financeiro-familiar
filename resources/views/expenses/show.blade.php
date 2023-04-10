@extends('layouts.app')

@section('title', 'Dahsboard')

@section('body_id','expenses')

@section('content')
                <x-col class="pb-3">
                    <x-col-row>
                        <x-row class="g-2 mt-8">
                            <x-col class="col-4 d-flex align-items-center">
                                <h1>Despesas</h1>
                            </x-col>
                            <x-col class="py-3 ">
                                <x-select.month />
                            </x-col>
                            <x-col class="py-3">
                                <x-select.year />
                            </x-col>
                        </x-row>

                        <div class="row">
                            <x-col>
                                <div class="text-end px-3">
                                    <span class="btn btn-sm btn-outline-danger py-0 px-3" data-bs-target="#expenseModal" data-bs-toggle="modal">nova despesa</span>
                                </div>
                                <x-card.personal id="table-expense" title="Proventos do mês" month="fevereiro" theadColor="table-custom">
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td class="text-center">{{ $expense->day < 10 ? "0".$expense->day : $expense->day }}</td>
                                            <td class="text-center">{{ $expense->name }}</td>
                                            <td class="text-center text-success">
                                                <div>
                                                    <span>R$</span>
                                                    {{ number_format($expense->value, 2, ',', '.') }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-card.personal>
                            </x-col>
                        </div>
                    </x-col-row>
                </x-col>


                <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
                    <form class="register-event">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="expenseModalLabel">Novo provento</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="row g-3 modal-body">
                                    @csrf

                                    <div class="col-md-10 col-sm-8">
                                        <label for="name" class="form-label">Nome</label>
                                        <input type="text" name="name" required class="form-control" id="event_name"
                                            placeholder="Conta de Agua">
                                    </div>

                                    <div class="col-md-2 col-sm-4">
                                        <label for="paid-date" class="form-label">Dia</label>
                                        <input type="number" class="form-control text-center input-day" min="1" max="31" value="1">
                                        <input type="hidden" name="date_to_paid">
                                    </div>

                                    <div class="col">

                                        <div class="input-group mb-3">
                                            <span class="btn btn-outline-success input-group-text" aria-expanded="false">Valor
                                                R$</span>
                                            <input type="hidden" name="transection_type" value="expense">
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
                                    <button type="button" class="btn btn-outline-danger px-5" data-bs-dismiss="modal">Fechar</button>
                                    <a id="btn-save" class="btn btn-outline-primary px-5">Salvar</a>
                                </div>
                            </div
                            >
                        </div>
                    </form>
                </div>
@endsection
            </body>
</html>
