<div class="m-3">
    <table id="{{ $id }}" class="table table-sm table-hover mb-0 table-striped table-bordered">
        <thead class="{{ $theadColor }}">
            <tr class="text-center">
                <td class="px-3">Dia</td>
                <td class="px-3">Nome</td>
                <td class="px-3">Valor</td>
            </tr>
        </thead>

        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
