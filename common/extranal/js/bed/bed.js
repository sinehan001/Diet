"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editBedForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'bed/editBedByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editBedForm').find('[name="id"]').val(response.bed.id).end()
                $('#editBedForm').find('[name="category"]').val(response.bed.category).end()
                $('#editBedForm').find('[name="number"]').val(response.bed.number).end()
                $('#editBedForm').find('[name="description"]').val(response.bed.description).end()
            }
        })
    });
});



$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,
        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "bed/getBedList",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 100,
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});




