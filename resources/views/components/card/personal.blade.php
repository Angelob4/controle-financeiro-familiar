<div class="m-3">
    <table id="{{ $id }}" class="table table-sm table-hover mb-0 table-striped table-bordered">
        <thead class="{{ $theadColor }}">
            <tr class="text-center">
                <th class="px-3">Dia</th>
                <th class="px-3">Nome</th>
                <th class="px-3">Valor</th>
                <th class="text-center"> Opções </th>
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
