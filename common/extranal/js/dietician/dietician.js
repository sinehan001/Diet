"use strict";
$(document).ready(function () {
  "use strict";

  $(".table").on("click", ".editbutton", function () {
    "use strict";

    var iid = $(this).attr("data-id");
    $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
    $("#editDieticianForm").trigger("reset");
    $("#myModal2").modal("show");
    $.ajax({
      url: "dietician/editDieticianByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";

        // Populate the form fields with the data returned from server
        $("#editDieticianForm").find('[name="id"]').val(response.dietician.id).end();
        $("#editDieticianForm")
          .find('[name="name"]')
          .val(response.dietician.name)
          .end();
        $("#editDieticianForm")
          .find('[name="password"]')
          .val(response.dietician.password)
          .end();
        $("#editDieticianForm")
          .find('[name="email"]')
          .val(response.dietician.email)
          .end();
        $("#editDieticianForm")
          .find('[name="address"]')
          .val(response.dietician.address)
          .end();
        $("#editDieticianForm")
          .find('[name="phone"]')
          .val(response.dietician.phone)
          .end();
        $("#editDieticianForm")
          .find('[name="department"]')
          .val(response.dietician.department)
          .end();
        $("#editDieticianForm")
          .find('[name="profile"]')
          .val(response.dietician.profile)
          .end();
        $("#editDieticianForm")
          .find('[name="visit_price"]')
          .val(response.dietician.visit_price)
          .end();
        if (
          typeof response.dietician.img_url !== "undefined" &&
          response.dietician.img_url !== ""
        ) {
          $("#img").attr("src", response.dietician.img_url);
        }

        $(".js-example-basic-single.department")
          .val(response.dietician.department)
          .trigger("change");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";

  $(".table").on("click", ".inffo", function () {
    "use strict";

    var iid = $(this).attr("data-id");

    $(".nameClass").html("").end();
    $(".emailClass").html("").end();
    $(".addressClass").html("").end();
    $(".phoneClass").html("").end();
    $(".departmentClass").html("").end();
    $(".profileClass").html("").end();
    $.ajax({
      url: "dietician/editDieticianByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        "use strict";

        $("#editDieticianForm1").find('[name="id"]').val(response.dietician.id).end();
        $(".nameClass").append(response.dietician.name).end();
        $(".emailClass").append(response.dietician.email).end();
        $(".addressClass").append(response.dietician.address).end();
        $(".phoneClass").append(response.dietician.phone).end();
        $(".departmentClass").append(response.dietician.department_name).end();
        $(".profileClass").append(response.dietician.profile).end();

        $("#img1").attr(
          "src",
          "uploads/cardiology-patient-icon-vector-6244713.jpg"
        );

        if (
          typeof response.dietician.img_url !== "undefined" &&
          response.dietician.img_url !== ""
        ) {
          $("#img1").attr("src", response.dietician.img_url);
        }

        $("#infoModal").modal("show");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";

  var table = $("#editable-sample").DataTable({
    responsive: true,

    processing: true,
    serverSide: true,
    searchable: true,
    bScrollCollapse: true,
    ajax: {
      url: "dietician/getDietician",
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
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  table.buttons().container().appendTo(".custom_buttons");
});

$(document).ready(function () {
  "use strict";

  $(".flashmessage").delay(3000).fadeOut(100);
});
