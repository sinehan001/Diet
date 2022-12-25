"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editDepositform').trigger("reset");
        $.ajax({
            url: 'finance/editDepositbyJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                if (response.deposit.deposit_type != 'Card') {
                    $('#editDepositform').find('[name="id"]').val(response.deposit.id).end()
                    $('#editDepositform').find('[name="patient"]').val(response.deposit.patient).end()
                    $('#editDepositform').find('[name="payment_id"]').val(response.deposit.payment_id).end()
                    $('#editDepositform').find('[name="date"]').val(response.deposit.date).end()
                    $('#editDepositform').find('[name="deposited_amount"]').val(response.deposit.deposited_amount).end()

                    $('#myModal2').modal('show');

                } else {
                    alert('Payement Processed By Card can not be edited. Thanks.')
                }
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $('.card').hide();
    $(document.body).on('change', '#selecttype', function () {
        "use strict";
        var v = $("select.selecttype option:selected").val();
        if (v == 'Card') {
            $('.card').show();
            $('.cardsubmit').removeClass('hidden');
            $('.cashsubmit').addClass('hidden');
        } else {
            $('.card').hide();
            $('.cashsubmit').removeClass('hidden');
            $('.cardsubmit').addClass('hidden');
        }
    });

});

$(document).ready(function () {
    "use strict";
    $('.card1').hide();
    $(document.body).on('change', '#selecttype1', function () {
        "use strict";
        var v = $("select.selecttype1 option:selected").val();
        if (v == 'Card') {
            $('.card1').show();
            $('.cardsubmit1').removeClass('hidden');
            $('.cashsubmit1').addClass('hidden');
        } else {
            $('.card1').hide();
            $('.cashsubmit1').removeClass('hidden');
            $('.cardsubmit1').addClass('hidden');
        }
    });

});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
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

Stripe.setPublishableKey(publish);
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
            $("#deposit-form").append("<input type='hidden' name='token' value='" + token + "' />");


            $("#deposit-form").submit();
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
        var expire = $('#expire').val()
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

function cardValidation1() {
    "use strict";
    var valid = true;
    var cardNumber = $('#card1').val();
    var expire = $('#expire1').val();
    var cvc = $('#cvv1').val();

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

Stripe.setPublishableKey(publish);


function stripeResponseHandler1(status, response) {
    "use strict";
    if (response.error) {

        $("#submit-btn1").show();
        $("#loader").css("display", "none");

        $("#error-message").html(response.error.message).show();
    } else {

        var token = response['id'];

        $('#token').val(token);
        $("#editDepositform").append("<input type='hidden' name='token' value='" + token + "' />");

        $("#editDepositform").submit();
    }
}

function stripePay1(e) {
    "use strict";
    e.preventDefault();
    var valid = cardValidation1();

    if (valid == true) {
        $("#submit-btn").attr("disabled", true);
        $("#loader").css("display", "inline-block");
        var expire = $('#expire1').val()
        var arr = expire.split('/');
        Stripe.createToken({
            number: $('#card1').val(),
            cvc: $('#cvv1').val(),
            exp_month: arr[0],
            exp_year: arr[1]
        }, stripeResponseHandler1);

        return false;
    }
}

$(".down").on("click", "#download", function () {
    "use strict";
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addHTML($('#invoice'), function () {
        "use strict";
        pdf.save('invoice.pdf');
    });
});
if (payment_gateway == '2Checkout') {
    var successCallback = function (data) {
        "use strict";
        var myForm = document.getElementById('editPaymentForm');

        $("#editPaymentForm").append("<input type='hidden' name='token' value='" + data.response.token.token + "' />");

        myForm.submit();
    };

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
        // Setup token request arguments  
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

