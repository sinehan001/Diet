"use strict";
$(document).ready(function () {
  "use strict";
  $(".pos_client").hide();
  $(document.body).on("change", "#pos_select", function () {
    "use strict";
    var v = $("select.pos_select option:selected").val();
    if (v === "add_new") {
      $(".pos_client").show();
    } else {
      $(".pos_client").hide();
    }
  });
  $(".pos_client1").hide();
  $(document.body).on("change", "#pos_select1", function () {
    "use strict";
    var v = $("select.pos_select1 option:selected").val();
    if (v === "add_new") {
      $(".pos_client1").show();
    } else {
      $(".pos_client1").hide();
    }
  });
});

$(document).ready(function () {
  "use strict";
  $("#pos_select").select2({
    placeholder: select_patient,
    allowClear: true,
    ajax: {
      url: "patient/getPatientinfoWithAddNewOption",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $("#pos_select1").select2({
    placeholder: select_patient,
    allowClear: true,
    ajax: {
      url: "patient/getPatientinfoWithAddNewOption",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });

  $("#adoctors").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorInfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
  $("#adoctors1").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorInfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        "use strict";
        return {
          searchTerm: params.term, // search term
        };
      },
      processResults: function (response) {
        "use strict";
        return {
          results: response,
        };
      },
      cache: true,
    },
  });
});
$(document).ready(function () {
  $("#visit_description").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        $("#visit_charges").val(response.response.visit_charges).end();
        var discount = $("#discount").val();
        $("#grand_total")
          .val(parseFloat(response.response.visit_charges - discount))
          .end();
      },
    });
  });
  $("#discount").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges").val();
    $("#grand_total")
      .val(parseFloat(price - discount))
      .end();
  });
});
$(document).ready(function () {
  $("#visit_description1").change(function () {
    // Get the record's ID via attribute
    var id = $(this).val();

    $("#visit_charges1").val(" ");
    // $('#default').trigger("reset");

    $.ajax({
      url: "doctor/getDoctorVisitCharges?id=" + id,
      method: "GET",
      data: "",
      dataType: "json",
    }).success(function (response) {
      $("#visit_charges1").val(response.response.visit_charges).end();
      var discount = $("#discount1").val();
      $("#grand_total1")
        .val(parseFloat(response.response.visit_charges - discount))
        .end();
    });
  });
  $("#discount1").keyup(function () {
    // Get the record's ID via attribute
    var discount = $(this).val();
    var price = $("#visit_charges1").val();
    $("#grand_total1")
      .val(parseFloat(price - discount))
      .end();
  });
});
function cardValidation() {
  "use strict";
  var valid = true;
  var cardNumber = $("#card").val();
  var expire = $("#expire").val();
  var cvc = $("#cvv").val();

  $("#error-message").html("").hide();

  if (cardNumber.trim() == "") {
    valid = false;
  }

  if (expire.trim() == "") {
    valid = false;
  }
  if (cvc.trim() == "") {
    valid = false;
  }

  if (valid == false) {
    $("#error-message").html("All Fields are required").show();
  }

  return valid;
}
//set your publishable key
Stripe.setPublishableKey(publish);

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
  "use strict";
  if (response.error) {
    $("#submit-btn").show();
    $("#loader").css("display", "none");

    $("#error-message").html(response.error.message).show();
    $("#submit-btn").attr("disabled", false);
    $("#error-message").html(response.error.message).show();
  } else {
    var token = response["id"];
    if (token != null) {
      $("#token").val(token);
      $("#addAppointmentForm").append(
        "<input type='hidden' name='token' value='" + token + "' />"
      );
      $("#addAppointmentForm").submit();
    } else {
      alert("Please Check Your Card details");
      $("#submit-btn").attr("disabled", false);
    }
  }
}

function stripePay(e) {
  "use strict";
  e.preventDefault();
  var valid = cardValidation();

  if (valid == true) {
    $("#submit-btn").attr("disabled", true);
    $("#loader").css("display", "inline-block");
    var expire = $("#expire").val();
    var arr = expire.split("/");
    Stripe.createToken(
      {
        number: $("#card").val(),
        cvc: $("#cvv").val(),
        exp_month: arr[0],
        exp_year: arr[1],
      },
      stripeResponseHandler
    );

    return false;
  }
}
function cardValidation1() {
  var valid = true;
  var cardNumber = $("#card1").val();
  var expire = $("#expire1").val();
  var cvc = $("#cvv1").val();

  $("#error-message").html("").hide();

  if (cardNumber.trim() == "") {
    valid = false;
  }

  if (expire.trim() == "") {
    valid = false;
  }
  if (cvc.trim() == "") {
    valid = false;
  }

  if (valid == false) {
    $("#error-message").html("All Fields are required").show();
  }

  return valid;
}
//set your publishable key
Stripe.setPublishableKey(publish);

