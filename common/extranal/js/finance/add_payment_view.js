"use strict";
$(document).ready(function () {
    "use strict";
    var tot = 0;
    $('.ms-list').on('click', '.ms-selected', function () {

        "use strict";
        var idd = $(this).data('idd');
        $('#id-div' + idd).remove();
        $('#idinput-' + idd).remove();
        $('#categoryinput-' + idd).remove();
    });
    $.each($('select.multi-select option:selected'), function () {
        "use strict";
        var idd = $(this).data('idd');
        var qtity = $(this).data('qtity');
        if ($('#idinput-' + idd).length)
        {

        } else {
            if ($('#id-div' + idd).length)
            {
            } else {
                $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '-' + currency + $(this).data('id') + '</div>');
            }
            var input2 = $('<input>').attr({
                type: 'text',
                class: "remove",
                id: 'idinput-' + idd,
                name: 'quantity[]',
                value: qtity,
            }).appendTo('#editPaymentForm .qfloww');

            $('<input>').attr({
                type: 'hidden',
                class: "remove",
                id: 'categoryinput-' + idd,
                name: 'category_id[]',
                value: idd,
            }).appendTo('#editPaymentForm .qfloww');
        }
        $(document).ready(function () {
            "use strict";

            $('#idinput-' + idd).keyup(function () {
                "use strict";
                var qty = 0;
                var total = 0;
                $.each($('select.multi-select option:selected'), function () {
                    var id1 = $(this).data('idd');
                    qty = $('#idinput-' + id1).val();
                    var ekokk = $(this).data('id');
                    total = total + qty * ekokk;
                });
                tot = total;
                var discount = $('#dis_id').val();
                var gross = tot - discount;
                $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
                $('#editPaymentForm').find('[name="grsss"]').val(gross);

                var amount_received = $('#amount_received').val();
                var change = amount_received - gross;
                $('#editPaymentForm').find('[name="change"]').val(change).end();
            });
        });
        "use strict";
        var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
        tot = tot + sub_total;
    });
    "use strict";
    var discount = $('#dis_id').val();
    if (discount_type === 'flat') {
        var gross = tot - discount;
    } else {
        var gross = tot - tot * discount / 100;
    }

    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();

    $('#editPaymentForm').find('[name="grsss"]').val(gross);
    var amount_received = $('#amount_received').val();
    var change = amount_received - gross;
    $('#editPaymentForm').find('[name="change"]').val(change).end();
}

);

$(document).ready(function () {
    "use strict";
    $('#dis_id').keyup(function () {
        "use strict";
        var val_dis = 0;
        var amount = 0;
        var ggggg = 0;
        amount = $('#subtotal').val();
        val_dis = this.value;
        if (discount_type === 'flat') {
            ggggg = amount - val_dis;
        } else {
            ggggg = amount - amount * val_dis / 100;
        }
        $('#editPaymentForm').find('[name="grsss"]').val(ggggg);


        var amount_received = $('#amount_received').val();
        var change = amount_received - ggggg;
        $('#editPaymentForm').find('[name="change"]').val(change).end();

    });
});

$(document).ready(function () {
    "use strict";
    $(document.body).on('change', '.multi-select', function () {

        "use strict";
        var tot = 0;

        $('.ms-list').on('click', '.ms-selected', function () {
            "use strict";
            var idd = $(this).data('idd');
            $('#id-div' + idd).remove();
            $('#idinput-' + idd).remove();
            $('#categoryinput-' + idd).remove();

        });
        $.each($('select.multi-select option:selected'), function () {
            "use strict";
            var curr_val = $(this).data('id');
            var idd = $(this).data('idd');

            var cat_name = $(this).data('cat_name');
            if ($('#idinput-' + idd).length)
            {

            } else {
                if ($('#id-div' + idd).length)
                {

                } else {
                    $("#editPaymentForm .qfloww").append('<div class="remove1" id="id-div' + idd + '">  ' + $(this).data("cat_name") + '-' + currency + $(this).data('id') + '</div>');
                }


                var input2 = $('<input>').attr({
                    type: 'text',
                    class: "remove",
                    id: 'idinput-' + idd,
                    name: 'quantity[]',
                    value: '1',
                }).appendTo('#editPaymentForm .qfloww');

                $('<input>').attr({
                    type: 'hidden',
                    class: "remove",
                    id: 'categoryinput-' + idd,
                    name: 'category_id[]',
                    value: idd,
                }).appendTo('#editPaymentForm .qfloww');
            }


            $(document).ready(function () {
                "use strict";
                $('#idinput-' + idd).keyup(function () {
                    "use strict";

                    var qty = 0;
                    var total = 0;
                    $.each($('select.multi-select option:selected'), function () {
                        var id1 = $(this).data('idd');
                        qty = $('#idinput-' + id1).val();
                        var ekokk = $(this).data('id');
                        total = total + qty * ekokk;
                    });

                    tot = total;

                    var discount = $('#dis_id').val();
                    var gross = tot - discount;
                    $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();
                    $('#editPaymentForm').find('[name="grsss"]').val(gross);

                    var amount_received = $('#amount_received').val();
                    var change = amount_received - gross;
                    $('#editPaymentForm').find('[name="change"]').val(change).end();


                });
            });
            "use strict";
            var sub_total = $(this).data('id') * $('#idinput-' + idd).val();
            tot = tot + sub_total;


        });
        "use strict";
        var discount = $('#dis_id').val();


        if (discount_type === 'flat') {
            var gross = tot - discount;

        } else {
            var gross = tot - tot * discount / 100;
        }
        $('#editPaymentForm').find('[name="subtotal"]').val(tot).end();

        $('#editPaymentForm').find('[name="grsss"]').val(gross);

        var amount_received = $('#amount_received').val();
        var change = amount_received - gross;
        $('#editPaymentForm').find('[name="change"]').val(change).end();


    }

    );
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

        if (discount_type === 'flat') {

            ggggg = amount - val_dis;
        } else {
            ggggg = amount - amount * val_dis / 100;
        }
        $('#editPaymentForm').find('[name="grsss"]').val(ggggg);


        var amount_received = $('#amount_received').val();
        var change = amount_received - ggggg;
        $('#editPaymentForm').find('[name="change"]').val(change).end();





    });
});

