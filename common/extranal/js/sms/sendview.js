"use strict";
$(document).ready(function () {
    "use strict";
    $('.pos_client').hide();
    $("#myform").on("change", "input[type=radio][name=radio]", function () {
        "use strict";

        if (this.value == 'bloodgroupwise') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

});


$(document).ready(function () {
    "use strict";
    $('.single_patient').hide();
    $("#myform").on("change", "input[type=radio][name=radio]", function () {
        "use strict";
        if (this.value == 'single_patient') {
            $('.single_patient').show();
        } else {
            $('.single_patient').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";
    $('.staff').hide();
    $("#myform").on("change", "input[type=radio][name=radio]", function () {
        "use strict";
        if (this.value == 'staff') {
            $('.staff').show();
        } else {
            $('.staff').hide();
        }
    });

});


$(document).ready(function () {
    "use strict";
    $("#selUser5").select2({
        placeholder: select_template,
        allowClear: true,
        ajax: {
            url: 'sms/getManualSMSTemplateinfo',
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
    $('#selUser5').on('change', function () {
        var iid = $(this).val();
        var type = 'sms';

        $.ajax({
            url: 'sms/getManualSMSTemplateMessageboxText?id=' + iid + '&type=' + type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#myform').find('[name="message"]').val(response.user.message).end();
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

function addtext(ele) {
    "use strict";
    var fired_button = ele.value;
    document.myform.message.value += fired_button;
}


function addtext1(ele) {
    "use strict";
    var fired_button = ele.value;
    document.myform1.message.value += fired_button;
}

$(document).ready(function () {
    "use strict";
    $("#patientchoose").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfo',
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
    