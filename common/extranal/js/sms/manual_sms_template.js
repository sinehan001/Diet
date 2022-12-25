"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton1", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        var type = 'sms';

        $.ajax({
            url: 'sms/editManualSMSTemplate?id=' + iid + '&type=' + type,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#smstemp').find('[name="id"]').val(response.templatename.id).end();
                $('#smstemp').find('[name="name"]').val(response.templatename.name).end();
                $('#smstemp').find('[name="message"]').val(response.templatename.message).end();

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
            url: "sms/getManualSMSTemplateList",
            type: 'POST',
            'data': {'type': 'sms'}
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
    document.myform.message.value += fired_button;
}

function addtext1(ele) {
    "use strict";
    var fired_button = ele.value;
    document.myform1.message.value += fired_button;
}
