"use strict";
$(document).ready(function () {
    "use strict";
    var myEditor;

    $(document).ready(function () {

        ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                    editor.ui.view.editable.element.style.height = '200px';
                    myEditor = editor;
                })
                .catch(error => {
                    console.error(error);
                });

    });
    $(".table").on("click", ".edittbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#myModal2').modal('show');
        $.ajax({
            url: 'patient/editMedicalHistoryByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end();
                $('#medical_historyEditForm').find('[name="date"]').val(response.medical_history.date).end();
                $('#medical_historyEditForm').find('[name="patient"]').val(response.medical_history.patient_id).end();
                myEditor.setData(response.medical_history.description);

                $('.js-example-basic-single.patient').val(response.medical_history.patient_id).trigger('change');

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
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2, 3, 4, 5], }},
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

