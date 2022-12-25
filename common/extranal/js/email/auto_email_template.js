"use strict"; 
$(document).ready(function () {
    "use strict";

    $(".table").on("click", ".editbutton1", function () {
        "use strict";

        var iid = $(this).attr('data-id');
        $('#divbuttontag').html("");

        $.ajax({
            url: 'email/editAutoEmailTemplate?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

            // Populate the form fields with the data returned from server
            $('#emailtemp').find('[name="id"]').val(response.autotemplatename.id).end();
            $('#emailtemp').find('[name="category"]').val(response.autotemplatename.name).end();
            myEditor.setData(response.autotemplatename.message);

            var option = '';
            var count = 0;
            $.each(response.autotag, function (index, value) {
                "use strict";

                option += '<input type="button" name="myBtn" value="' + value.name + '" onClick="addtext(this);">';
                count += 1;
                if (count % 7 === 0) {
                    option += '<br><br>';
                }
            });
            $('#divbuttontag').html(option);
            $('#status').html(response.status_options);
            $('#myModal1').modal('show');
            }
        })
    });
});


$(document).ready(function () {
    "use strict";

    var table = $('#editable-sample1').DataTable({
        responsive: true,

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "email/getAutoEmailTemplateList",
            type: 'POST',
            'data': {'type': 'sms'}
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-sm-3'><'col-sm-5 text-center'B><'col-sm-4'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
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
    document.myform1.message.value += fired_button;
}
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
