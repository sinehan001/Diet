"use strict";
$(document).ready(function () {
    "use strict";

    $(".table").on("click", ".editbutton1", function () {
        "use strict";

        var iid = $(this).attr('data-id');
        var type = 'email';

        $.ajax({
            url: 'email/editManualEmailTemplate?id=' + iid + '&type=' + type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

                // Populate the form fields with the data returned from server
                $('#smstemp').find('[name="id"]').val(response.templatename.id).end();
                $('#smstemp').find('[name="name"]').val(response.templatename.name).end();
                myEditor.setData(response.templatename.message)

                $('#myModal1').modal('show');
            }
        })
    });
});



$(document).ready(function () {
    "use strict";

    var table = $('#editable-sample1').DataTable({
        responsive: true,
        //   dom: 'lfrBtip',

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "email/getManualEmailTemplateList",
            type: 'POST',
            'data': {'type': 'email'}
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2, 3], }},
        ],
        aLengthMenu: [
            [1, 2, 50, 100, -1],
            [1, 2, 50, 100, "All"]
        ],
        iDisplayLength: 100,
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search..."
        },
    });
    table.buttons().container()
            .appendTo('.custom_buttons');
});

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

function addtext1(ele) {
    "use strict";

    var fired_button = ele.value;
    var value = myEditor2.getData()
    value += fired_button;


    myEditor2.setData(value)
}

var myEditor;
var myEditor2;
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor4'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';

                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor5'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor2 = editor;
            })
            .catch(error => {
                console.error(error);
            });
});
