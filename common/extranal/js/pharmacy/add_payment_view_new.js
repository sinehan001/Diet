"use strict";
$(document).ready(function () {
    "use strict";
    $(".search-input").keyup(function () {
        "use strict";
        var keyword = this.value;
        $('.ajaxoption option').remove();
        $(".ms-selectable .ms-list li").remove();
        $(".ms-selection .ms-list li").remove();


        $.ajax({
            url: 'finance/getMedicineByKeyJason?keyword=' + keyword,
            method: 'POST',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            "use strict";
            $.each(response.opp, function (key, value) {
                $(".ajaxoption").append(value);
            });
            $.each(response.ltst, function (k, v) {
                $(".ms-selectable .ms-list").append(v);
            });

            $.each(response.slt, function (kk, vv) {
                $(".ms-selection .ms-list").append(vv);
            });
        });


    });
});

$(document).ready(function () {
    "use strict";
    var tot = 0;
    $('.ms-list').on('click', '.ms-selected', function () {
        "use strict";
        var id = $(this).data('id');
        $('#id-div' + id).remove();
        $('#idinput-' + id).remove();
        $('#mediidinput-' + id).remove();

    });
    $.each($('select.multi-select option:selected'), function () {
        "use strict";
        var unit_price = $(this).data('s_price');
        var id = $(this).data('id');
        var qtity = $(this).data('qtity');
        if ($('#idinput-' + id).length)
        {

        } else {
            if ($('#id-div' + id).length)
            {

            } else {

                $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> Name: ' + $(this).data("m_name") + '<br>price: ' + $(this).data('s_price') + '<br>quantity:</div>')
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
                $.each($('select.multi-select option:selected'), function () {
                    var id1 = $(this).data('id');
                    qty = $('#idinput-' + id1).val();
                    var ekokk = $(this).data('s_price');
                    total = total + qty * ekokk;
                });
                tot = total;
                var discount = $('#dis_id').val();
                var gross = tot - discount;
                $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
                $('#editPaymentForm').find('[name="grsss"]').val(gross)
            });
        });
        var curr_val = $(this).data('s_price') * $('#idinput-' + id).val();
        tot = tot + curr_val;
    });
    var discount = $('#dis_id').val();
    var gross = tot - discount;
    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
    $('#editPaymentForm').find('[name="grsss"]').val(gross);
    //  });
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
    $('.category_div').on('change', '.multi-select', function () {
        "use strict";
        var tot = 0;
       $('.ms-list').on('click', '.ms-selected', function () {
           "use strict";
            var id = $(this).data('id');
            $('#id-div' + id).remove();
            $('#idinput-' + id).remove();
            $('#mediidinput-' + id).remove();

        });
        $.each($('select.multi-select option:selected'), function () {
            "use strict";
            var unit_price = $(this).data('s_price');
            var id = $(this).data('id');
            if ($('#idinput-' + id).length)
            {

            } else {
                if ($('#id-div' + id).length)
                {

                } else {

                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + id + '"> Name: ' + $(this).data("m_name") + '<br>Company:' + $(this).data("c_name") + '<br>price: ' + $(this).data('s_price') + '<br>quantity:</div>')
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
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('id');
                        qty = $('#idinput-' + id1).val();
                        var ekokk = $(this).data('s_price');
                        total = total + qty * ekokk;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
                    $('#editPaymentForm').find('[name="grsss"]').val(gross);
                });
            });
            var curr_val = $(this).data('s_price') * $('#idinput-' + id).val();
            tot = tot + curr_val;
        });
        "use strict";
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
    $(".flashmessage").delay(3000).fadeOut(100);
});