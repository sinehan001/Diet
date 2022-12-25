"use strict";
$(".multi-select").multiSelect({
  selectableHeader:
    "<input type='text' class='search-input' autocomplete='off' placeholder=' search...'>",
  selectionHeader:
    "<input type='text' class='search-input' autocomplete='off' placeholder=''>",
  afterInit: function (ms) {
    "use strict";
    var that = this,
      $selectableSearch = that.$selectableUl.prev(),
      $selectionSearch = that.$selectionUl.prev(),
      selectableSearchString =
        "#" +
        that.$container.attr("id") +
        " .ms-elem-selectable:not(.ms-selected)",
      selectionSearchString =
        "#" + that.$container.attr("id") + " .ms-elem-selection.ms-selected";

    that.qs1 = $selectableSearch
      .quicksearch(selectableSearchString)
      .on("keydown", function (e) {
        "use strict";
        if (e.which === 40) {
          that.$selectableUl.focus();
          return false;
        }
      });

    that.qs2 = $selectionSearch
      .quicksearch(selectionSearchString)
      .on("keydown", function (e) {
        "use strict";
        if (e.which === 40) {
          that.$selectionUl.focus();
          return false;
        }
      });
  },
  afterSelect: function () {
    "use strict";
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function () {
    "use strict";
    this.qs1.cache();
    this.qs2.cache();
  },
});

$("#my_multi_select3").multiSelect();

$(".default-date-picker").datepicker({
  format: "dd-mm-yyyy",
  autoclose: true,
  todayHighlight: true,
  startDate: "01-01-1900",
  clearBtn: true,
  language: langdate,

});

$("#date").on("changeDate", function () {
  "use strict";

  $("#date").datepicker("hide", {
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true,
    startDate: "01-01-1900",
    language: langdate,
  });
});

$("#date1").on("changeDate", function () {
  "use strict";
  $("#date1").datepicker("hide", {
    format: "dd-mm-yyyy",
    autoclose: true,
    todayHighlight: true,
    startDate: "01-01-1900",
    language: langdate,
  });
});

$(document).ready(function () {
  "use strict";
  $("#calendar").fullCalendar({
    lang: "en",
    events: "appointment/getAppointmentByJason",
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay",
    },

    timeFormat: "h(:mm) A",
    eventRender: function (event, element) {
      element.find(".fc-time").html(element.find(".fc-time").text());
      element.find(".fc-title").html(element.find(".fc-title").text());
    },
    eventClick: function (event) {
      $("#medical_history").html("");
      if (event.id) {
        $.ajax({
          url:
            "patient/getMedicalHistoryByJason?id=" +
            event.id +
            "&from_where=calendar",
          method: "GET",
          data: "",
          dataType: "json",
          success: function (response) {
            "use strict";
            $("#medical_history").html("");
            $("#medical_history").append(response.view);
          },
        });
      }

      $("#cmodal").modal("show");
    },

    slotDuration: "00:5:00",
    businessHours: false,
    slotEventOverlap: false,
    editable: false,
    selectable: false,
    lazyFetching: true,
    minTime: "6:00:00",
    maxTime: "24:00:00",
    defaultView: "month",
    allDayDefault: false,
    displayEventEnd: true,
    timezone: false,
  });
});

$(document).ready(function () {
  "use strict";
  $(".timepicker-default").timepicker({ defaultTime: "value" });
});

$(document).ready(function () {
  "use strict";
  $(".js-example-basic-single").select2();

  $(".js-example-basic-multiple").select2();
});

$(document).ready(function () {
  "use strict";
  var windowH = $(window).height();
  var wrapperH = $("#container").height();
  if (windowH > wrapperH) {
    $("#sidebar").css("height", windowH + "px");
  } else {
    $("#sidebar").css("height", wrapperH + "px");
  }
  var windowSize = window.innerWidth;
  if (windowSize < 768) {
    $("#sidebar").removeAttr("style");
  }
});
function onElementHeightChange(elm, callback) {
  "use strict";
  var newHeight;
  var lastHeight = elm.clientHeight,
    newHeight;
  (function run() {
    "use strict";
    newHeight = elm.clientHeight;
    if (lastHeight !== newHeight) callback();
    lastHeight = newHeight;
    if (elm.onElementHeightChangeTimer)
      clearTimeout(elm.onElementHeightChangeTimer);
    elm.onElementHeightChangeTimer = setTimeout(run, 200);
  })();
}

