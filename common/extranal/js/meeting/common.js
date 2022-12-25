"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        var id = $(this).attr('data-id');

        $('#editMeetingForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'meeting/editMeetingByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                var de = response.meeting.date * 1000;
                var d = new Date(de);
                var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();

                $('#editMeetingForm').find('[name="id"]').val(response.meeting.id).end()
                $('#editMeetingForm').find('[name="patient"]').val(response.meeting.patient).end()
                $('#editMeetingForm').find('[name="doctor"]').val(response.meeting.doctor).end()
                $('#editMeetingForm').find('[name="meeting_id"]').val(response.meeting.meeting_id).end()
                $('#editMeetingForm').find('[name="meeting_password"]').val(response.meeting.meeting_password).end()
                $('#editMeetingForm').find('[name="date"]').val(da).end()
                $('#editMeetingForm').find('[name="s_time"]').val(response.meeting.s_time).end()
                $('#editMeetingForm').find('[name="e_time"]').val(response.meeting.e_time).end()
                $('#editMeetingForm').find('[name="status"]').val(response.meeting.status).end()
                $('#editMeetingForm').find('[name="remarks"]').val(response.meeting.remarks).end()


                var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
                $('#editMeetingForm').find('[name="patient"]').append(option).trigger('change');
                var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
                $('#editMeetingForm').find('[name="doctor"]').append(option1).trigger('change');



                var date = $('#date1').val();
                var doctorr = $('#adoctors1').val();
                var meeting_id = $('#meeting_id').val();

                $.ajax({
                    url: 'schedule/getAvailableSlotByDoctorByDateByMeetingIdByJason?date=' + date + '&doctor=' + doctorr + '&meeting_id=' + meeting_id,
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
    $(".table").on("click", ".history", function () {
        "use strict";

        var iid = $(this).attr('data-id');

        $('#editMeetingForm').trigger("reset");
        $.ajax({
            url: 'patient/getMedicalHistoryByjason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                $('#medical_history').html("");
            $('#medical_history').append(response.view);
            }
        })
        $('#cmodal').modal('show');
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

            .change(dateChanged)
            .on('changeDate', dateChanged);
});

function dateChanged() {
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
              var slots = response.aslots;
        $.each(slots, function (key, value) {
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

        var id = $('#meeting_id').val();
        var date = $('#date1').val();
        var doctorr = $('#adoctors1').val();
        $('#aslots1').find('option').remove();

        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByMeetingIdByJason?date=' + date + '&doctor=' + doctorr + '&meeting_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
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
    var id = $('#meeting_id').val();
    var date = $('#date1').val();
    var doctorr = $('#adoctors1').val();
    $('#aslots1').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByMeetingIdByJason?date=' + date + '&doctor=' + doctorr + '&meeting_id=' + id,
        method: 'GET',
        data: '',
        dataType: 'json',
         success: function (response) {
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
    var id = $('#meeting_id').val();
    var iid = $('#date1').val();
    var doctorr = $('#adoctors1').val();
    $('#aslots1').find('option').remove();

    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByMeetingIdByJason?date=' + iid + '&doctor=' + doctorr + '&meeting_id=' + id,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
             var slots = response.aslots;
        $.each(slots, function (key, value) {
            $('#aslots1').append($('<option>').text(value).val(value)).end();
        });

        if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
            $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
        }
        }
    })

}

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    "use strict";
    $.fn.dataTable
            .tables({visible: true, api: true})
            .columns.adjust();
})

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
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
    $("#adoctors").select2({
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
    $("#adoctors1").select2({
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