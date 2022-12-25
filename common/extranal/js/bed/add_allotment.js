// "use strict";
// $(document).ready(function () {
//     "use strict";
//     $("#patientchoose").select2({
//         placeholder: select_patient,
//         allowClear: true,
//         ajax: {
//             url: 'patient/getPatientinfo',
//             type: "post",
//             dataType: 'json',
//             delay: 250,
//             data: function (params) {
//                 return {
//                     searchTerm: params.term // search term
//                 };
//             },
//             processResults: function (response) {
//                 return {
//                     results: response
//                 };
//             },
//             cache: true
//         }

//     });

// });

// $(document).ready(function () {
//     "use strict";
//     $(".startDate").on("change", "#datetimepicker", function () {
//         "use strict";
//         var date = $(this).val();
//         var category = $('#bedcategory').val();
//         $.ajax({
//             url: 'bed/getNotAvailableBed?date=' + date + '&category=' + category,
//             method: 'GET',
//             data: '',
//             dataType: 'json',
//             success: function (response) {
//                 "use strict";
//                 var data = ' ';
//                 if (response.bedlist.length !== 0) {
//                     $.each(response.bedlist, function (index, value) {

//                         data = value.d_time;
//                     });
//                     alert(already_booked + '\n' + avaiable_bed_after + data);
//                     $('#enddatetimepicker').val(" ");
//                     $('#datetimepicker').val(" ");
//                 }
//             }
//         })

//     });
//     $(".endDate").on("change", "#enddatetimepicker", function () {
//         "use strict";

//         var date = $(this).val();
//         var category = $('#bedcategory').val();
//         $.ajax({
//             url: 'bed/getNotAvailableBed?date=' + date + '&category=' + category,
//             method: 'GET',
//             data: '',
//             dataType: 'json',
//             success: function (response) {
//                 "use strict";
//                 var startdata = ' ';
//                 var enddata = ' ';
//                 if (response.bedlist.length !== 0) {
//                     $.each(response.bedlist, function (index, value) {

//                         enddata = value.d_time;
//                         startdata = value.a_time
//                     });
//                     alert(already_booked + '\n' + startdata + ' To ' + enddata + '\n' + please_choose_bed_after_that + '\n');
//                     $('#enddatetimepicker').val(" ");
//                     $('#datetimepicker').val(" ");
//                 }
//             }
//         })
//     });

// });

$(document).ready(function () {
  $("#doctors").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorInfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $("#accepting_doctors").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorInfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $("#patientchoose").select2({
    placeholder: select_patient,
    allowClear: true,
    ajax: {
      url: "patient/getPatientinfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
});

$(document).ready(function () {
  $("#room_no").change(function () {
    var id = $(this).val();
    $("#bed_id").html(" ");
    var alloted_time = $("#alloted_time").val();
    $.ajax({
      url: "bed/getBedByRoomNo?id=" + id + "&alloted_time=" + alloted_time,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#bed_id").html(response.response);
      },
    });
  });
});

$(document).ready(function () {
  var table = $("#editable-sample").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "bed/getBedAllotmentList",
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3] } },
      { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3] } },
      { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3] } },
      { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3] } },
      { extend: "print", exportOptions: { columns: [0, 1, 2, 3] } },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 100,
    order: [[0, "desc"]],
    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});
