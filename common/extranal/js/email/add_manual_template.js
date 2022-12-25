"use strict";
$(document).ready(function () {
    "use strict";

    $(".flashmessage").delay(3000).fadeOut(100);
});

function addtext(ele) {
    "use strict";

    var fired_button = ele.value;
    var value = myEditor.getData()
    value += fired_button;
    myEditor.setData(value)
}

$(document).ready(function () {
    "use strict";

    $("#selUser").select2({
        ajax: {
            url: 'sms/getStudentinfo',
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
    $("#selUser1").select2({
        ajax: {
            url: 'sms/getBatchinfo',
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
    $("#selUser2").select2({
        ajax: {
            url: 'sms/getInstructorinfo',
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
    $("#selUser5").select2({
        ajax: {
            url: 'sms/getTemplateinfo',
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
var myEditor;

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

});


