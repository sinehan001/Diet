"use strict";

$(document).ready(function () {
  "use strict";
  $(".medical_history_button").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#myModal2").modal("show");
    $.ajax({
      url: "patient/editMedicalHistoryByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        var date = new Date(response.medical_history.date * 1000);
        var de =
          date.getDate() +
          "-" +
          (date.getMonth() + 1) +
          "-" +
          date.getFullYear();

        $("#medical_historyEditForm")
          .find('[name="id"]')
          .val(response.medical_history.id)
          .end();
        $("#medical_historyEditForm").find('[name="date"]').val(de).end();
        $("#medical_historyEditForm")
          .find('[name="title"]')
          .val(response.medical_history.title)
          .end();
        myEditor.setData(response.medical_history.description);
      },
    });
  });
  $(".vitalSignTable").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#myModalVitalEdit").modal("show");
    $.ajax({
      url: "patient/editVitalSignByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";

        $("#editVitalSign")
          .find('[name="id"]')
          .val(response.vital_sign.id)
          .end();
        $("#editVitalSign")
          .find('[name="bmi_height"]')
          .val(response.vital_sign.bmi_height)
          .end();
        $("#editVitalSign")
          .find('[name="bmi_weight"]')
          .val(response.vital_sign.bmi_weight)
          .end();
        $("#editVitalSign")
          .find('[name="respiratory_rate"]')
          .val(response.vital_sign.respiratory_rate)
          .end();
        $("#editVitalSign")
          .find('[name="oxygen_saturation"]')
          .val(response.vital_sign.oxygen_saturation)
          .end();
        $("#editVitalSign")
          .find('[name="temperature"]')
          .val(response.vital_sign.temperature)
          .end();
        $("#editVitalSign")
          .find('[name="diastolic_blood_pressure"]')
          .val(response.vital_sign.diastolic_blood_pressure)
          .end();
        $("#editVitalSign")
          .find('[name="systolic_blood_pressure"]')
          .val(response.vital_sign.systolic_blood_pressure)
          .end();
        $("#editVitalSign")
          .find('[name="heart_rate"]')
          .val(response.vital_sign.heart_rate)
          .end();
      },
    });
  });
});

var myEditor = " ";
var myEditor123 = " ";
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });
  ClassicEditor.create(document.querySelector("#editor_case"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor123 = editor;
    })
    .catch((error) => {
      console.error(error);
    });
});

