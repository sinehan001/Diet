"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editAllotmentForm').trigger("reset");
        $('#myModal2').modal('show');
        $.ajax({
            url: 'bed/editallotmentByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editAllotmentForm').find('[name="id"]').val(response.allotment.id).end()
                $('#editAllotmentForm').find('[name="bed_id"]').val(response.allotment.bed_id).end()

                var option = new Option(response.patient.name + '-' + response.patient.id, response.patient.id, true, true);
                $('#editAllotmentForm').find('[name="patient"]').append(option).trigger('change');
                $('#editAllotmentForm').find('[name="a_time"]').val(response.allotment.a_time).end()
                $('#editAllotmentForm').find('[name="d_time"]').val(response.allotment.d_time).end()
            }
        })
    });
});



$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,

        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "bed/getBedAllotmentList",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
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

$(document).ready(function () {
    "use strict";
    $(".startDate").on("change", "#datetimepicker", function () {
        "use strict";
        var date = $(this).val();
        var category = $('#bedcategory').val();
        $.ajax({
            url: 'bed/getNotAvailableBed?date=' + date + '&category=' + category,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var data = ' ';
                if (response.bedlist.length !== 0) {
                    $.each(response.bedlist, function (index, value) {

                        data = value.d_time;
                    });
                    alert(already_booked + '\n' + avaiable_bed_after + data);
                    $('#enddatetimepicker').val(" ");
                    $('#datetimepicker').val(" ");
                }
            }
        })

    });
    $(".endDate").on("change", "#enddatetimepicker", function () {
        "use strict";
        var date = $(this).val();
        var category = $('#bedcategory').val();
        $.ajax({
            url: 'bed/getNotAvailableBed?date=' + date + '&category=' + category,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var startdata = ' ';
                var enddata = ' ';
                if (response.bedlist.length !== 0) {
                    $.each(response.bedlist, function (index, value) {

                        enddata = value.d_time;
                        startdata = value.a_time
                    });
                    alert(already_booked + '\n' + startdata + ' To ' + enddata + '\n' + please_choose_bed_after_that + '\n');
                    $('#enddatetimepicker').val(" ");
                    $('#datetimepicker').val(" ");
                }
            }
        })

    });
    $(".editstartdate").on("change", "#editdatetimepicker", function () {
        "use strict";
        var date = $(this).val();
        var category = $('#bedcategory').val();
        var id = $('#allotid').val();
        $.ajax({
            url: 'bed/getNotAvailableBedFromEdit?date=' + date + '&category=' + category + '&id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var data = ' ';
                if (response.bedlist.length !== 0) {
                    $.each(response.bedlist, function (index, value) {

                        data = value.d_time;
                    });
                    alert(already_booked + '\n' + avaiable_bed_after + data);
                    $('#enddatetimepicker').val(" ");
                    $('#datetimepicker').val(" ");
                }
            }
        })

    });
    $(".editenddate").on("change", "#editenddatetimepicker", function () {
        "use strict";

        var date = $(this).val();
        var category = $('#bedcategory').val();
        var id = $('#allotid').val();
        $.ajax({
            url: 'bed/getNotAvailableBedFromEdit?date=' + date + '&category=' + category + '&id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                var startdata = ' ';
                var enddata = ' ';
                if (response.bedlist.length !== 0) {
                    $.each(response.bedlist, function (index, value) {

                        enddata = value.d_time;
                        startdata = value.a_time
                    });
                    alert(already_booked + '\n' + startdata + ' To ' + enddata + '\n' + please_choose_bed_after_that + '\n');
                    $('#enddatetimepicker').val(" ");
                    $('#datetimepicker').val(" ");
                }
            }
        })

    });
});