onElementHeightChange(document.body, function () {
  "use strict";
  var windowH = $(window).height();
  var wrapperH = $("#container").height();
  if (windowH > wrapperH) {
    $("#sidebar").css("height", windowH + "px");
  } else {
    $("#sidebar").css("height", wrapperH + "px");
  }

  var windowSize = $(window).width();
  if (windowSize < 768) {
    $("#sidebar").removeAttr("style");
  }
});

//
//
//$(window).resize(function () {
//    "use strict";
//    if (width === $(window).width()) {
//        return;
//    }
//    var width = $(window).width();
//    if (width < 600) {
//        $('#sidebar').hide();
//    } else {
//        $('#sidebar').show();
//    }
//
//});

$(document).ready(function () {
  var width = $(window).width();
  if (width < 768) {
    $("#sidebar > ul").hide();
    $("#sidebar").removeAttr("style");
  } else {
    $("#sidebar > ul").show();
  }
});

var color = "white";
let reply_click = (clicked_id) => {
  //var function = reply_click(clicked_id) {
  var c = document.getElementById(clicked_id).getAttribute("fill");

  if (c != "white") {
    document.getElementById(clicked_id).setAttribute("fill", "white");
  } else {
    document.getElementById(clicked_id).setAttribute("fill", color);
  }
  //alert(color);
  var c = document.getElementById(clicked_id).getAttribute("fill");
  var fill = c;
  if (clicked_id == "Tooth32") {
    if (document.getElementById("t32").value == fill) {
      document.getElementById("t32").value = "white";
    } else {
      document.getElementById("t32").value = fill;
    }
  } else if (clicked_id == "Tooth31") {
    if (document.getElementById("t31").value == fill) {
      document.getElementById("t31").value = "white";
    } else {
      document.getElementById("t31").value = fill;
    }
  } else if (clicked_id == "Tooth30") {
    if (document.getElementById("t30").value == fill) {
      document.getElementById("t30").value = "white";
    } else {
      document.getElementById("t30").value = fill;
    }
  } else if (clicked_id == "Tooth29") {
    if (document.getElementById("t29").value == fill) {
      document.getElementById("t29").value = "white";
    } else {
      document.getElementById("t29").value = fill;
    }
  } else if (clicked_id == "Tooth28") {
    if (document.getElementById("t28").value == fill) {
      document.getElementById("t28").value = "white";
    } else {
      document.getElementById("t28").value = fill;
    }
  } else if (clicked_id == "Tooth27") {
    if (document.getElementById("t27").value == fill) {
      document.getElementById("t27").value = "white";
    } else {
      document.getElementById("t27").value = fill;
    }
  } else if (clicked_id == "Tooth26") {
    if (document.getElementById("t26").value == fill) {
      document.getElementById("t26").value = "white";
    } else {
      document.getElementById("t26").value = fill;
    }
  } else if (clicked_id == "Tooth25") {
    if (document.getElementById("t25").value == fill) {
      document.getElementById("t25").value = "white";
    } else {
      document.getElementById("t25").value = fill;
    }
  } else if (clicked_id == "Tooth24") {
    if (document.getElementById("t24").value == fill) {
      document.getElementById("t24").value = "white";
    } else {
      document.getElementById("t24").value = fill;
    }
  } else if (clicked_id == "Tooth23") {
    if (document.getElementById("t23").value == fill) {
      document.getElementById("t23").value = "white";
    } else {
      document.getElementById("t23").value = fill;
    }
  } else if (clicked_id == "Tooth22") {
    if (document.getElementById("t22").value == fill) {
      document.getElementById("t22").value = "white";
    } else {
      document.getElementById("t22").value = fill;
    }
  } else if (clicked_id == "Tooth21") {
    if (document.getElementById("t21").value == fill) {
      document.getElementById("t21").value = "white";
    } else {
      document.getElementById("t21").value = fill;
    }
  } else if (clicked_id == "Tooth20") {
    if (document.getElementById("t20").value == fill) {
      document.getElementById("t20").value = "white";
    } else {
      document.getElementById("t20").value = fill;
    }
  } else if (clicked_id == "Tooth19") {
    if (document.getElementById("t19").value == fill) {
      document.getElementById("t19").value = "white";
    } else {
      document.getElementById("t19").value = fill;
    }
  } else if (clicked_id == "Tooth18") {
    if (document.getElementById("t18").value == fill) {
      document.getElementById("t18").value = "white";
    } else {
      document.getElementById("t18").value = fill;
    }
  } else if (clicked_id == "Tooth17") {
    if (document.getElementById("t17").value == fill) {
      document.getElementById("t17").value = "white";
    } else {
      document.getElementById("t17").value = fill;
    }
  } else if (clicked_id == "Tooth16") {
    if (document.getElementById("t16").value == fill) {
      document.getElementById("t16").value = "white";
    } else {
      document.getElementById("t16").value = fill;
    }
  } else if (clicked_id == "Tooth15") {
    if (document.getElementById("t15").value == fill) {
      document.getElementById("t15").value = "white";
    } else {
      document.getElementById("t15").value = fill;
    }
  } else if (clicked_id == "Tooth14") {
    if (document.getElementById("t14").value == fill) {
      document.getElementById("t14").value = "white";
    } else {
      document.getElementById("t14").value = fill;
    }
  } else if (clicked_id == "Tooth13") {
    if (document.getElementById("t13").value == fill) {
      document.getElementById("t13").value = "white";
    } else {
      document.getElementById("t13").value = fill;
    }
  } else if (clicked_id == "Tooth12") {
    if (document.getElementById("t12").value == fill) {
      document.getElementById("t12").value = "white";
    } else {
      document.getElementById("t12").value = fill;
    }
  } else if (clicked_id == "Tooth11") {
    if (document.getElementById("t11").value == fill) {
      document.getElementById("t11").value = "white";
    } else {
      document.getElementById("t11").value = fill;
    }
  } else if (clicked_id == "Tooth10") {
    if (document.getElementById("t10").value == fill) {
      document.getElementById("t10").value = "white";
    } else {
      document.getElementById("t10").value = fill;
    }
  } else if (clicked_id == "Tooth9") {
    if (document.getElementById("t9").value == fill) {
      document.getElementById("t9").value = "white";
    } else {
      document.getElementById("t9").value = fill;
    }
  } else if (clicked_id == "Tooth8") {
    if (document.getElementById("t8").value == fill) {
      document.getElementById("t8").value = "white";
    } else {
      document.getElementById("t8").value = fill;
    }
  } else if (clicked_id == "Tooth7") {
    if (document.getElementById("t7").value == fill) {
      document.getElementById("t7").value = "white";
    } else {
      document.getElementById("t7").value = fill;
    }
  } else if (clicked_id == "Tooth6") {
    if (document.getElementById("t6").value == fill) {
      document.getElementById("t6").value = "white";
    } else {
      document.getElementById("t6").value = fill;
    }
  } else if (clicked_id == "Tooth5") {
    if (document.getElementById("t6").value == fill) {
      document.getElementById("t6").value = "white";
    } else {
      document.getElementById("t6").value = fill;
    }
  } else if (clicked_id == "Tooth4") {
    if (document.getElementById("t4").value == fill) {
      document.getElementById("t4").value = "white";
    } else {
      document.getElementById("t4").value = fill;
    }
  } else if (clicked_id == "Tooth3") {
    if (document.getElementById("t3").value == fill) {
      document.getElementById("t3").value = "white";
    } else {
      document.getElementById("t3").value = fill;
    }
  } else if (clicked_id == "Tooth2") {
    if (document.getElementById("t2").value == fill) {
      document.getElementById("t2").value = "white";
    } else {
      document.getElementById("t2").value = fill;
    }
  } else if (clicked_id == "Tooth1") {
    if (document.getElementById("t1").value == fill) {
      document.getElementById("t1").value = "white";
    } else {
      document.getElementById("t1").value = fill;
    }
  }
};
let cause = (cause_id) => {
  //function cause(cause_id) {
  if (cause_id == 1) {
    color = "#00ba72";
  } else if (cause_id == 2) {
    color = "#004eff";
  } else if (cause_id == 3) {
    color = "#ff0000";
  } else if (cause_id == 4) {
    color = "#ff9000";
  } else if (cause_id == 5) {
    color = "#9c00ff";
  } else if (cause_id == 6) {
    color = "#8e0101";
  } else if (cause_id == 7) {
    color = "#006666";
  } else if (cause_id == 8) {
    color = "#00c0ff";
  }
};
$(document).ready(function () {
  $("#txtQuickFind").keyup(function () {
    $("#typeahead-menu").css("display", "none");
    var count = 0;
    var value = $('input[type="search"]').val();
    if (value == "" || value == null) {
      $(".menu-position").attr("aria-hidden", "false");
      $(".quickFindDiv").removeClass("open");
      $("#txtQuickFind").attr("aria-expanded", "false");
    } else {
      $(".quickFindDiv").addClass("open");
      $("#txtQuickFind").attr("aria-expanded", "true");

      $("li.site_map").each(function (element) {
        var id = $(this).attr("id");
        $("#" + id).addClass("hide-option");
        $("#" + id).removeClass("show-option");
        var name = $(this).attr("data-name");
        if (
          name.toLowerCase().match(value.toLowerCase()) == value.toLowerCase()
        ) {
          $("#typeahead-menu").css("display", "block");
          $("#" + id).removeClass("hide-option");
          $("#" + id).addClass("show-option");
          if ($("#" + id).hasClass("active")) {
            $("#" + id).removeClass("active");
          }

          if (count == 0) {
            $(".menu-position").attr("aria-hidden", "true");
            $("#" + id).addClass("active");
          }
          count++;
        }
      });
      // $("#" + id)
      //   .first()
      //   .addClass("active");
    }
  });
});
$(document).ready(function () {
  $(".site_map").hover(function () {
    $("li.site_map").each(function (element) {
      var id1 = $(this).attr("id");
      if ($("#" + id1).hasClass("active")) {
        $("#" + id1).removeClass("active");
      }
    });
    var id = $(this).attr("id");
    $("#" + id).addClass("active");
  });
  // $(".site_map").keyup(function () {
  //   $("li.site_map").each(function (element) {
  //     var id1 = $(this).attr("id");
  //     if ($("#" + id1).hasClass("active")) {
  //       $("#" + id1).removeClass("active");
  //     }
  //   });
  //   var id = $(this).attr("id");
  //   $("#" + id).addClass("active");
  // });

  // $("#txtQuickFind").keydown(function (e) {
  //   var key = e.keyCode;
  //   var id_up = "";
  //   $("li.show-option").each(function (element) {
  //     var id1 = $(this).attr("id");
  //     if ($("#" + id1).hasClass("active")) {
  //       id_up = id1;
  //     }
  //   });
  //   if (key == 40) {
  //     var id = $(".site_map").next(".show-option.").attr("id");
  //     if ($("#" + id).hasClass("active")) {
  //       $("#" + id).removeClass("active");
  //       id = $(".site_map").next(".show-option").attr("id");
  //       $("#" + id).addClass("active");
  //     } else {
  //       $("#" + id).addClass("active");
  //     }
  //     // $("#" + id_up).removeClass("active");
  //     // console.log(id);
  //     // $("#" + id).addClass("active");
  //   }
  // });
});
