$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    //  e.preventDefault(e);
    // Get the record's ID via attribute
    var iid = $(this).attr("data-id");
    $("#editDieticianvisitForm").trigger("reset");
    $.ajax({
      url: "dietician/dieticianvisit/editDieticianvisitByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        // Populate the form fields with the data returned from server
        $("#editDieticianvisitForm")
          .find('[name="id"]')
          .val(response.dieticianvisit.id)
          .end();
        // $('#editPcategoryForm').find('[name="name"]').val(response.dieticianvisit.name).end();
        $("#editDieticianvisitForm")
          .find('[name="visit_description"]')
          .val(response.dieticianvisit.visit_description)
          .end();
        $("#editDieticianvisitForm")
          .find('[name="visit_charges"]')
          .val(response.dieticianvisit.visit_charges)
          .end();
        $("#editDieticianvisitForm")
          .find('[name="status"]')
          .val(response.dieticianvisit.status)
          .trigger("change");
        //  $('#editPcategoryForm').find('[name="phone"]').val(response.accountant.phone).end()
        var option1 = new Option(
          response.dietician.name + "-" + response.dietician.id,
          response.dietician.id,
          true,
          true
        );
        $("#editDieticianvisitForm")
          .find('[name="dietician"]')
          .append(option1)
          .trigger("change");
        $("#myModal2").modal("show");
      },
    });
  });
});

$(document).ready(function () {
  "use strict";
  var table = $("#editable-sample").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',

    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "dietician/dieticianvisit/getDieticianvisitList",
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

$(document).ready(function () {
  $(".flashmessage").delay(3000).fadeOut(100);
  $("#adieticians").select2({
    placeholder: select_dietician,
    allowClear: true,
    ajax: {
      url: "dietician/getDieticianInfo",
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
  $("#adieticians1").select2({
    placeholder: select_dietician,
    allowClear: true,
    ajax: {
      url: "dietician/getDieticianInfo",
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
