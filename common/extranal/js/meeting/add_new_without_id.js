"use strict";
$(document).ready(function () {
    $(".doctor_div").on("change", "#adoctors", function () {
        "use strict";
        var date = $('#date').val();
        var doctorr = $('#adoctors').val();
        $('#aslots').find('option').remove();
        $.ajax({
            url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + date + '&doctor=' + doctorr,
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
    });
});

$(document).ready(function () {
    "use strict";

    var date = $('#date').val();
    var doctorr = $('#adoctors').val();
    $('#aslots').find('option').remove();
    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + date + '&doctor=' + doctorr,
        method: 'GET',
        data: '',
        dataType: 'json',
        success: function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots').append($('<option>').text(value).val(value)).end();
            });
            $("#aslots").val(response.current_value)
                    .find("option[value=" + response.current_value + "]").attr('selected', true);
            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
        }
    })
});




$(document).ready(function () {
    $('#date').datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
    })

            .change(dateChanged)
            .on('changeDate', dateChanged);
});

function dateChanged() {

    "use strict";
    var date = $('#date').val();
    var doctorr = $('#adoctors').val();
    $('#aslots').find('option').remove();
    $.ajax({
        url: 'schedule/getAvailableSlotByDoctorByDateByJason?date=' + date + '&doctor=' + doctorr,
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