//callback to handle the response from stripe
function stripeResponseHandler1(status, response) {
  if (response.error) {
    //enable the submit button
    $("#submit-btn1").show();
    $("#loader").css("display", "none");
    //display the errors on the form
    $("#error-message").html(response.error.message).show();
  } else {
    //get token id
    var token = response["id"];
    //insert the token into the form
    $("#token").val(token);
    $("#editAppointmentForm").append(
      "<input type='hidden' name='token' value='" + token + "' />"
    );
    //submit form to the server
    $("#editAppointmentForm").submit();
  }
}

function stripePay1(e) {
  e.preventDefault();
  var valid = cardValidation1();

  if (valid == true) {
    $("#submit-btn1").attr("disabled", true);
    $("#loader").css("display", "inline-block");
    var expire = $("#expire1").val();
    var arr = expire.split("/");
    Stripe.createToken(
      {
        number: $("#card1").val(),
        cvc: $("#cvv1").val(),
        exp_month: arr[0],
        exp_year: arr[1],
      },
      stripeResponseHandler1
    );

    //submit from callback
    return false;
  }
}

if (payment_gateway == "2Checkout") {
  var successCallback = function (data) {
    "use strict";
    var myForm = document.getElementById("addAppointmentForm");

    $("#addAppointmentForm").append(
      "<input type='hidden' name='token' value='" +
        data.response.token.token +
        "' />"
    );

    myForm.submit();
  };
  // Called when token creation fails.
  var errorCallback = function (data) {
    "use strict";
    if (data.errorCode === 200) {
      tokenRequest();
    } else {
      alert(data.errorMsg);
    }
  };
  var tokenRequest = function () {
    "use strict";
    var expire = $("#expire").val();
    var expiresep = expire.split("/");
    var dateformat = moment(expiresep[1], "YY");
    var year = dateformat.format("YYYY");
    var args = {
      sellerId: merchant,
      publishableKey: publishable,
      ccNo: $("#card").val(),
      cvv: $("#cvv").val(),
      expMonth: expiresep[0],
      expYear: year,
    };
    console.log(
      $("#card").val() + "-" + $("#cvv").val() + expiresep[0] + year + merchant
    );

    TCO.requestToken(successCallback, errorCallback, args);
  };

  function twoCheckoutPay(e) {
    "use strict";
    e.preventDefault();

    TCO.loadPubKey("sandbox", function () {
      // for sandbox environment
      publishableKey = publishable; //your public key
      tokenRequest();
    });

    return false;
  }

  var successCallback1 = function (data) {
    "use strict";
    var myForm = document.getElementById("editAppointmentForm");

    $("#editAppointmentForm").append(
      "<input type='hidden' name='token' value='" +
        data.response.token.token +
        "' />"
    );

    myForm.submit();
  };
  // Called when token creation fails.
  var errorCallback1 = function (data) {
    "use strict";
    if (data.errorCode === 200) {
      tokenRequest1();
    } else {
      alert(data.errorMsg);
    }
  };
  var tokenRequest1 = function () {
    "use strict";
    var expire = $("#expire1").val();
    var expiresep = expire.split("/");
    var dateformat = moment(expiresep[1], "YY");
    var year = dateformat.format("YYYY");
    var args = {
      sellerId: merchant,
      publishableKey: publishable,
      ccNo: $("#card1").val(),
      cvv: $("#cvv1").val(),
      expMonth: expiresep[0],
      expYear: year,
    };
    console.log(
      $("#card1").val() +
        "-" +
        $("#cvv1").val() +
        expiresep[0] +
        year +
        merchant
    );

    TCO.requestToken(successCallback, errorCallback, args);
  };

  function twoCheckoutPay1(e) {
    "use strict";
    e.preventDefault();

    TCO.loadPubKey("sandbox", function () {
      // for sandbox environment
      publishableKey = publishable; //your public key
      tokenRequest1();
    });

    return false;
  }
}
