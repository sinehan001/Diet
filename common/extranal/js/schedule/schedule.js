"use strict";
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#editTimeSlotForm").trigger("reset");
    $("#myModal2").modal("show");
    $.ajax({
      url: "schedule/editScheduleByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        // Populate the form fields with the data returned from server
        $("#editTimeSlotForm")
          .find('[name="id"]')
          .val(response.schedule.id)
          .end();
        $("#editTimeSlotForm")
          .find('[name="s_time"]')
          .val(response.schedule.s_time)
          .end();
        $("#editTimeSlotForm")
          .find('[name="e_time"]')
          .val(response.schedule.e_time)
          .end();
        $("#editTimeSlotForm")
          .find('[name="weekday"]')
          .val(response.schedule.weekday)
          .end();
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample").DataTable({
    responsive: true,

    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
      { extend: "print", exportOptions: { columns: [0, 1, 2, 3, 4, 5] } },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: -1,
    order: [[0, "desc"]],

    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });

  table.buttons().container().appendTo(".custom_buttons");
});

$(document).ready(function () {
  "use strict";
  $("#patientchoose").select2({
    placeholder: select_patient,
    allowClear: true,
    ajax: {
      url: "patient/getPatientinfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $("#doctorchoose").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorinfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
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
  $("#doctorchoose1").select2({
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
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $(".timepickers_time").on("change", "#s_time", function () {
    var s_time = $(this).val();
    var e_time = $("#e_time").val();
    var weekday = $("#weekday").val();
    var doctor = $("#doctorchoose").val();
    $.ajax({
      url: "schedule/getAvailableScheduleStime",
      method: "GET",
      data: {
        s_time: s_time,
        e_time: e_time,
        weekday: weekday,
        doctor: doctor,
      },
      dataType: "json",
      success: function (response) {
        if (response.response == "no") {
          alert("You have Already Schedule on that time.Please Change It");
          $("#addSubmit").attr("disabled", true);
        } else {
          $("#addSubmit").attr("disabled", false);
        }
      },
    });
  });
  $(".timepickere_time").on("change", "#e_time", function () {
    var e_time = $(this).val();
    var s_time = $("#s_time").val();
    var weekday = $("#weekday").val();
    var doctor = $("#doctorchoose").val();
    $.ajax({
      url: "schedule/getAvailableScheduleEtime",
      method: "GET",
      data: {
        s_time: s_time,
        e_time: e_time,
        weekday: weekday,
        doctor: doctor,
      },
      dataType: "json",
      success: function (response) {
        if (response.response == "no") {
          alert("You have Already Schedule on that time.Please Change It");
          $("#addSubmit").attr("disabled", true);
        } else if (response.response == "upper_lower") {
          alert("Start time Should be Lower Than The End Time");
          $("#addSubmit").attr("disabled", true);
        } else {
          $("#addSubmit").attr("disabled", false);
        }
      },
    });
  });
  $(".doctor_div").on("change", "#doctorchoose", function () {
    var doctor = $(this).val();
    var e_time = $("#e_time").val();
    var s_time = $("#s_time").val();
    var weekday = $("#weekday").val();
    if (s_time === null || e_time !== null) {
      $.ajax({
        url: "schedule/getAvailableScheduleEtime",
        method: "GET",
        data: {
          s_time: s_time,
          e_time: e_time,
          weekday: weekday,
          doctor: doctor,
        },
        dataType: "json",
        success: function (response) {
          if (response.response == "no") {
            alert("You have Already Schedule on that time.Please Change It");
            $("#addSubmit").attr("disabled", true);
          } else if (response.response == "upper_lower") {
            alert("Start time Should be Lower Than The End Time");
            $("#addSubmit").attr("disabled", true);
          } else {
            $("#addSubmit").attr("disabled", false);
          }
        },
      });
    } else {
      $.ajax({
        url: "schedule/getAvailableScheduleStime",
        method: "GET",
        data: {
          s_time: s_time,
          e_time: e_time,
          weekday: weekday,
          doctor: doctor,
        },
        dataType: "json",
        success: function (response) {
          if (response.response == "no") {
            alert("You have Already Schedule on that time.Please Change It");
            $("#addSubmit").attr("disabled", true);
          } else if (response.response == "upper_lower") {
            alert("Start time Should be Lower Than The End Time");
            $("#addSubmit").attr("disabled", true);
          } else {
            $("#addSubmit").attr("disabled", false);
          }
        },
      });
    }
  });
  $(".weekday_div").on("change", "#weekday", function () {
    var doctor = $("#doctorchoose").val();
    var e_time = $("#e_time").val();
    var s_time = $("#s_time").val();
    var weekday = $(this).val();
    if (s_time === null || e_time !== null) {
      $.ajax({
        url: "schedule/getAvailableScheduleEtime",
        method: "GET",
        data: {
          s_time: s_time,
          e_time: e_time,
          weekday: weekday,
          doctor: doctor,
        },
        dataType: "json",
        success: function (response) {
          if (response.response == "no") {
            alert("You have Already Schedule on that time.Please Change It");
            $("#addSubmit").attr("disabled", true);
          } else if (response.response == "upper_lower") {
            alert("Start time Should be Lower Than The End Time");
            $("#addSubmit").attr("disabled", true);
          } else {
            $("#addSubmit").attr("disabled", false);
          }
        },
      });
    } else {
      $.ajax({
        url: "schedule/getAvailableScheduleStime",
        method: "GET",
        data: {
          s_time: s_time,
          e_time: e_time,
          weekday: weekday,
          doctor: doctor,
        },
        dataType: "json",
        success: function (response) {
          if (response.response == "no") {
            alert("You have Already Schedule on that time.Please Change It");
            $("#addSubmit").attr("disabled", true);
          } else if (response.response == "upper_lower") {
            alert("Start time Should be Lower Than The End Time");
            $("#addSubmit").attr("disabled", true);
          } else {
            $("#addSubmit").attr("disabled", false);
          }
        },
      });
    }
  });
});

$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
});
