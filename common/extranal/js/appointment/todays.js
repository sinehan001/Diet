"use strict";
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    var iid = $(this).attr("data-id");
    var id = $(this).attr("data-id");
    $(".consultant_fee_div").addClass("hidden");
    $(".pay_now").addClass("hidden");
    $(".payment_status").addClass("hidden");
    $(".deposit_type1").addClass("hidden");
    $("#editAppointmentForm").trigger("reset");
    $("#myModal2").modal("show");
    $.ajax({
      url: "appointment/editAppointmentByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var de = response.appointment.date * 1000;
        var d = new Date(de);

        var da = d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
        // Populate the form fields with the data returned from server
        $("#editAppointmentForm")
          .find('[name="id"]')
          .val(response.appointment.id)
          .end();
        $("#editAppointmentForm")
          .find('[name="patient"]')
          .val(response.appointment.patient)
          .end();
        $("#editAppointmentForm")
          .find('[name="doctor"]')
          .val(response.appointment.doctor)
          .end();
        $("#editAppointmentForm").find('[name="date"]').val(da).end();
        $("#editAppointmentForm")
          .find('[name="status"]')
          .val(response.appointment.status)
          .end();
        $("#editAppointmentForm")
          .find('[name="remarks"]')
          .val(response.appointment.remarks)
          .end();

        var option = new Option(
          response.patient.name + "-" + response.patient.id,
          response.patient.id,
          true,
          true
        );
        $("#editAppointmentForm")
          .find('[name="patient"]')
          .append(option)
          .trigger("change");
        var option1 = new Option(
          response.doctor.name + "-" + response.doctor.id,
          response.doctor.id,
          true,
          true
        );
        $("#editAppointmentForm")
          .find('[name="doctor"]')
          .append(option1)
          .trigger("change");
        $("#visit_description1").html("");
        $.ajax({
          url:
            "doctor/getDoctorVisitForEdit?id=" +
            response.doctor.id +
            "&description=" +
            response.appointment.visit_description,
          method: "GET",
          data: "",
          dataType: "json",
          success: function (response1) {
            $("#visit_description1").html(response1.response).end();
            // $('#editAppointmentForm').find('[name="visit_description"]').val(response.appointment.visit_description).trigger('change').end();
          },
        });
        if (response.appointment.payment_status == "unpaid") {
          $(".consultant_fee_div").removeClass("hidden");
          $(".pay_now").removeClass("hidden");
          $(".payment_status").addClass("hidden");
          // $('.deposit_type1').removeClass('hidden');
          $("#editAppointmentForm")
            .find('[name="visit_charges"]')
            .val(response.appointment.visit_charges)
            .end();
          $("#editAppointmentForm")
            .find('[name="discount"]')
            .val(response.appointment.discount)
            .end();
          $("#editAppointmentForm")
            .find('[name="grand_total"]')
            .val(response.appointment.grand_total)
            .end();
        } else {
          $(".payment_status").removeClass("hidden");
          $(".pay_now").addClass("hidden");
          $(".consultant_fee_div").addClass("hidden");
          //  $('.deposit_type1').addClass('hidden');
          $("#editAppointmentForm")
            .find('[id="adoctors1"]')
            .select2([
              {
                id: response.doctor.id,
                text: response.doctor.name + "-" + response.doctor.id,
                locked: true,
              },
            ]);
          $("#editAppointmentForm")
            .find('[id="pos_select"]')
            .select2([
              {
                id: response.patient.id,
                text: response.patient.name + "-" + response.patient.id,
                locked: true,
              },
            ]);
        }
        var date = $("#date1").val();
        var doctorr = $("#adoctors1").val();
        var appointment_id = $("#appointment_id").val();

        $.ajax({
          url:
            "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
            date +
            "&doctor=" +
            doctorr +
            "&appointment_id=" +
            appointment_id,
          method: "GET",
          data: "",
          dataType: "json",
          success: function (response) {
            $("#aslots1").find("option").remove();
            var slots = response.aslots;
            $.each(slots, function (key, value) {
              "use strict";
              $("#aslots1").append($("<option>").text(value).val(value)).end();
            });

            $("#aslots1").val(response.current_value).trigger("change");

            if ($("#aslots1").has("option").length == 0) {
              //if it is blank.
              $("#aslots1")
                .append(
                  $("<option>")
                    .text("No Further Time Slots")
                    .val("Not Selected")
                )
                .end();
            }
          },
        });
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".history", function () {
    "use strict";
    var iid = $(this).attr("data-id");

    $("#editAppointmentForm").trigger("reset");
    $.ajax({
      url: "patient/getMedicalHistoryByjason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#medical_history").html("");
        $("#medical_history").append(response.view);
      },
    });
    $("#cmodal").modal("show");
  });
});