$(document).ready(function () {
  "use strict";
  $(".edit_appointment_button").on(
    "click",
    ".editAppointmentButton",
    function () {
      "use strict";
      var iid = $(this).attr("data-id");
      var id = $(this).attr("data-id");

      $("#editAppointmentForm").trigger("reset");
      $(".consultant_fee_div").addClass("hidden");
      $(".pay_now").addClass("hidden");
      $(".payment_status").addClass("hidden");
      $(".deposit_type1").addClass("hidden");
      $("#editAppointmentModal").modal("show");
      $.ajax({
        url: "appointment/editAppointmentByJason?id=" + iid,
        method: "GET",
        data: "",
        dataType: "json",
        success: function (response) {
          "use strict";
          var de = response.appointment.date * 1000;
          var d = new Date(de);
          var da =
            d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();

          $("#editAppointmentForm")
            .find('[name="id"]')
            .val(response.appointment.id)
            .end();
          $("#editAppointmentForm")
            .find('[name="patient"]')
            .val(response.appointment.patient)
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

          $(".js-example-basic-single.patient")
            .val(response.appointment.patient)
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
              .val(response1.appointment.visit_charges)
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
              .find('[id="pos_select1"]')
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
              "use strict";
              $("#aslots1").find("option").remove();
              var slots = response.aslots;
              $.each(slots, function (key, value) {
                $("#aslots1")
                  .append($("<option>").text(value).val(value))
                  .end();
              });

              $("#aslots1").val(response.current_value).trigger("change");

              if ($("#aslots1").has("option").length == 0) {
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
    }
  );
});

$(document).ready(function () {
  "use strict";
  $(".doctor_div").on("change", "#adoctors", function () {
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
        "use strict";
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
});

$(document).ready(function () {
  "use strict";
  $("#date")
    .datepicker({
      format: "dd-mm-yyyy",
      autoclose: true,
    })

    // .change(dateChanged)
    .on("changeDate", dateChanged);
});

function dateChanged() {
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

    // .change(dateChanged1)
    .on("changeDate", dateChanged1);
});

function dateChanged1() {
  "use strict";
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
  $("#editable-sample").DataTable({
    responsive: true,
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "excelHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "csvHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "pdfHtml5", exportOptions: { columns: [0, 1] } },
      { extend: "print", exportOptions: { columns: [0, 1] } },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: -1,
    order: [[0, "desc"]],
    language: {
      lengthMenu: "_MENU_ records per page",
    },
  });
});

$(document).ready(function () {
  "use strict";
  $(".edit_patient_div").on("click", ".editPatient", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#editPatientForm").trigger("reset");
    $.ajax({
      url: "patient/editPatientByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#editPatientForm")
          .find('[name="id"]')
          .val(response.patient.id)
          .end();
        $("#editPatientForm")
          .find('[name="name"]')
          .val(response.patient.name)
          .end();
        $("#editPatientForm")
          .find('[name="password"]')
          .val(response.patient.password)
          .end();
        $("#editPatientForm")
          .find('[name="email"]')
          .val(response.patient.email)
          .end();
        $("#editPatientForm")
          .find('[name="address"]')
          .val(response.patient.address)
          .end();
        $("#editPatientForm")
          .find('[name="phone"]')
          .val(response.patient.phone)
          .end();
        $("#editPatientForm")
          .find('[name="sex"]')
          .val(response.patient.sex)
          .end();
        $("#editPatientForm")
          .find('[name="birthdate"]')
          .val(response.patient.birthdate)
          .end();
        $("#editPatientForm")
          .find('[name="bloodgroup"]')
          .val(response.patient.bloodgroup)
          .end();
        $("#editPatientForm")
          .find('[name="p_id"]')
          .val(response.patient.patient_id)
          .end();

        if (
          typeof response.patient.img_url !== "undefined" &&
          response.patient.img_url !== ""
        ) {
          $("#img").attr("src", response.patient.img_url);
        }

        $(".js-example-basic-single.doctor")
          .val(response.patient.doctor)
          .trigger("change");
        $("#infoModal").modal("show");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";

  $("#adoctors").select2({
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
  $("#adoctors1").select2({
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
});
$(document).ready(function () {
  "use strict";
  $(".folder_div").on("click", ".edittbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#editFolderForm").trigger("reset");
    $("#myModalfe").modal("show");
    $.ajax({
      url: "patient/editFolderByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#editFolderForm").find('[name="id"]').val(response.folder.id).end();
        $("#editFolderForm")
          .find('[name="folder_name"]')
          .val(response.folder.folder_name)
          .end();
        $("#editFolderForm")
          .find('[name="patient"]')
          .val(response.folder.patient)
          .end();
      },
    });
  });
});
$(document).on("click", ".upload", function () {
  "use strict";
  var folder_name = $(this).data("name");
  $("#hidden_folder_name").val(folder_name);
  $("#myModalff").modal("show");
});
$(document).ready(function () {
  "use strict";
  $(".folder_div").on("click", ".uploadbutton", function () {
    "use strict";
    // Get the record's ID via attribute
    var iid = $(this).attr("data-id");
    $("#uploadFileForm").trigger("reset");
    $("#myModalff").modal("show");
    $.ajax({
      url: "patient/editFolderByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";
        $("#uploadFileForm")
          .find('[name="folder"]')
          .val(response.folder.id)
          .end();
      },
    });
  });
});
$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);
  $("#pos_select").select2({
    placeholder: select_patient,
    allowClear: false,
    ajax: {
      url: "patient/getPatientinfoWithId",
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
  $("#pos_select").on("change", function () {
    var id = $(this).val();
    //   var url = "<?php echo site_url();?>" + "patient/medicalHistory?id=" + id;
    window.location.href = "patient/medicalHistory?id=" + id;
    // $(location).attr("href", url);
  });
});
$(document).ready(function () {
  $("#visit_description").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#visit_charges").val(response.response.visit_charges).end();
        var discount = $("#discount").val();
        $("#grand_total")
          .val(parseFloat(response.response.visit_charges - discount))
          .end();
      },
    });
  });
  $("#discount").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges").val();
    $("#grand_total")
      .val(parseFloat(price - discount))
      .end();
  });
});
$(document).ready(function () {
  $("#visit_description1").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges1").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#visit_charges1").val(response.response.visit_charges).end();
        var discount = $("#discount1").val();
        $("#grand_total1")
          .val(parseFloat(response.response.visit_charges - discount))
          .end();
      },
    });
  });
  $("#discount1").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges1").val();
    $("#grand_total1")
      .val(parseFloat(price - discount))
      .end();
  });
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
function cardValidation() {
  "use strict";
  var valid = true;
  var cardNumber = $("#card").val();
  var expire = $("#expire").val();
  var cvc = $("#cvv").val();

  $("#error-message").html("").hide();

  if (cardNumber.trim() == "") {
    valid = false;
  }

  if (expire.trim() == "") {
    valid = false;
  }
  if (cvc.trim() == "") {
    valid = false;
  }

  if (valid == false) {
    $("#error-message").html("All Fields are required").show();
  }

  return valid;
}
//set your publishable key
Stripe.setPublishableKey(publish);

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
  "use strict";
  if (response.error) {
    $("#submit-btn").show();
    $("#loader").css("display", "none");

    $("#error-message").html(response.error.message).show();
    $("#submit-btn").attr("disabled", false);
    $("#error-message").html(response.error.message).show();
  } else {
    var token = response["id"];
    if (token != null) {
      $("#token").val(token);
      $("#addAppointmentForm").append(
        "<input type='hidden' name='token' value='" + token + "' />"
      );
      $("#addAppointmentForm").submit();
    } else {
      alert("Please Check Your Card details");
      $("#submit-btn").attr("disabled", false);
    }
  }
}

