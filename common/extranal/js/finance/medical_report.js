"use strict";
$(document).ready(function () {
  $(".medical").on("change", "#type", function () {
    var type = $(this).val();

    if (type == "custom") {
      $(".date_from").addClass("dpd1");
      $(".date_to").addClass("dpd2");
      $(".dpd1").datepicker();
      $(".dpd2").datepicker();
    } else {
      $(".date_from").removeClass("dpd1");
      $(".date_to").removeClass("dpd2");
      $(".date_from").val("");
      $(".date_to").val("");
      $(".date_from").datepicker("destroy");
      $(".date_to").datepicker("destroy");
    }
  });
  $(".date_to").on("change", function () {
    var startDate = $(".date_from").val();
    var endDate = $(".date_to").val();
    if (endDate < startDate) {
      alert("End date should be greater than Start date.");
      $(".date_to").val("");
    }
  });
  //   $(".date_from").on("change", function () {
  //     var date = $(this).val();
  //     $(".date_to").datepicker({ minDate: date });
  //   });
});
