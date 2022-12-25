"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editReportForm').trigger("reset");
        $.ajax({
            url: 'report/editReportByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editReportForm').find('[name="id"]').val(response.report.id).end();
                $('#editReportForm').find('[name="type"]').val(response.report.type).end();
                $('#editReportForm').find('[name="description"]').val(response.report.description).end();
                $('#editReportForm').find('[name="patient"]').val(response.report.patient).end();
                $('#editReportForm').find('[name="doctor"]').val(response.report.doctor).end();
                $('#editReportForm').find('[name="date"]').val(response.report.date).end();
                $('#myModal2').modal('show');
            }
        })

    });
});

$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,

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
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: -1,
        "order": [[0, "desc"]],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        },

    });

    table.buttons().container()
            .appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