$(document).ready(function () {
    "use strict";
    $('.pos_client').hide();
    $(document.body).on('change', '#pos_select', function () {
        "use strict";
        var v = $("select.pos_select option:selected").val();
        if (v === 'add_new') {
            $('.pos_client').show();
            $("#p_birth").prop('required', true);

        } else {
            $('.pos_client').hide();
            $("#p_birth").prop('required', false);
        }
    });

});

$(document).ready(function () {
    "use strict";
    $('.pos_doctor').hide();
    $(document.body).on('change', '#add_doctor', function () {
        "use strict";

        var v = $("select.add_doctor option:selected").val();
        if (v === 'add_new') {
            $('.pos_doctor').show();
        } else {
            $('.pos_doctor').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";
    $('.card').hide();
    $(document.body).on('change', '#selecttype', function () {
        "use strict";
        var v = $("select.selecttype option:selected").val();
        if (v === 'Card') {
            $('.cardsubmit').removeClass('hidden');
            $('.cashsubmit').addClass('hidden');
            $("#amount_received").prop('required', true);

            $('.card').show();
        } else {
            $('.card').hide();
            $('.cashsubmit').removeClass('hidden');
            $('.cardsubmit').addClass('hidden');
            $("#amount_received").prop('required', false);

        }
    });

});

function cardValidation() {
    "use strict";
    var valid = true;
    var cardNumber = $('#card').val();
    var expire = $('#expire').val();
    var cvc = $('#cvv').val();

    $("#error-message").html("").hide();

    if (cardNumber.trim() == "") {
        valid = false;
    }

    if (expire.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if (valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey(publish);

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    "use strict";
    if (response.error) {

        $("#submit-btn").show();
        $("#loader").css("display", "none");

        $("#error-message").html(response.error.message).show();
        $("#submit-btn").attr("disabled", false);
        $("#error-message").html(response.error.message).show();
    } else {

        var token = response['id'];
        if (token != null) {
            $('#token').val(token);
            $("#editPaymentForm").append("<input type='hidden' name='token' value='" + token + "' />");
            $("#editPaymentForm").submit();
        } else {
            alert('Please Check Your Card details');
            $("#submit-btn").attr("disabled", false);
        }

    }
}

function stripePay(e) {
    "use strict";
    e.preventDefault();
    var valid = cardValidation();

    if (valid == true) {
        $("#submit-btn").attr("disabled", true);
        $("#loader").css("display", "inline-block");
        var expire = $('#expire').val();
        var arr = expire.split('/');
        Stripe.createToken({
            number: $('#card').val(),
            cvc: $('#cvv').val(),
            exp_month: arr[0],
            exp_year: arr[1]
        }, stripeResponseHandler);


        return false;
    }
}

$(document).ready(function () {
    "use strict";
    $("#pos_select").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfoWithAddNewOption',
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

    $("#add_doctor").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorWithAddNewOption',
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
if (payment_gateway == '2Checkout') {

    var successCallback = function (data) {
        "use strict";
        var myForm = document.getElementById('editPaymentForm');

        $("#editPaymentForm").append("<input type='hidden' name='token' value='" + data.response.token.token + "' />");

        myForm.submit();
    };
    // Called when token creation fails.
    var errorCallback = function (data) {
        "use strict";
        if (data.errorCode === 200) {
            tokenRequest();
        } else {
            alert(data.errorMsg);
        }
    };
    var tokenRequest = function () {

        "use strict";
        var expire = $("#expire").val();
        var expiresep = expire.split("/");
        var dateformat = moment(expiresep[1], "YY");
        var year = dateformat.format("YYYY");
        var args = {
            sellerId: merchant,
            publishableKey: publishable,
            ccNo: $("#card").val(),
            cvv: $("#cvv").val(),
            expMonth: expiresep[0],
            expYear: year
        };
        console.log($("#card").val() + '-' + $("#cvv").val() + expiresep[0] + year + merchant);


        TCO.requestToken(successCallback, errorCallback, args);
    };

    function twoCheckoutPay(e) {
        "use strict";
        e.preventDefault();

        TCO.loadPubKey('sandbox', function () {  // for sandbox environment
            publishableKey = publishable//your public key
            tokenRequest();
        });

        return false;

    }

}
