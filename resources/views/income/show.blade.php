@extends('layouts.app')

@section('title', 'Dahsboard')

@section('body_id','incomes')

@section('content')
                <x-col class="pb-3">
                    <x-col-row>
                        <x-row class="g-2 mt-8">
                            <x-col class="col-4 d-flex align-items-center">
                                <h1>Receitas</h1>
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
                                    <span class="btn btn-sm btn-outline-success py-0 px-3" data-bs-target="#incomeModal" data-bs-toggle="modal">nova receita</span>
                                </div>
                                <x-card.personal id="table-income" title="Proventos do mês" month="fevereiro" theadColor="table-custom">
                                    @foreach ($incomes as $income)
                                        <tr>
                                            <td class="text-center">{{ $income->day < 10 ? "0".$income->day : $income->day }}</td>
                                            <td class="text-center">{{ $income->name }}</td>
                                            <td class="text-center text-success">
                                                <div>
                                                    <span>R$</span>
                                                    {{number_format($income->value, 2, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <span class="btn py-0">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.17286 15.5507C1.33442 16.9905 2.48348 18.1389 3.92271 18.3057C5.80472 18.5239 7.75366 18.75 9.75 18.75C11.7463 18.75 13.6953 18.5239 15.5773 18.3057C17.0165 18.1389 18.1656 16.9905 18.3271 15.5507C18.5374 13.6772 18.75 11.7371 18.75 9.75C18.75 7.76286 18.5374 5.82285 18.3271 3.94932C18.1656 2.50949 17.0165 1.36113 15.5773 1.19426C13.6953 0.97606 11.7463 0.75 9.75 0.75C7.75366 0.75 5.80472 0.97606 3.92271 1.19426C2.48348 1.36113 1.33442 2.50949 1.17286 3.94932C0.962633 5.82285 0.75 7.76286 0.75 9.75C0.75 11.7371 0.962633 13.6772 1.17286 15.5507Z" fill="#FFD9D7"/>
                                                        <path d="M1.17286 15.5507C1.33442 16.9905 2.48348 18.1389 3.92271 18.3057C5.80472 18.5239 7.75366 18.75 9.75 18.75C11.7463 18.75 13.6953 18.5239 15.5773 18.3057C17.0165 18.1389 18.1656 16.9905 18.3271 15.5507C18.5374 13.6772 18.75 11.7371 18.75 9.75C18.75 7.76286 18.5374 5.82285 18.3271 3.94932C18.1656 2.50949 17.0165 1.36113 15.5773 1.19426C13.6953 0.97606 11.7463 0.75 9.75 0.75C7.75366 0.75 5.80472 0.97606 3.92271 1.19426C2.48348 1.36113 1.33442 2.50949 1.17286 3.94932C0.962633 5.82285 0.75 7.76286 0.75 9.75C0.75 11.7371 0.962633 13.6772 1.17286 15.5507Z" stroke="#D55341" stroke-width="1.5"/>
                                                        <path d="M13.35 9.75L6.14997 9.75" stroke="#D55341" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-card.personal>
                            </x-col>
                        </div>
                    </x-col-row>
                </x-col>


                <div class="modal fade" id="incomeModal" tabindex="-1" aria-labelledby="incomeModalLabel" aria-hidden="true">
                    <form class="register-event">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="incomeModalLabel">Novo provento</h1>
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
                                            <input type="hidden" name="transection_type" value="income">
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
                                    <a id="btn-save" class="btn btn-outline-primary px-5">Salvar</a>
                                    <button type="button" class="btn btn-outline-secondary px-5"
                                        data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div
                            >
                        </div>
                    </form>
                </div>
@endsection
            </body>
</html>
