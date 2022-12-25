"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editMeetingForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'meeting/editMeetingByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editMeetingForm').find('[name="id"]').val(response.meeting.id).end()

                $('#editMeetingForm').find('[name="date"]').val(response.meeting.date).end()
                $('#editMeetingForm').find('[name="remarks"]').val(response.meeting.remarks).end()
                var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
                $('#editMeetingForm').find('[name="patient"]').append(option).trigger('change');
                var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
                $('#editMeetingForm').find('[name="doctor"]').append(option1).trigger('change');
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
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2, 3], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2, 3], }},
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
    $(".patientchoose1").select2({
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
    $("#doctorchoose").select2({
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
    $('#calendarview').fullCalendar({
        lang: 'en',
        events: 'appointment/getAppointmentByJasonByDoctor?id=' + doctor_id,
        header:
                {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },

        timeFormat: 'h(:mm) A',
        eventRender: function (event, element) {
            element.find('.fc-time').html(element.find('.fc-time').text());
            element.find('.fc-title').html(element.find('.fc-title').text());

        },
        eventClick: function (event) {
            "use strict";
            $('#medical_history').html("");
            if (event.id) {
                $.ajax({
                    url: 'patient/getMedicalHistoryByJason?id=' + event.id + '&from_where=calendar',
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                    success: function (response) {
                        $('#medical_history').html("");
                        $('#medical_history').append(response.view);
                    }
                })

            }

            $('#cmodal').modal('show');
        },
        slotDuration: '00:5:00',
        businessHours: false,
        slotEventOverlap: false,
        editable: false,
        selectable: false,
        lazyFetching: true,
        minTime: "6:00:00",
        maxTime: "24:00:00",
        defaultView: 'month',
        allDayDefault: false,
        displayEventEnd: true,
        timezone: false,
    });
});
$(document).ready(function () {
    $(".flashmessage").delay(3000).fadeOut(100);
});
