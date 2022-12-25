"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editScheduleButton", function () {
        "use strict";
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editTimeSlotForm').trigger("reset");
        $('#editScheduleModal').modal('show');
        $.ajax({
            url: 'schedule/editScheduleByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editTimeSlotForm').find('[name="id"]').val(response.schedule.id).end();
                $('#editTimeSlotForm').find('[name="s_time"]').val(response.schedule.s_time).end();
                $('#editTimeSlotForm').find('[name="e_time"]').val(response.schedule.e_time).end();
                $('#editTimeSlotForm').find('[name="weekday"]').val(response.schedule.weekday).end();
            }
        })
    });
});
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        // Get the record's ID via attribute  
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
                $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
                $('#medical_historyEditForm').find('[name="date"]').val(response.medical_history.date).end()
                myEditor1.setData(response.medical_history.description)
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editHoliday", function () {
        "use strict";
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $('#editHolidayForm').trigger("reset");
        $('#editHolidayModal').modal('show');
        $.ajax({
            url: 'schedule/editHolidayByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                var date = new Date(response.holiday.date * 1000);
                $('#editHolidayForm').find('[name="id"]').val(response.holiday.id).end()
                $('#editHolidayForm').find('[name="date"]').val(date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear()).end()
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $('.pos_client').hide();
    $(document.body).on('change', '#pos_select', function () {
        "use strict";
        var v = $("select.pos_select option:selected").val()
        if (v == 'add_new') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });
    $('.pos_client').hide();
    $(document.body).on('change', '#pos_select1', function () {
        "use strict";
        var v = $("select.pos_select1 option:selected").val()
        if (v == 'add_new') {
            $('.pos_client').show();
        } else {
            $('.pos_client').hide();
        }
    });

});






$(document).ready(function () {
    "use strict";
    $(".appointment_edit").on("click", ".editAppointmentButton", function () {
        "use strict";
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        var id = $(this).attr('data-id');

        $('#editAppointmentForm').trigger("reset");
        //$('#patientregistration').css('display', 'none');

        $('#editAppointmentModal').modal('show');
        $.ajax({
            url: 'appointment/editAppointmentByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var de = response.appointment.date * 1000;
                var d = new Date(de);
                var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();

                $('#editAppointmentForm').find('[name="id"]').val(response.appointment.id).end()

                $('#editAppointmentForm').find('[name="doctor"]').val(response.appointment.doctor).end()
                $('#editAppointmentForm').find('[name="date"]').val(da).end()
                $('#editAppointmentForm').find('[name="status"]').val(response.appointment.status).end()
                $('#editAppointmentForm').find('[name="remarks"]').val(response.appointment.remarks).end()
                var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
                $('#editAppointmentForm').find('[name="patient"]').append(option).trigger('change');
                $('.js-example-basic-single.doctor').val(response.appointment.doctor).trigger('change');



                var date = $('#date1').val();
                var doctorr = $('#adoctors1').val();
                var appointment_id = $('#appointment_id').val();

                $.ajax({
                    url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + appointment_id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                    success: function (response) {
                        "use strict";
                        $('#aslots1').find('option').remove();
                        var slots = response.aslots;
                        $.each(slots, function (key, value) {
                            $('#aslots1').append($('<option>').text(value).val(value)).end();
                        });

                        $("#aslots1").val(response.current_value)
                                .find("option[value=" + response.current_value + "]").attr('selected', true);

                        if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                            $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                        }
                    }
                })
            }
        })
    });
});
$(document).ready(function () {
    "use strict";

    $(".doctor_div").on("change", "#adoctors", function () {
        "use strict";

        var iid = $('#date').val();
        var doctorr = $('#adoctors').val();
        $('#aslots').find('option').remove();

        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    "use strict";
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });

                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
            }
        })
    });

});

$(document).ready(function () {
    "use strict";
    var iid = $('#date').val();
    var doctorr = $('#adoctors').val();
    $('#aslots').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            "use strict";
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                "use strict";
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });

            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
        }
    })

});




$(document).ready(function () {
    "use strict";
    $('#date').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    })
            //Listen for the change even on the input
            .change(dateChanged)
            .on('changeDate', dateChanged);
});

function dateChanged() {
    "use strict";
    // Get the record's ID via attribute  
    var iid = $('#date').val();
    var doctorr = $('#adoctors').val();
    $('#aslots').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + iid + '&doctor=' + doctorr,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
             "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
            "use strict";
            $('#aslots').append($('<option>').text(value).val(value)).end();
        });

        if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
            $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
        }
        }
    })

}

$(document).ready(function () {
    "use strict";
    $(".doctor_div1").on("change", "#adoctors1", function () {
        "use strict";
        var id = $('#appointment_id').val();
        var date = $('#date1').val();
        var doctorr = $('#adoctors1').val();
        $('#aslots1').find('option').remove();

        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
             success: function (response) {
                    "use strict";
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });

            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }

             }
        })
    });
});

$(document).ready(function () {
    "use strict";
    var id = $('#appointment_id').val();
    var date = $('#date1').val();
    var doctorr = $('#adoctors1').val();
    $('#aslots1').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + date + '&doctor=' + doctorr + '&appointment_id=' + id,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
             "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
            "use strict";
            $('#aslots1').append($('<option>').text(value).val(value)).end();
        });

        if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
            $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
        }
        }
    })

});
$(document).ready(function () {
    "use strict";
    $('#date1').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    })

            .change(dateChanged1)
            .on('changeDate', dateChanged1);
});

function dateChanged1() {
    "use strict";
    // Get the record's ID via attribute  
    var id = $('#appointment_id').val();
    var iid = $('#date1').val();
    var doctorr = $('#adoctors1').val();
    $('#aslots1').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=' + iid + '&doctor=' + doctorr + '&appointment_id=' + id,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
              "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
            "use strict";
            $('#aslots1').append($('<option>').text(value).val(value)).end();
        });

        if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
            $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
        }
         }
    })

}









$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
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
            searchPlaceholder: "Search..."
        },
    });

    table.buttons().container()
            .appendTo('.custom_buttons');
});




$(document).ready(function () {
    "use strict";
    $("#pos_select").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfoWithAddNewOption',
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
    $("#pos_select1").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfoWithAddNewOption',
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
    $(".patient").select2({
        placeholder: select_patient,
        allowClear: true,
        ajax: {
            url: 'patient/getPatientinfo',
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
    $("#add_doctor").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorWithAddNewOption',
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


var myEditor1;

$(document).ready(function () {
ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor1 = editor;
            })
            .catch(error => {
                console.error(error);
            });
    


});

