"use strict";
$(document).ready(function () {
    "use strict";

    $('.pos_client').hide();
    $('input[type=radio][name=radio]').change(function () {
        if (this.value === 'bloodgroupwise') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

});

var myEditor;
var myEditor2;
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';

                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor2 = editor;
            })
            .catch(error => {
                console.error(error);
            });
});
$(document).ready(function () {
    "use strict";

    $('.single_patient').hide();
    $('input[type=radio][name=radio]').change(function () {
        if (this.value === 'single_patient') {
            $('.single_patient').show();
        } else {
            $('.single_patient').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";

    $('.other').hide();
    $('input[type=radio][name=radio]').change(function () {
        if (this.value == 'other') {
            $('.other').show();
        } else {
            $('.other').hide();
        }
    });

});

$(document).ready(function () {
    "use strict";

    $("#selUser5").select2({
        placeholder: select_template,
        allowClear: true,
        ajax: {
            url: 'email/getManualEmailTemplateinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                "use strict";
                return {
                    searchTerm: params.term // search term                   
                };

            },
            processResults: function (response) {
                "use strict";
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
        "use strict";

        var iid = $(this).val();
        var type = 'email';

        $.ajax({
            url: 'email/getManualEmailTemplateMessageboxText?id=' + iid + '&type=' + type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

                myEditor.setData(response.user.message);
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
    var value = myEditor.getData();
    value += fired_button;
    myEditor.setData(value);
}

function addtext1(ele) {
    "use strict";
    var fired_button = ele.value;
    var value = myEditor2.getData();
    value += fired_button;
    myEditor2.setData(value);
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
