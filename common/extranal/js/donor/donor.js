"use strict";
$(document).ready(function () {
    "use strict";

    $(".table").on("click", ".editbutton", function () {
        "use strict";

        var iid = $(this).attr('data-id');
        $('#editDonorForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'donor/editDonorByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";


                $('#editDonorForm').find('[name="id"]').val(response.donor.id).end();
                $('#editDonorForm').find('[name="name"]').val(response.donor.name).end();
                $('#editDonorForm').find('[name="group"]').val(response.donor.group).end();
                $('#editDonorForm').find('[name="age"]').val(response.donor.age).end();
                $('#editDonorForm').find('[name="sex"]').val(response.donor.sex).end();
                $('#editDonorForm').find('[name="ldd"]').val(response.donor.ldd).end();
                $('#editDonorForm').find('[name="phone"]').val(response.donor.phone).end();
                $('#editDonorForm').find('[name="email"]').val(response.donor.email).end();
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
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5, 6], }},
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
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";

    $(".flashmessage").delay(3000).fadeOut(100);
});


