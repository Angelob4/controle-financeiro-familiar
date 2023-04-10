@php
    $currentYear = now()->year;
    $startYear = 2018;
    $years = [];

    for ($i = $startYear; $i <= $currentYear; $i++) {
        $years[$i] = $i;
    }

    $currentYear = now()->year;
@endphp

<label for="year">Ano</label>
<select class="form-control" name="year" id="year">
    @foreach ($years as $year)
        <option {{ $year == $currentYear ? 'selected' : '' }} value="{{ $year }}"> {{ $year }} </option>
    @endforeach
</select>
