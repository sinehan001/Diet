"use strict";
var myEditor1=" ";
var myEditor2=" ";
var myEditor3 =" ";
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor1 = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor2 = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor3'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor3 = editor;
            })
            .catch(error => {
                console.error(error);
            });


});
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editPrescription", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#myModal5').modal('show');
        $.ajax({
            url: 'prescription/editPrescriptionByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var de = response.prescription.date * 1000;
                var d = new Date(de);
                var da = (d.getDate() + 1) + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();

                $('#prescriptionEditForm').find('[name="id"]').val(response.prescription.id).end();
                $('#prescriptionEditForm').find('[name="date"]').val(da).end();

                $('#prescriptionEditForm').find('[name="patient"]').val(response.prescription.patient).end();
                $('#prescriptionEditForm').find('[name="doctor"]').val(response.prescription.doctor).end();

                myEditor1.setData(response.prescription.symptom);
                myEditor2.setData(response.prescription.medicine);
                myEditor3.setData(response.prescription.note);
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