$(document).ready(function () {
  "use strict";
  $(".doctor_div").on("change", "#adoctors", function () {
    var iid = $("#date").val();
    var doctorr = $("#adoctors").val();
    $("#aslots").find("option").remove();

    $.ajax({
      url:
        "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
        iid +
        "&doctor=" +
        doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        var slots = response.aslots;
        $.each(slots, function (key, value) {
          "use strict";
          $("#aslots").append($("<option>").text(value).val(value)).end();
        });

        if ($("#aslots").has("option").length == 0) {
          //if it is blank.
          $("#aslots")
            .append(
              $("<option>").text("No Further Time Slots").val("Not Selected")
            )
            .end();
        }
      },
    });
    $("#visit_description").html(" ");
    $("#visit_charges").val(" ");
    $.ajax({
      url: "doctor/getDoctorVisit?id=" + doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response1) {
        $("#visit_description").html(response1.response).end();
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var iid = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
      iid +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots").has("option").length == 0) {
        //if it is blank.
        $("#aslots")
          .append(
            $("<option>").text("No Further Time Slots").val("Not Selected")
          )
          .end();
      }
    },
  });
});

$(document).ready(function () {
  "use strict";
  $("#date")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })
    //Listen for the change even on the input
    // .change(dateChanged)
    .on("changeDate", dateChanged);
});

function dateChanged() {
  "use strict";
  // Get the record's ID via attribute
  var iid = $("#date").val();
  var doctorr = $("#adoctors").val();
  $("#aslots").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByJason?date=" +
      iid +
      "&doctor=" +
      doctorr,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots").has("option").length == 0) {
        $("#aslots")
          .append(
            $("<option>").text("No Further Time Slots").val("Not Selected")
          )
          .end();
      }
    },
  });
}

$(document).ready(function () {
  "use strict";
  $(".doctor_div1").on("change", "#adoctors1", function () {
    "use strict";
    // Get the record's ID via attribute
    var id = $("#appointment_id").val();
    var date = $("#date1").val();
    var doctorr = $("#adoctors1").val();
    $("#aslots1").find("option").remove();

    $.ajax({
      url:
        "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
        date +
        "&doctor=" +
        doctorr +
        "&appointment_id=" +
        id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var slots = response.aslots;
        $.each(slots, function (key, value) {
          "use strict";
          $("#aslots1").append($("<option>").text(value).val(value)).end();
        });

        if ($("#aslots1").has("option").length == 0) {
          //if it is blank.
          $("#aslots1")
            .append(
              $("<option>").text("No Further Time Slots").val("Not Selected")
            )
            .end();
        }
      },
    });
    $("#visit_description1").html(" ");
    $("#visit_charges1").val(" ");
    $.ajax({
      url: "doctor/getDoctorVisit?id=" + doctorr,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response1) {
        $("#visit_description1").html(response1.response).end();
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var id = $("#appointment_id").val();
  var date = $("#date1").val();
  var doctorr = $("#adoctors1").val();
  $("#aslots1").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
      date +
      "&doctor=" +
      doctorr +
      "&appointment_id=" +
      id,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots1").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots1").has("option").length == 0) {
        //if it is blank.
        $("#aslots1")
          .append(
            $("<option>").text("No Further Time Slots").val("Not Selected")
          )
          .end();
      }
    },
  });
});

