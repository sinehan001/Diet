"use strict";
var myEditor;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor1"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });
});
var myEditor1;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor2"))
    .then((editor1) => {
      editor1.ui.view.editable.element.style.height = "200px";
      myEditor1 = editor1;
    })
    .catch((error) => {
      console.error(error);
    });
});
$(document).ready(function () {
  $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function () {
  $("#edittable_table").on("click", ".editbutton_dailyprogress", function (e) {
    var id = $(this).attr("data-id");
    $("#editDailyProgress").trigger("reset");
    $.ajax({
      url: "bed/getDailyProgress?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#editDailyProgress")
          .find('[name="daily_progress_id"]')
          .val(response.info.id)
          .end();
        $("#editDailyProgress")
          .find('[name="alloted_bed_id"]')
          .val(response.info.alloted_bed_id)
          .end();
        $("#editDailyProgress")
          .find('[name="date"]')
          .val(response.info.date)
          .end();
        $("#editDailyProgress")
          .find('[name="time"]')
          .val(response.info.time)
          .end();

        $("#editDailyProgress")
          .find('[name="description"]')
          .val(response.info.description)
          .end();
        $("#editDailyProgress")
          .find('[name="daily_description"]')
          .val(response.info.daily_description)
          .end();
        var option = new Option(
          response.nurse.name + "-" + response.nurse.id,
          response.nurse.id,
          true,
          true
        );
        $("#editDailyProgress")
          .find('[name="nurse"]')
          .append(option)
          .trigger("change");
      },
    });
    e.preventDefault();
  });

  $("#editBedAllotment").submit(function (e) {
    var dataString = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "bed/updateCheckin",
      data: dataString,
      success: function (response) {
        var data = jQuery.parseJSON(response);
        toastr.success(data.message);
      },
    });
    e.preventDefault();
  });
  $("#editCheckout").submit(function (e) {
    var datack = $("#editor1").val();
    var medicine_to_take = $("#editor2").val();
    var dataString = $(this).serialize();
    // dataString.push({ name: "instruction", value: datack });
    $.ajax({
      type: "POST",
      url: "bed/updateCheckout",
      data:
        dataString + "&instruction=" + datack + "&medicine=" + medicine_to_take,
      success: function (response) {
        var data = jQuery.parseJSON(response);
        toastr.success(data.message.message);
        $("#editCheckout").find('[name="id"]').val(data.checkout.id).end();
        if (admin == "other") {
          $("input").prop("readonly", true);
          $("textarea").prop("readonly", true);
          $("#checkout_submit").remove();
        }
      },
    });
    e.preventDefault();
  });
  $("#editDailyProgress").submit(function (e) {
    var dataString = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "bed/updateDailyProgress",
      data: dataString,
      success: function (response) {
        var data = jQuery.parseJSON(response);
        toastr.success(data.message.message);
        if (data.added.redir === "added") {
          var row_data = "";
          row_data +=
            "<tr class=''><td>" +
            data.info.date +
            "</td><td>" +
            data.info.time +
            "</td><td>" +
            data.info.description +
            "</td><td>" +
            data.nurse.name +
            "</td><td class='no-print'> <button type='button' class='btn btn-info btn-xs btn_width editbutton_dailyprogress' title='" +
            more +
            "' data-toggle='' data-id=" +
            data.info.id +
            "><i class='fa fa-edit'></i>" +
            more +
            "</button></td></tr>";
          $("#edittable_table").append(row_data);
        } else {
          var id = $("#editDailyProgress")
            .find('[name="daily_progress_id"]')
            .val();
          //  alert(data.info.id);
          $("#" + id)
            .children("td[data-target=date]")
            .text(data.info.date);
          $("#" + id)
            .children("td[data-target=time]")
            .text(data.info.time);
          $("#" + id)
            .children("td[data-target=description]")
            .text(data.info.description);
          $("#" + id)
            .children("td[data-target=nurse]")
            .text(data.nurse.name);
        }
        // $('#editBedAllotment')[0].reset();
        $(":input", "#editDailyProgress")
          .not(":button, :submit, :reset, :hidden")
          .val("")
          .prop("checked", false)
          .prop("selected", false);
        $("#daily_id").html("");
        $("#daily_id").html(
          "<input type='hidden' name='daily_progress_id' value=''>"
        );
        // $('#editDailyProgress').find('[name="daily_progress_id"]').val()
      },
    });
    e.preventDefault();
  });

  var option = new Option(
    patient_name + "(Id:" + patient_id + ")",
    patient_id,
    true,
    true
  );
  $("#editBedAllotment")
    .find('[name="patient"]')
    .append(option)
    .trigger("change");
  var option1 = new Option(
    doctor_name + "(Id:" + doctor_id + ")",
    doctor_id,
    true,
    true
  );
  $("#editBedAllotment")
    .find('[name="doctor"]')
    .append(option1)
    .trigger("change");
  var option2 = new Option(
    accepting_doctor_name + "(Id:" + accepting_doctor_id + ")",
    accepting_doctor_name,
    true,
    true
  );
  $("#editBedAllotment")
    .find('[name="accepting_doctor"]')
    .append(option2)
    .trigger("change");

  $("#generic_name").select2({
    placeholder: medicine_gen_name,
    allowClear: true,
    ajax: {
      url: "medicine/getGenericNameInfoByAll",
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
  $("#patientchoose").select2({
    placeholder: select_patient,
    allowClear: true,
    ajax: {
      url: "patient/getPatientinfo",
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
  $("#doctors").select2({
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
  $("#doctors_checkout").select2({
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
  $("#nurses").select2({
    placeholder: select_nurse,
    allowClear: true,
    ajax: {
      url: "bed/getNurseInfo",
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
  $("#nurse_service").select2({
    placeholder: select_nurse,
    allowClear: true,
    ajax: {
      url: "bed/getNurseInfo",
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
  $("#accepting_doctors").select2({
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
  $("#generic_name").change(function () {
    var id = $(this).val();
    $("#medicines_option").html(" ");
    $.ajax({
      url: "medicine/getMedicineByGeneric?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#medicines_option").html(response.response);
      },
    });
  });

  $("#room_no").change(function () {
    var id = $(this).val();

    $("#bed_id").html(" ");
    var alloted_time = $("#alloted_time").val();
    $.ajax({
      url: "bed/getBedByRoomNo?id=" + id + "&alloted_time=" + alloted_time,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#bed_id").html(response.response);
      },
    });
  });
  $("#medicines_option").change(function () {
    var id = $(this).val();
    $.ajax({
      url: "medicine/editMedicineByJason?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#editMedicine")
          .find('[name="sales_price"]')
          .val(response.medicine.s_price)
          .end();
        $("#editMedicine").find('[name="quantity"]').val("1").end();
        var total = response.medicine.s_price * 1;
        $("#editMedicine").find('[name="total"]').val(total).end();
      },
    });
  });
  $("#quantity").keyup(function () {
    var quantity = $(this).val();
    var s_price = $("#sales_price").val();
    //  alert(quantity);
    var total = quantity * s_price;
    $("#editMedicine").find('[name="sales_price"]').val(s_price).end();
    $("#editMedicine").find('[name="quantity"]').val(quantity).end();
    // var total = response.medicine.s_price * 1;
    $("#editMedicine").find('[name="total"]').val(total).end();
  });
  $("#editMedicine").submit(function (e) {
    var dataString = $(this).serialize();
    // alert(dataString); return false;

    $.ajax({
      type: "POST",
      url: "bed/updateMedicine",
      data: dataString,
      success: function (response) {
        var data = jQuery.parseJSON(response);
        toastr.success(data.message.message);
        var row_data = "";
        row_data +=
          "<tr class=''id='" +
          data.info.id +
          "'><td>" +
          data.info.date +
          "</td><td>" +
          data.info.generic_name +
          "</td><td>" +
          data.info.medicine_name +
          "</td><td>" +
          data.info.s_price +
          "</td><td>" +
          data.info.quantity +
          "</td><td>" +
          data.info.total +
          "</td><td class='no-print' id='delete-" +
          data.info.id +
          "'> <button type='button' class='btn btn-danger btn-xs btn_width delete_medicine' title='" +
          delete_lang +
          "' data-toggle='' data-id=" +
          data.info.id +
          "><i class='fa fa-trash'></i></button></td></tr>";
        $("#medicine_table").after(row_data);
        $(":input", "#editMedicine")
          .not(":button, :submit, :reset, :hidden")
          .val("")
          .prop("checked", false)
          .prop("selected", false);
      },
    });
    e.preventDefault();
  });
  $("#editable-table1").on("click", ".delete_medicine", function (e) {
    var id = $(this).attr("data-id");

    if (confirm("Are you sure you want to delete this Record?")) {
      $.ajax({
        type: "GET",
        url: "bed/deleteMedicine?id=" + id,
        data: "",
        success: function (response) {
          var data = jQuery.parseJSON(response);
          toastr.warning(data.message.message);
          $("#" + id).remove();
        },
      });
    }
    e.preventDefault();
  });
  $("#editable-table2").on("click", ".delete_service", function (e) {
    var id = $(this).attr("data-id");
    var splited = id.split("**");

    if (confirm("Are you sure you want to delete this Record?")) {
      $.ajax({
        type: "GET",
        url: "bed/deleteServices?id=" + id,
        data: "",
        success: function (response) {
          var data = jQuery.parseJSON(response);
          toastr.warning(data.message.message);
          $("#" + data.message.date + "-" + splited[1]).remove();
          $("#pservice-" + splited[1]).prop("checked", false);
        },
      });
    }
    e.preventDefault();
  });
});
$(document).ready(function () {
  $("#editable-table2").DataTable({
    responsive: true,
    //   dom: 'lfrBtip',
    bAutoWidth: true,
    processing: true,
    serverSide: false,
    searchable: false,
    autoWidth: false,
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-md-3'l><'col-sm-5 text-center'><'col-sm-4'>>" +
      "<'row'<'col-lg-12'tr>>" +
      "<'row'<'col-sm-5'><'col-sm-7'p>>",

    columns: [
      { width: "20%" },
      { width: "20%" },
      { width: "20%" },
      { width: "10%" },
      { width: "10%" },
      { width: "10%" },
      null,
    ],
    aLengthMenu: [
      [10, -1],
      [10, "All"],
    ],
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
  });
  $(".pservice_div").on("click", ".pservice", function () {
    // $(".pservice").click(function () {
    var arr = [];
    $("input.pservice:checkbox:checked").each(function () {
      arr.push($(this).val());
    });

    var nurse = $("#nurse_service").val();
    var alloted = $("#alloted").val();
    $.ajax({
      type: "POST",
      url: "bed/updateServices",
      dataType: "json",
      data: { arr: arr, nurse: nurse, alloted: alloted },
      success: function (response) {
        //var data = jQuery.parseJSON(response);
        toastr.success(response.message.message);
        $("#paservice_table").html(" ");
        if (response.option.option != null) {
          $("#paservice_table").html(response.option.option);
        } else {
          $("#paservice_table").html(" ");
        }
        var option = new Option(
          response.nurses.name + "-" + response.nurses.id,
          response.nurses.id,
          true,
          true
        );
        $('#id="nurses_select"')
          .find('[name="nurse_service"]')
          .append(option)
          .trigger("change");
      },
    });
  });
});
$(document).ready(function () {
  $(".save_button_div").on("click", "#save_button", function () {
    //   $("#save_button").click(function () {
    var id = $("#alloted").val();
    $.ajax({
      type: "GET",
      url: "bed/createMedicineInvoice?id=" + id,
      data: "",
      dataType: "json",
      success: function (response) {
        var ids = response.ids;
        var ids_split = ids.split(",");
        toastr.success(response.message.message);
        if (admin === "other") {
          $.each(ids_split, function (index, value) {
            $("#delete-" + value).remove();
          });
        }
      },
    });
  });
});
$(document).ready(function () {
  $(".save_button_service_div").on(
    "click",
    "#save_button_service",
    function () {
      //   $("#save_button_service").click(function () {
      var id = $("#alloted_service").val();
      $.ajax({
        type: "GET",
        url: "bed/createServiceInvoice?id=" + id,
        data: "",
        dataType: "json",
        success: function (response) {
          toastr.success(response.message.message);
          if (response.ids !== "1") {
            var ids = response.ids;
            var ids_split = ids.split(",");

            if (admin === "other") {
              $.each(ids_split, function (index, value) {
                $("#delete-service-" + response.date + "-" + value).remove();
              });
            }
          }
        },
      });
    }
  );
});
