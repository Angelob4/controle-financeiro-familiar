$(function () {

    $("body#incomes").each(function () {

        const $this = $(this);

        const $openModalButton = $this.find("span.btn-outline-success[data-bs-target='#incomeModal']");
        const $incomeModal = $this.find("#incomeModal");
        const $modalHeader = $incomeModal.find(".modal-header");

        const $incomesTable = $this.find("table#table-income");
        const $modalBody = $incomesTable.find("tbody");

        const $btnSave = $incomeModal.find("#btn-save");

        const $monthSelect = $this.find("#month");
        const $yearSelect = $this.find("#year");

        $monthSelect.on("change", function () {

            $modalBody.find("tr").remove();

            $(`
                <tr>
                    <td  colspan="4" class="text-start">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `).appendTo($modalBody);

            const data = {
                month: $monthSelect.val(),
                year: $yearSelect.val(),
            }

            $.ajax({
                type: "GET",
                url: 'ajax/get/incomes',
                data,
                success: function (response) {
                    $modalBody.find("tr").remove();
                    if (response.length > 0) {
                        $(response).each(function () {

                            try {

                                const incomeId = this.id;

                                const $tr = $(`
                                        <tr>
                                            <td class="text-center">${this.day.toString().padStart(2, '0')}</td>
                                            <td class="text-center">${this.name}</td>
                                            <td class="text-center">
                                                <div>
                                                    <span>R$</span>
                                                    ${(this.value.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })).padStart(50, ' ')}
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
                                `);

                                $tr.find('td>span.btn').on('click', function(){

                                    const data = {
                                        id : incomeId
                                    }

                                    const $this = $(this);
                                    $this.addClass('disabled');
                                    $.ajax({
                                        type: "DELETE",
                                        url: 'ajax/delete/incomes',
                                        data,
                                        success: function (response) {
                                            $this.parents('tr').remove();
                                        }
                                    });
                                })

                                $modalBody.append($tr);

                            } catch (error) {
                                console.error(error);
                            }
                        })
                    } else {
                        $(`
                            <tr>
                                <td colspan="4" class="text-center">Não há registros para esse mês </td>
                            </tr>
                        `).appendTo($modalBody);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });
        });

        $yearSelect.on("change", () => $monthSelect.trigger("change"));

        function createSelect($select, name, right) {

            let selectOption = $select.val();

            return $select
                .clone()
                .attr("name", name)
                .removeAttr("id")
                .addClass("date-modal-select")
                .css({ position: "absolute", top: "13px", right: right, width: "100px" })
                .val(selectOption)
                .appendTo($modalHeader);
        }

        $openModalButton.on('click', function () {

            $incomeModal.find(".date-modal-select").remove();

            createSelect($yearSelect, 'year', '45px');
            createSelect($monthSelect, 'month', '150px');
        })

        $btnSave.on('click', function () {

            const $this = $(this);
            const $form = $this.parents('form');

            const dayInput = $form.find('.input-day');
            const monthSelect = $form.find("select[name=month]");
            console.log(monthSelect);
            const yearSelect = $form.find("select[name=year]");

            let daySelected = dayInput.val().toString().padStart(2, "0");
            let monthSelected = monthSelect.val().toString().padStart(2, "0");
            let yearSelected = yearSelect.val().toString().padStart(2, "0");

            const dateToPaid = daySelected + "-" + monthSelected + "-" + yearSelected + " 00:00:00"

            let data = {
                name: $form.find("input[name=name]").val(),
                _token: $form.find("input[name=_token]").val(),
                date_to_paid: dateToPaid,
                transection_type: $form.find("input[name=transection_type]").val(),
                value: $form.find("input[name=value]").val(),
                is_already_paid: $form.find("input[name=is_already_paid]").val(),
                month: $form.find("select[name=month]").val(),
                year: $form.find("select[name=year]").val()
            };

            $.ajax({
                type: "POST",
                url: 'ajax/storage/incomes',
                data,
                success: function (response) {
                    $('button[data-bs-dismiss="modal"]').trigger('click');
                    $yearSelect.trigger('change');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR, textStatus, errorThrown);
                }
            });

            $form.find("input").not("input[type=hidden]").val('');
            $form.find("button[data-bs-dismiss=modal]").trigger("click");

        })
        $yearSelect.trigger('change');
    })

})