$(document).ready(function () {
  "use strict";
  $("#date1")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })
    //Listen for the change even on the input
    // .change(dateChanged1)
    .on("changeDate", dateChanged1);
});

function dateChanged1() {
  "use strict";
  // Get the record's ID via attribute
  var id = $("#appointment_id").val();
  var iid = $("#date1").val();
  var doctorr = $("#adoctors1").val();
  $("#aslots1").find("option").remove();

  $.ajax({
    url:
      "schedule/getAvailableSlotByDoctorByDateByAppointmentIdByJason?date=" +
      iid +
      "&doctor=" +
      doctorr +
      "&appointment_id=" +
      id,
    method: "GET",
    data: "",
    dataType: "json",
    success: function (response) {
      "use strict";
      var slots = response.aslots;
      $.each(slots, function (key, value) {
        "use strict";
        $("#aslots1").append($("<option>").text(value).val(value)).end();
      });

      if ($("#aslots1").has("option").length == 0) {
        //if it is blank.
        $("#aslots1")
          .append(
            $("<option>").text("No Further Time Slots").val("Not Selected")
          )
          .end();
      }
    },
  });
}

$(document).ready(function () {
  "use strict";
  $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
    "use strict";
    $.fn.dataTable
      .tables({ visible: true, api: true })
      .columns.adjust()
      .responsive.recalc();
  });
});

$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample1").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "appointment/getTodaysAppoinmentList",
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
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
    iDisplayLength: 100,
    order: [[0, "desc"]],
    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});
$(document).ready(function () {
  $(".card").hide();
  $(document.body).on("change", "#selecttype", function () {
    var v = $("select.selecttype option:selected").val();
    if (v == "Card") {
      $(".cardsubmit").removeClass("hidden");
      $(".cashsubmit").addClass("hidden");
      // $("#amount_received").prop('required', true);
      // $('#amount_received').attr("required");;
      $(".card").show();
    } else {
      $(".card").hide();
      $(".cashsubmit").removeClass("hidden");
      $(".cardsubmit").addClass("hidden");
      // $("#amount_received").prop('required', false);
      //$('#amount_received').removeAttr('required');
    }
  });
  $(".card1").hide();
  $(document.body).on("change", "#selecttype1", function () {
    var v = $("select.selecttype1 option:selected").val();
    if (v == "Card") {
      $(".cardsubmit1").removeClass("hidden");
      $(".cashsubmit1").addClass("hidden");
      // $("#amount_received").prop('required', true);
      // $('#amount_received').attr("required");;
      $(".card1").show();
    } else {
      $(".card1").hide();
      $(".cashsubmit1").removeClass("hidden");
      $(".cardsubmit1").addClass("hidden");
      // $("#amount_received").prop('required', false);
      //$('#amount_received').removeAttr('required');
    }
  });
  $("#pay_now_appointment").change(function () {
    if ($(this).prop("checked") == true) {
      $(".deposit_type").removeClass("hidden");
      $("#addAppointmentForm").find('[name="deposit_type"]').trigger("reset");
      // $('#editAppointmentForm').find('[name="status"]').val("Confirmed").end()
    } else {
      $("#addAppointmentForm").find('[name="deposit_type"]').val("").end();
      $(".deposit_type").addClass("hidden");
      //  $('#editAppointmentForm').find('[name="status"]').val("").end()

      $(".card").hide();
    }
  });
  $("#pay_now_appointment1").change(function () {
    if ($(this).prop("checked") == true) {
      $(".deposit_type1").removeClass("hidden");
      $("#editAppointmentForm").find('[name="deposit_type"]').trigger("reset");
      // $('#editAppointmentForm').find('[name="status"]').val("Confirmed").end()
    } else {
      $("#editAppointmentForm").find('[name="deposit_type"]').val("").end();
      $(".deposit_type1").addClass("hidden");
      //  $('#editAppointmentForm').find('[name="status"]').val("").end()

      $(".card1").hide();
    }
  });
});
