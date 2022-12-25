"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editMedicineForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'medicine/editMedicineByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end();
                $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end();
                $('#editMedicineForm').find('[name="box"]').val(response.medicine.box).end();
                $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end();
                $('#editMedicineForm').find('[name="s_price"]').val(response.medicine.s_price).end();
                $('#editMedicineForm').find('[name="quantity"]').val(response.medicine.quantity).end();
                $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end();
                $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end();
                $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end();
                $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end();
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".load", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editMedicineForm1').trigger("reset");
        $('#myModal3').modal('show');
        $('#editMedicineForm1').find('[name="id"]').val(iid).end()
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
            {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
            {extend: 'print', exportOptions: {columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10], }},
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


