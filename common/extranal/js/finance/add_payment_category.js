"use strict";
$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample").DataTable({
    responsive: true,

    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    buttons: [
      { extend: "copyHtml5", exportOptions: { columns: [0, 1, 2, 3, 4] } },
      { extend: "excelHtml5", exportOptions: { columns: [0, 1, 2, 3, 4] } },
      { extend: "csvHtml5", exportOptions: { columns: [0, 1, 2, 3, 4] } },
      { extend: "pdfHtml5", exportOptions: { columns: [0, 1, 2, 3, 4] } },
      { extend: "print", exportOptions: { columns: [0, 1, 2, 3, 4] } },
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
  $("#category_name").keyup(function () {
    $("#notification").html("");
    var attr = $(this).val();
    var id = $("#id").val();
    $.ajax({
      url: "finance/getPaymentCategoryNameVerify?attr=" + attr + "&id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        if (response.response == "yes") {
          $("#notification").html(" ");
          $("#submit_form").attr("disabled", false);
        } else {
          $("#notification").html("Already Existed Payment Item Name");
          $("#submit_form").attr("disabled", true);
        }
      },
    });
  });
});
