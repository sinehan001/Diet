"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editCategoryForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'medicine/editMedicineCategoryByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editCategoryForm').find('[name="id"]').val(response.medicinecategory.id).end()
                $('#editCategoryForm').find('[name="category"]').val(response.medicinecategory.category).end()
                $('#editCategoryForm').find('[name="description"]').val(response.medicinecategory.description).end()
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    var table=$('#editable-sample').DataTable({
        responsive: true,

        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1], }},
            {extend: 'print', exportOptions: {columns: [0, 1], }},
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
