"use strict";
var myEditor,myEditor1;

$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor = editor;
            })
            .catch((error) => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor1 = editor;
            })
            .catch((error) => {
                console.error(error);
            });
});
$(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr('data-id');

    $.ajax({
        url: 'patient/editMedicalHistoryByJason?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            "use strict";
            var de = response.medical_history.date * 1000;
            var d = new Date(de);
            var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
            $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end();
            $('#medical_historyEditForm').find('[name="date"]').val(da).end();

            $('#medical_historyEditForm').find('[name="title"]').val(response.medical_history.title).end();
            myEditor.setData(response.medical_history.description);
            var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
            $('#medical_historyEditForm').find('[name="patient_id"]').append(option).trigger('change');


            $('#myModal2').modal('show');
        }
    })
});
$(".table").on("click", ".case", function () {
    "use strict";
    var iid = $(this).attr('data-id');

    $('.case_date').html("").end();
    $('.case_details').html("").end();
    $('.case_title').html("").end();
    $('.case_patient').html("").end();
    $('.case_patient_id').html("").end();
    $.ajax({
        url: 'patient/getCaseDetailsByJason?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            "use strict";
            var de = response.case.date * 1000;
            var d = new Date(de);


            var monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];

            var day = d.getDate();
            var monthIndex = d.getMonth();
            var year = d.getFullYear();
            var da = day + ' ' + monthNames[monthIndex] + ', ' + year;
            $('.case_date').append(da).end();
            $('.case_patient').append(response.patient.name).end();
            $('.case_patient_id').append('ID: ' + response.patient.id).end();
            $('.case_title').append(response.case.title).end();
            $('.case_details').append(response.case.description).end();
            $('#caseModal').modal('show');
        }
    })
});
$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,
        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "patient/getCaseList",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
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
        iDisplayLength: 100,
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
    $("#patientchoose").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
    $("#patientchoose1").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });


});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

