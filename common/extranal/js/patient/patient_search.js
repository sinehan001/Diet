"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", "#submit2", function () {
        "use strict";
        var id = $("#id").val();
        console.log(id);
    });
});

$(document).ready(function () {
    "use strict";
    fetch_data_by_id($("#id").val());
    $("#submit1").on("click", function(){
        fetch_data_by_id($("#id").val());
    });
    $(".table").on("click", ".inffo", function () {
        "use strict";
        var iid = $(this).attr('data-id');

        $('.patientIdClass').html("").end();
        $('.nameClass').html("").end();
        $('.emailClass').html("").end();
        $('.addressClass').html("").end();
        $('.genderClass').html("").end();
        $('.birthdateClass').html("").end();
        $('.bloodgroupClass').html("").end();
        $('.patientidClass').html("").end();
        $('.doctorClass').html("").end();
        $('.ageClass').html("").end();
        $('.phoneClass').html("").end(); 
        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('.patientIdClass').append(response.patient.id).end();
                $('.nameClass').append(response.patient.name).end();
                $('.emailClass').append(response.patient.email).end();
                $('.addressClass').append(response.patient.address).end();
                $('.phoneClass').append(response.patient.phone).end();
                $('.genderClass').append(response.patient.sex).end();
                $('.birthdateClass').append(response.patient.birthdate).end();
                $('.ageClass').append(response.age).end();
                $('.bloodgroupClass').append(response.patient.bloodgroup).end();
                $('.patientidClass').append(response.patient.patient_id).end();
                if (response.doctor !== null) {
                    $('.doctorClass').append(response.doctor.name).end();
                } else {
                    $('.doctorClass').append('').end();
                }
                $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
                if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                    $("#img1").attr("src", response.patient.img_url);
                }
                $('#infoModal').modal('show');
            }
        })
    });
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
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

                if (response.doctor !== null) {
                    var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
                } else {
                    var option1 = new Option(' ' + '-' + '', '', true, true);
                }
                $('#editPatientForm').find('[name="doctor"]').append(option1).trigger('change');


                $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');

                $('#myModal2').modal('show');
            }
        })
    });
});

let table = '';

function fetch_data_by_id(uid) {
    if(table) {
        table.destroy();
    }
    table = $('#editable-sample').DataTable({
        responsive: true,
        //   dom: 'lfrBtip',
        retrieve: true,
        searching: false,
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "ajax": {
            url: "patient/patient_search/getPatient",
            type: 'POST',
            data: {"id": uid},
            dataType:"json",
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
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
}

$(document).ready(function () {
    "use strict";
    $("#doctorchoose").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
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
    $("#doctorchoose1").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorInfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
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
