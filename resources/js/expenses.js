 $(function () {

    $("body#expenses").each(function () {

        const $this = $(this);

        const $openModalButton = $this.find("span.btn-outline-danger[data-bs-target='#expenseModal']");
        const $expenseModal = $this.find("#expenseModal");
        const $modalHeader = $expenseModal.find(".modal-header");

        const $expensesTable = $this.find("table#table-expense");
        const $modalBody = $expensesTable.find("tbody");

        const $btnSave = $expenseModal.find("#btn-save");

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
                url: 'ajax/get/expenses',
                data,
                success: function (response) {
                    $modalBody.find("tr").remove();
                    if (response.length > 0) {
                        $(response).each(function () {

                            try {

                                const expenseId = this.id;

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
                                            <span class="btn py-0"></span>
                                        </td>
                                    </tr>
                                `);

                                $tr.find('td>span.btn').on('click', function(){

                                    const data = {
                                        id : expenseId
                                    }

                                    const $this = $(this);
                                    $this.addClass('disabled');
                                    $.ajax({
                                        type: "DELETE",
                                        url: 'ajax/delete/expenses',
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
            $expenseModal.find(".date-modal-select").remove();

            createSelect($yearSelect, 'year', '45px');
            createSelect($monthSelect, 'month', '150px');
        })

        $btnSave.on('click', function () {

            const $this = $(this);
            const $form = $this.parents('form');

            const dayInput = $form.find('.input-day');
            const monthSelect = $form.find("select[name=month]");
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
                url: 'ajax/storage/expenses',
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
