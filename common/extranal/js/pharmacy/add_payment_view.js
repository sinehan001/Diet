"use strict";
$(document).ready(function () {
    "use strict";
    var tot = 0;
    var selected = $('#my_multi_select4').find('option:selected');
    var unselected = $('#my_multi_select4').find('option:not(:selected)');
    selected.attr('data-selected', '1');
    $.each(unselected, function (index, value1) {
        "use strict";
        if ($(this).attr('data-selected') == '1') {
            var value = $(this).val();
            var res = value.split("*");

            var id = res[0];
            $('#id-div' + id).remove();
            $('#idinput-' + id).remove();
            $('#mediidinput-' + id).remove();

        }
    });

    $.each($('select.multi-select1 option:selected'), function () {
        "use strict";
        var value = $(this).val();
        var res = value.split("*");
        var unit_price = res[1];
        var id = res[0];
        var qtity = $(this).data('qtity');
        if ($('#idinput-' + id).length)
        {

        } else {
            if ($('#id-div' + id).length)
            {

            } else {

                $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
            }
            var input2 = $('<input>').attr({
                type: 'text',
                class: "remove",
                id: 'idinput-' + id,
                name: 'quantity[]',
                value: qtity,
            }).appendTo('#editPaymentForm .qfloww');

            $('<input>').attr({
                type: 'hidden',
                class: "remove",
                id: 'mediidinput-' + id,
                name: 'medicine_id[]',
                value: id,
            }).appendTo('#editPaymentForm .qfloww');
        }
        $(document).ready(function () {
            "use strict";
            $('#idinput-' + id).keyup(function () {
                "use strict";
                var qty = 0;
                var total = 0;
                $.each($('select.multi-select1 option:selected'), function () {
                    "use strict";
                    var value = $(this).val();
                    var res = value.split("*");

                    var id1 = res[0];
                    qty = $('#idinput-' + id1).val();
                    var ekokk = res[1];
                    total = total + qty * ekokk;
                });
                tot = total;
                var discount = $('#dis_id').val();
                var gross = tot - discount;
                $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
                $('#editPaymentForm').find('[name="grsss"]').val(gross);
            });
        });
        var curr_val = res[1] * $('#idinput-' + id).val();
        tot = tot + curr_val;
    });
    var discount = $('#dis_id').val();
    var gross = tot - discount;
    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
    $('#editPaymentForm').find('[name="grsss"]').val(gross)

});
$(document).ready(function () {
    "use strict";
    $('#dis_id').keyup(function () {
        "use strict";
        var val_dis = 0;
        var amount = 0;
        var ggggg = 0;
        amount = $('#subtotal').val();
        val_dis = this.value;
        ggggg = amount - val_dis;
        $('#editPaymentForm').find('[name="grsss"]').val(ggggg);
    });
});

$(document).ready(function () {
    "use strict";
     $(".category_div").on("change", ".multi-select1", function () {
     "use strict";
        var tot = 0;
        var selected = $('#my_multi_select4').find('option:selected');
        var unselected = $('#my_multi_select4').find('option:not(:selected)');
        selected.attr('data-selected', '1');
        $.each(unselected, function (index, value1) {
            "use strict";
            if ($(this).attr('data-selected') == '1') {
                var value = $(this).val();
                var res = value.split("*");

                var id = res[0];
                $('#id-div' + id).remove();
                $('#idinput-' + id).remove();
                $('#mediidinput-' + id).remove();


            }
        });
        $.each($('select.multi-select1 option:selected'), function () {
            "use strict";
            var value = $(this).val();
            var res = value.split("*");
            var unit_price = res[1];
            var id = res[0];
            if ($('#idinput-' + id).length)
            {

            } else {
                if ($('#id-div' + id).length)
                {

                } else {

                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"><div class="name pos_element"> Name: ' + res[2] + '</div><div class="company pos_element">Company: ' + res[3] + '</div><div class="price pos_element">price: ' + res[1] + '</div><div class="current_stock pos_element">Current Stock: ' + res[4] + '</div><div class="quantity pos_element">quantity:<div></div>')
                }
                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + id,
                    name: 'quantity[]',
                    value: '1',
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'mediidinput-' + id,
                    name: 'medicine_id[]',
                    value: id,
                }).appendTo('#editPaymentForm .qfloww');
            }

            $(document).ready(function () {
                "use strict";
                $('#idinput-' + id).keyup(function () {
                    "use strict";
                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select1 option:selected'), function () {
                        "use strict";
                        var value = $(this).val();
                        var res = value.split("*");

                        var id1 = res[0];
                        qty = $('#idinput-' + id1).val();
                        var ekokk = res[1];
                        total = total + qty * ekokk;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
                    $('#editPaymentForm').find('[name="grsss"]').val(gross);
                });
            });
            var curr_val = res[1] * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        var discount = $('#dis_id').val();
        var gross = tot - discount;
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
        $('#editPaymentForm').find('[name="grsss"]').val(gross);
    });
});
$(document).ready(function () {
    "use strict";
    $('#dis_id').keyup(function () {
        "use strict";
        var val_dis = 0;
        var amount = 0;
        var ggggg = 0;
        amount = $('#subtotal').val();
        val_dis = this.value;
        if (discount_type == 'percentage') {
            ggggg = amount - amount * val_dis / 100;
        }
        if (discount_type == 'flat') {
            ggggg = amount - val_dis;
        }
        $('#editPaymentForm').find('[name="grsss"]').val(ggggg);
    });
});

$(document).ready(function () {
    "use strict";
    $("#my_multi_select4").select2({
        placeholder: medicine,
        multiple: true,
        allowClear: true,
        ajax: {
            url: 'medicine/getMedicineForPharmacyMedicine',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});
