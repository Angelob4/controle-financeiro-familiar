$(function () {

    $("body#dashboard").each(function () {

        let now = new Date();
        now.setUTCHours(now.getUTCHours() - 3);
        let today = now.toISOString().slice(0, 10);

        $("input[type='date']").val(today);

        // Define as constantes para strings literais
        const CLASS = {
            DROPDOWN_TOGGLE: '.dropdown-toggle',
            BTN_OUTLINE_DANGER: 'btn-outline-danger',
            BTN_OUTLINE_SUCCESS: 'btn-outline-success',
            D_NONE: 'd-none'
        };

        const $currentPage = $(this);
        const $dashboard = $currentPage.find($("#dashboard"));
        const $main = $dashboard.find("main");
        const $formRegisterEvent = $currentPage.find("form.register-event");
        const $inputNameOfEvent = $formRegisterEvent.find("#event_name");
        const $btnIsAreadyPaid = $formRegisterEvent.find("#btn-already-paid");
        const $dropdownOfTypeTransection = $formRegisterEvent.find(CLASS.DROPDOWN_TOGGLE);
        const $optionsOfTypeTransection = $dropdownOfTypeTransection.next().find("a");
        const $transctionTypeInput = $formRegisterEvent.find("input[name=transection_type]");
        const $monthSelect = $currentPage.find("#month");
        const $yearSelect = $currentPage.find("#year");
        const $allCardsTitles = $(".card-title");
        const $btnSave = $formRegisterEvent.find("#btn-save");
        const $tableIncome = $dashboard.find("#table-income");
        const $tableExpenses = $dashboard.find("#table-expenses");
        const $inputDay = $dashboard.find(".input-day");
        const $cardBody = $(".card-body");


        $monthSelect.val(new Date().getUTCMonth() + 1).trigger("change");
        const clearAllTables = () => {
            $tableIncome.find("tbody > tr").remove();
            $tableExpenses.find("tbody > tr").remove();
        }

        function formatBrCash(value) {
            return parseFloat(value).toFixed(2).replace('.', ',').replace(/(\d)(?=(\d{3})+\,)/g, "$1.");
        }

        const getSelectMonth = () => {
            return $monthSelect.val();
        }
        const getSelectYear = () => {
            return $yearSelect.val();
        }

        $(".roll-btn").on('click', function () {
            let $this = $(this);

            // $this.parent().next().slideToggle(400);

        })

        const toMoney = (numero) => numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }).replace(/[^\d,-.]+/g, '');
        const roundUpToTwoDecimals = number => number.toLocaleString('pt-BR');

        const updateDashboard = () => {
            $.ajax({
                url: `ajax/atualizar-dashboard/mes/${getSelectMonth()}/ano/${getSelectYear()}`,
                method: "GET",

                success: function (response) {

                    const selectedMonth = response.selectedMonth < 10 ? "0" + response.selectedMonth : response.selectedMonth

                    let incomeValue = response.incomes.byMonth[selectedMonth] || 0;
                    let expenseValue = response.expenses.byMonth[selectedMonth] || 0;

                    const valueIncomesInMonth = parseFloat(incomeValue);
                    const valueExpensesInMonth = parseFloat(expenseValue);

                    const valueRestInMonth = valueIncomesInMonth - valueExpensesInMonth;
                    const valueIncomeInYear = response.incomes.totalInYear;
                    const valueexpensesInYear = response.expenses.totalInYear;

                    const $totalExpensesMonth = $("#total-expenses-month");
                    const $totalExpensesMonthCard = $totalExpensesMonth.parents('.card-body');

                    let $restoOfMonth = $("#rest-month");
                    let $restOfMonthCard = $restoOfMonth.parents('.card-body');

                    $("#total-incomes-month").text(toMoney(valueIncomesInMonth))
                    $totalExpensesMonth.text(toMoney(valueExpensesInMonth))
                    $("#rest-month").text(toMoney(valueRestInMonth))
                    $("#year-avg-incomes").text(toMoney(response.incomes.avg))
                    $("#year-avg-expenses").text(toMoney(response.expenses.avg))
                    $("#total-expenses-year").text(toMoney(valueexpensesInYear))
                    $("#total-incomes-year").text(toMoney(valueIncomeInYear))

                    let TotalExpesenesConvertedValue = valueIncomesInMonth == 0
                        ? '100'
                        : roundUpToTwoDecimals((valueExpensesInMonth / valueIncomesInMonth) * 100);

                    let restOfMonthConvertedValue = valueIncomesInMonth == 0
                        ? '-100'
                        : roundUpToTwoDecimals((valueRestInMonth / valueIncomesInMonth) * 100);

                    $totalExpensesMonthCard.find(".percent").remove();
                    $restOfMonthCard.find(".percent").remove();
                    $totalExpensesMonthCard.append(`
                         <div class="text-danger percent text-start">${TotalExpesenesConvertedValue}%</div>
                    `);

                    $restOfMonthCard.append(`
                         <div class="text-primary percent text-start">${restOfMonthConvertedValue}%</div>
                    `);

                    // clearAllTables();

                    // response.personalExpenses.forEach(function(expense){
                    //     let day = expense.payment_date.split('-')[2]
                    //     let $tr = $(`
                    //         <tr class="text-center">
                    //             <td class="px-3"> ${day < 10 ? '0'+day : day}</td>
                    //             <td class="px-3"> ${expense.name}</td>
                    //             <td class="px-3"> <div class="d-flex justify-content-between px-4"> <span>R$</span> ${formatBrCash(expense.value)} </div> </td>
                    //         </tr>
                    //     `)

                    //     $tableExpenses.find("tbody").append($tr);
                    // })

                    // if(response.maxExpenses){
                    //     $tableExpenses.find("tbody").append(`
                    //         <tr class="">
                    //             <td class=" align-items-center" colspan="2"><div class="d-flex justify-content-between"><span>Total</span></div></td>
                    //             <td class="px-3"><div class="d-flex justify-content-between px-4 text-danger"><span class="text-danger">R$</span> ${formatBrCash(response.maxExpenses)}</div></td>
                    //         </tr>
                    //     `)
                    // }

                    // response.personalIncomes.forEach(function(income){
                    //     let day = income.payment_date.split('-')[2]
                    //     let $tr = $(`

                    //         <tr class="text-center">
                    //             <td class="px-3">${day}</td>
                    //             <td class="px-3">${income.name}</td>
                    //             <td class="px-3"><div class="d-flex justify-content-between px-4">R$ ${formatBrCash(income.value)}
                    //             </div>
                    //             </tr>
                    //     `)
                    //     $tr.css('display: none');
                    //     $tableIncome.find("tbody").append($tr);
                    // })

                    // if(response.maxIncomes){
                    //     $tableIncome.find("tbody").append(`
                    //         <tr class="">
                    //             <td class=" align-items-center" colspan="2"><div class="d-flex justify-content-between"><span>Total</span></div></td>
                    //             <td class="px-3"><div class="d-flex justify-content-between px-4 text-success"><span class="text-success">R$</span> ${formatBrCash(response.maxIncomes)}</div></td>
                    //         </tr>
                    //     `)
                    // }

                    // $cardBody.slideDown('slow');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // código a ser executado em caso de erro na requisição
                    console.error(errorThrown);
                }
            });
        }

        $monthSelect.on('change', function () {
            let selectedMonth = $(this).find(":selected").val();
            updateDashboard();
        })

        $yearSelect.on('change', function () {
            $monthSelect.trigger('change');
        })

        $monthSelect.trigger("change");

        const formatToBrMoney = (money) => {
            return money.replace(/[^0-9,]/g, '').replace(/(\d{1,3})(\d{3})(\d{2})/, "$1.$2,$3");
        }

        $optionsOfTypeTransection.on('click', function () {

            const $clickedOptionTypeTransection = $(this);
            let selectedTransectionType = $clickedOptionTypeTransection.data("type");
            let optionSelectedValue = $clickedOptionTypeTransection.html();
            $dropdownOfTypeTransection.text(optionSelectedValue);
            $transctionTypeInput.val(optionSelectedValue);
            $dropdownOfTypeTransection.toggleClass(CLASS.BTN_OUTLINE_DANGER, selectedTransectionType === 'expense');
            $dropdownOfTypeTransection.toggleClass(CLASS.BTN_OUTLINE_SUCCESS, selectedTransectionType === 'income');
            if (selectedTransectionType === 'expense') {
                $btnIsAreadyPaid.parent().removeClass(CLASS.D_NONE);
                $inputNameOfEvent.attr('placeholder', 'Conta de Luz')
            } else {
                $btnIsAreadyPaid.parent().addClass(CLASS.D_NONE);
                $inputNameOfEvent.attr('placeholder', 'Salário')
            }
        })

        $inputDay.on('change', function () {
            let $this = $(this);
            let day = parseInt($this.val()) < 10 ? '0' + $this.val() : $this.val();
            let month = parseInt(getSelectMonth()) < 10 ? '0' + getSelectMonth() : getSelectMonth();
            let year = getSelectYear();

            $this.next().val(day + '-' + month + '-' + year);
        })


        $inputDay.trigger('change');




    })

    setTimeout(function () {

        $(".papper").slideDown('slow')
    }, 500);

})