function stripePay(e) {
  "use strict";
  e.preventDefault();
  var valid = cardValidation();

  if (valid == true) {
    $("#submit-btn").attr("disabled", true);
    $("#loader").css("display", "inline-block");
    var expire = $("#expire").val();
    var arr = expire.split("/");
    Stripe.createToken(
      {
        number: $("#card").val(),
        cvc: $("#cvv").val(),
        exp_month: arr[0],
        exp_year: arr[1],
      },
      stripeResponseHandler
    );

    return false;
  }
}
function cardValidation1() {
  var valid = true;
  var cardNumber = $("#card1").val();
  var expire = $("#expire1").val();
  var cvc = $("#cvv1").val();

  $("#error-message").html("").hide();

  if (cardNumber.trim() == "") {
    valid = false;
  }

  if (expire.trim() == "") {
    valid = false;
  }
  if (cvc.trim() == "") {
    valid = false;
  }

  if (valid == false) {
    $("#error-message").html("All Fields are required").show();
  }

  return valid;
}
//set your publishable key
Stripe.setPublishableKey(publish);

//callback to handle the response from stripe
function stripeResponseHandler1(status, response) {
  if (response.error) {
    //enable the submit button
    $("#submit-btn1").show();
    $("#loader").css("display", "none");
    //display the errors on the form
    $("#error-message").html(response.error.message).show();
  } else {
    //get token id
    var token = response["id"];
    //insert the token into the form
    $("#token").val(token);
    $("#editAppointmentForm").append(
      "<input type='hidden' name='token' value='" + token + "' />"
    );
    //submit form to the server
    $("#editAppointmentForm").submit();
  }
}

function stripePay1(e) {
  e.preventDefault();
  var valid = cardValidation1();

  if (valid == true) {
    $("#submit-btn1").attr("disabled", true);
    $("#loader").css("display", "inline-block");
    var expire = $("#expire1").val();
    var arr = expire.split("/");
    Stripe.createToken(
      {
        number: $("#card1").val(),
        cvc: $("#cvv1").val(),
        exp_month: arr[0],
        exp_year: arr[1],
      },
      stripeResponseHandler1
    );

    //submit from callback
    return false;
  }
}

if (payment_gateway == "2Checkout") {
  var successCallback = function (data) {
    "use strict";
    var myForm = document.getElementById("addAppointmentForm");

    $("#addAppointmentForm").append(
      "<input type='hidden' name='token' value='" +
        data.response.token.token +
        "' />"
    );

    myForm.submit();
  };
  // Called when token creation fails.
  var errorCallback = function (data) {
    "use strict";
    if (data.errorCode === 200) {
      tokenRequest();
    } else {
      alert(data.errorMsg);
    }
  };
  var tokenRequest = function () {
    "use strict";
    var expire = $("#expire").val();
    var expiresep = expire.split("/");
    var dateformat = moment(expiresep[1], "YY");
    var year = dateformat.format("YYYY");
    var args = {
      sellerId: merchant,
      publishableKey: publishable,
      ccNo: $("#card").val(),
      cvv: $("#cvv").val(),
      expMonth: expiresep[0],
      expYear: year,
    };
    console.log(
      $("#card").val() + "-" + $("#cvv").val() + expiresep[0] + year + merchant
    );

    TCO.requestToken(successCallback, errorCallback, args);
  };

  function twoCheckoutPay(e) {
    "use strict";
    e.preventDefault();

    TCO.loadPubKey("sandbox", function () {
      // for sandbox environment
      publishableKey = publishable; //your public key
      tokenRequest();
    });

    return false;
  }

  var successCallback1 = function (data) {
    "use strict";
    var myForm = document.getElementById("editAppointmentForm");

    $("#editAppointmentForm").append(
      "<input type='hidden' name='token' value='" +
        data.response.token.token +
        "' />"
    );

    myForm.submit();
  };
  // Called when token creation fails.
  var errorCallback1 = function (data) {
    "use strict";
    if (data.errorCode === 200) {
      tokenRequest1();
    } else {
      alert(data.errorMsg);
    }
  };
  var tokenRequest1 = function () {
    "use strict";
    var expire = $("#expire1").val();
    var expiresep = expire.split("/");
    var dateformat = moment(expiresep[1], "YY");
    var year = dateformat.format("YYYY");
    var args = {
      sellerId: merchant,
      publishableKey: publishable,
      ccNo: $("#card1").val(),
      cvv: $("#cvv1").val(),
      expMonth: expiresep[0],
      expYear: year,
    };
    console.log(
      $("#card1").val() +
        "-" +
        $("#cvv1").val() +
        expiresep[0] +
        year +
        merchant
    );

    TCO.requestToken(successCallback, errorCallback, args);
  };

  function twoCheckoutPay1(e) {
    "use strict";
    e.preventDefault();

    TCO.loadPubKey("sandbox", function () {
      // for sandbox environment
      publishableKey = publishable; //your public key
      tokenRequest1();
    });

    return false;
  }
}
