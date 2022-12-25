"use strict";
var video = document.getElementById('video');

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {

    navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
        video.srcObject = stream;
        video.play();
    });
}
"use strict";

var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');

document.getElementById("snap").addEventListener("click", function () {
    "use strict";
    context.drawImage(video, 0, 0, 200, 200);
});

$(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr('data-id');
    $('#editPatientForm').trigger("reset");
    $('#myModal2').modal('show');
    $.ajax({
        url: 'patient/editPatientByJason?id=' + iid,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {

            "use strict";
            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end();
            $('#editPatientForm').find('[name="name"]').val(response.patient.name).end();
            $('#editPatientForm').find('[name="password"]').val(response.patient.password).end();
            $('#editPatientForm').find('[name="email"]').val(response.patient.email).end();
            $('#editPatientForm').find('[name="address"]').val(response.patient.address).end();
            $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end();
            $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end();
            $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end();
            $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end();
            $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end();

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img").attr("src", response.patient.img_url);
            }

            $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');
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
            url: "patient/getPatientPayments",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3], }},
            {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3], }},
            {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3], }},
            {extend: 'print', exportOptions: {columns: [1, 2, 3], }},
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




