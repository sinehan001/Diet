$(document).ready(function () {
  "use strict";
  $(".table").on("click", ".editbutton", function () {
    //  e.preventDefault(e);
    // Get the record's ID via attribute
    var iid = $(this).attr("data-id");
    $("#editDoctorvisitForm").trigger("reset");
    $.ajax({
      url: "doctor/doctorvisit/editDoctorvisitByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        // Populate the form fields with the data returned from server
        $("#editDoctorvisitForm")
          .find('[name="id"]')
          .val(response.doctorvisit.id)
          .end();
        // $('#editPcategoryForm').find('[name="name"]').val(response.doctorvisit.name).end();
        $("#editDoctorvisitForm")
          .find('[name="visit_description"]')
          .val(response.doctorvisit.visit_description)
          .end();
        $("#editDoctorvisitForm")
          .find('[name="visit_charges"]')
          .val(response.doctorvisit.visit_charges)
          .end();
        $("#editDoctorvisitForm")
          .find('[name="status"]')
          .val(response.doctorvisit.status)
          .trigger("change");
        //  $('#editPcategoryForm').find('[name="phone"]').val(response.accountant.phone).end()
        var option1 = new Option(
          response.doctor.name + "-" + response.doctor.id,
          response.doctor.id,
          true,
          true
        );
        $("#editDoctorvisitForm")
          .find('[name="doctor"]')
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
      url: "doctor/doctorvisit/getDoctorvisitList",
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
});
