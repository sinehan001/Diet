"use strict";
var myEditor;
var myEditor2;
var myEditor3;
$(document).ready(function () {
  ClassicEditor.create(document.querySelector("#editor1"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });
  ClassicEditor.create(document.querySelector("#editor2"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor = editor;
    })
    .catch((error) => {
      console.error(error);
    });
  ClassicEditor.create(document.querySelector("#editor3"))
    .then((editor) => {
      editor.ui.view.editable.element.style.height = "200px";
      myEditor3 = editor;
    })
    .catch((error) => {
      console.error(error);
    });
});
$(document).ready(function () {
  "use strict";
  var selected = $("#my_select1_disabled").find("option:selected");
  var unselected = $("#my_select1_disabled").find("option:not(:selected)");
  selected.attr("data-selected", "1");
  $.each(unselected, function (index, value1) {
    "use strict";
    if ($(this).attr("data-selected") == "1") {
      var value = $(this).val();
      var res = value.split("*");

      var id = res[0];
      $("#med_selected_section-" + id).remove();
    }
  });

  var count = 0;
  $.each($("select.medicinee option:selected"), function () {
    "use strict";
    var value = $(this).val();
    var res = value.split("*");

    var id = res[0];

    var med_id = res[0];
    var med_name = res[1];
    var dosage = $(this).data("dosage");
    var frequency = $(this).data("frequency");
    var days = $(this).data("days");
    var instruction = $(this).data("instruction");
    if ($("#med_id-" + id).length) {
    } else {
      $(".medicine").append(
        '<section id="med_selected_section-' +
          med_id +
          '" class="med_selected row">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' +
          med_name +
          '" placeholder="" required>\n\
 <input type="hidden" id="med_id-' +
          id +
          '" class = "medi_div" name = "medicine[]" value = "' +
          med_id +
          '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "' +
          dosage +
          '" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' +
          count +
          '" name = "frequency[]" value = "' +
          frequency +
          '" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' +
          count +
          '" name = "days[]" value = "' +
          days +
          '" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' +
          count +
          '" name = "instruction[]" value = "' +
          instruction +
          '" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>'
      );
    }
  });
});

$(document).ready(function () {
  "use strict";
  $(".medicine_div").on("change", ".medicinee", function () {
    "use strict";
    var count = 0;

    var selected = $("#my_select1_disabled").find("option:selected");
    var unselected = $("#my_select1_disabled").find("option:not(:selected)");
    selected.attr("data-selected", "1");
    $.each(unselected, function (index, value1) {
      "use strict";
      if ($(this).attr("data-selected") == "1") {
        var value = $(this).val();
        var res = value.split("*");

        var id = res[0];
        $("#med_selected_section-" + id).remove();
      }
    });

    $.each($("select.medicinee option:selected"), function () {
      "use strict";
      var value = $(this).val();
      var res = value.split("*");

      var id = res[0];

      var med_id = res[0];
      var med_name = res[1];

      if ($("#med_id-" + id).length) {
      } else {
        $(".medicine").append(
          '<section class="med_selected row" id="med_selected_section-' +
            med_id +
            '">\n\
         <div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label> <?php echo lang("medicine"); ?> </label>\n\
</div>\n\
\n\
<div class=col-md-12>\n\
<input class = "medi_div" name = "med_id[]" value = "' +
            med_name +
            '" placeholder="" required>\n\
 <input type="hidden" class = "medi_div" id="med_id-' +
            id +
            '" name = "medicine[]" value = "' +
            med_id +
            '" placeholder="" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2" ><div class=col-md-12>\n\
<label><?php echo lang("dosage"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "state medi_div" name = "dosage[]" value = "" placeholder="100 mg" required>\n\
 </div>\n\
 </div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label><?php echo lang("frequency"); ?> </label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div sale" id="salee' +
            count +
            '" name = "frequency[]" value = "" placeholder="1 + 0 + 1" required>\n\
</div>\n\
</div>\n\
\n\
<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("days"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' +
            count +
            '" name = "days[]" value = "" placeholder="7 days" required>\n\
</div>\n\
</div>\n\
\n\
\n<div class = "form-group medicine_sect col-md-2"><div class=col-md-12>\n\
<label>\n\
<?php echo lang("instruction"); ?> \n\
</label>\n\
</div>\n\
<div class=col-md-12><input class = "potency medi_div quantity" id="quantity' +
            count +
            '" name = "instruction[]" value = "" placeholder="After Food" required>\n\
</div>\n\
</div>\n\
\n\
\n\
 <div class="del col-md-1"></div>\n\
</section>'
        );
      }
    });
  });
});

$(document).ready(function () {
  "use strict";
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
  $("#doctorchoose").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorinfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term,
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
  $("#doctorchoose1").select2({
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
  $("#my_select1").select2({
    multiple: true,
    placeholder: select_medicine,
    allowClear: true,
    closeOnSelect: true,
    ajax: {
      url: "medicine/getMedicinenamelist",
      dataType: "json",
      type: "post",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term, // search term
          page: params.page,
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 1;

        return {
          results: data,
          newTag: true,
          pagination: {
            more: params.page * 1 < data.total_count,
          },
        };
      },
      cache: true,
    },
  });
});

$(document).ready(function () {
  "use strict";
  $("#my_select1_disabled").select2({
    placeholder: select_medicine,
    multiple: true,
    allowClear: true,
    ajax: {
      url: "medicine/getMedicineListForSelect2",
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
  $("#my_select1_lab_disabled").select2({
    placeholder: lab_test,
    multiple: true,
    allowClear: true,
    ajax: {
      url: "prescription/getPaymentCategoryListForSelect2",
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
