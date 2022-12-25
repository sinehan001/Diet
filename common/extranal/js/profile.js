"use strict";
$(document).ready(function () {
  "use strict";
  $(".flashmessage").delay(3000).fadeOut(100);

  $(".patient_email").on("change", function () {
    var id = $(this).attr("id");
    var patient_id = $("#patient_id").val();
    var value = $("#" + id).val();
    $.ajax({
      url:
        "profile/updatePatientNotification?type=" +
        id +
        "&patient_id=" +
        patient_id +
        "&value=" +
        value,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        toastr.options = {
          closeButton: true,
          progressBar: true,
        };
        if (value == "Active") {
          toastr.success("Status Activated");
        } else {
          toastr.warning("Status Inactived");
        }
      },
    });
  });
  $(".doctor_email").on("change", function () {
    var id = $(this).attr("id");
    var doctor_id = $("#doctor_id").val();
    var value = $("#" + id).val();
    $.ajax({
      url:
        "profile/updateDoctorNotification?type=" +
        id +
        "&doctor_id=" +
        doctor_id +
        "&value=" +
        value,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        toastr.options = {
          closeButton: true,
          progressBar: true,
        };
        if (value == "Active") {
          toastr.success("Status Activated");
        } else {
          toastr.warning("Status Inactived");
        }
      },
    });
  });
});
