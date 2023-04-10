@php
    const MONTHS = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ];

    $currentMonth = \Carbon\Carbon::now()->month;
@endphp

<label for="month">Mês</label>
<select class="form-control" name="month" id="month">
    @foreach (MONTHS as $index => $month)
        <option value="{{ $index }}" {{ $currentMonth == $index ? 'selected' : '' }}>{{ $month }}</option>
    @endforeach
</select>

