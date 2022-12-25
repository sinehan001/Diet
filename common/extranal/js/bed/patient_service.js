"use strict";
$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    "use strict";
    var iid = $(this).attr("data-id");
    $("#editPserviceForm").trigger("reset");
    $("#myModal2").modal("show");
    $.ajax({
      url: "pservice/editPserviceByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        // Populate the form fields with the data returned from server
        $("#editPserviceForm")
          .find('[name="price"]')
          .val(response.pservice.price)
          .end();
        $("#editPserviceForm")
          .find('[name="referential_price"]')
          .val(response.pservice.referential_price)
          .end();
        $("#editPserviceForm")
          .find('[name="special_price"]')
          .val(response.pservice.special_price)
          .end();
        if (response.pservice.active == "1") {
          $("#editPserviceForm")
            .find('[name="active"]')
            .prop("checked", true)
            .end();
        } else {
          $("#editPserviceForm")
            .find('[name="active"]')
            .prop("checked", false)
            .end();
        }
        $("#editPserviceForm")
          .find('[name="name"]')
          .val(response.pservice.name)
          .end();
        $("#editPserviceForm")
          .find('[name="id"]')
          .val(response.pservice.id)
          .end();
        $("#editPserviceForm")
          .find('[name="code"]')
          .val(response.pservice.code)
          .end();
        $("#editPserviceForm")
          .find('[name="alpha_code"]')
          .val(response.pservice.alpha_code)
          .end();
      },
    });
  });
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
      url: "pservice/getPserviceList",
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
  $(".flashmessage").delay(3000).fadeOut(100);
});
