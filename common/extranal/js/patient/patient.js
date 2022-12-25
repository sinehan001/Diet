"use strict";
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#editPatientForm').find('[name="id"]').val(response.patient.id).end();
                $('#editPatientForm').find('[name="name"]').val(response.patient.name).end();
                $('#editPatientForm').find('[name="password"]').val(response.patient.password).end();
                $('#editPatientForm').find('[name="email"]').val(response.patient.email).end();
                $('#editPatientForm').find('[name="address"]').val(response.patient.address).end();
                $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end();
                $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end();
                $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end();
                $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end();
                $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end();

                if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                    $("#img").attr("src", response.patient.img_url);
                }

                if (response.doctor !== null) {
                    var option1 = new Option(response.doctor.name + '-' + response.doctor.id, response.doctor.id, true, true);
                } else {
                    var option1 = new Option(' ' + '-' + '', '', true, true);
                }
                $('#editPatientForm').find('[name="doctor"]').append(option1).trigger('change');


                $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');

                $('#myModal2').modal('show');
            }
        })
    });



    $(".table").on("click", ".inffo", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('.nodiet').remove();
        $('.tabcontent').remove();
        $('.patientIdClass').html("").end();
        $('.nameClass').html("").end();
        $('.emailClass').html("").end();
        $('.addressClass').html("").end();
        $('.genderClass').html("").end();
        $('.birthdateClass').html("").end();
        $('.bloodgroupClass').html("").end();
        $('.patientidClass').html("").end();
        $('.doctorClass').html("").end();
        $('.ageClass').html("").end();
        $('.phoneClass').html("").end(); 
        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

                $('.patientIdClass').append(response.patient.id).end();
                $('.nameClass').append(response.patient.name).end();
                $('.emailClass').append(response.patient.email).end();
                $('.addressClass').append(response.patient.address).end();
                $('.phoneClass').append(response.patient.phone).end();
                $('.genderClass').append(response.patient.sex).end();
                $('.birthdateClass').append(response.patient.birthdate).end();
                $('.ageClass').append(response.age).end();
                $('.bloodgroupClass').append(response.patient.bloodgroup).end();
                $('.patientidClass').append(response.patient.patient_id).end();
                $('.Infoviewplan').attr("data-id",response.patient.id);

                if (response.doctor !== null) {
                    $('.doctorClass').append(response.doctor.name).end();
                } else {
                    $('.doctorClass').append('').end();
                }


                $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");

                if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                    $("#img1").attr("src", response.patient.img_url);
                }


                $('#infoModal').modal('show');
            }
        })
    });

    $(".Infoviewplan").on("click", function() {
        var iid = $(this).attr('data-id');
        $('.nodiet').remove();
        $.ajax({
            url: 'patient/getPatientDietByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                if(response.diet != null) {
                    $('.DietChart').after(response.diet.diet).end();
                    $('.tabcontent').addClass("col-md-12 col-sm-12 col-xs-12");
                }
                else {
                    $('.DietChart').after("<h3 class='nodiet'>No Diet Available</h3>");
                }
            }
        });
    });

    $(".table").on("click", ".AddDiet", function () {
        "use strict";
        var iid = $(this).attr('data-id');

        $('.patientIdClass').html("").end();
        $('.nameClass').html("").end();
        $('.emailClass').html("").end();
        $('.addressClass').html("").end();
        $('.genderClass').html("").end();
        $('.birthdateClass').html("").end();
        $('.bloodgroupClass').html("").end();
        $('.patientidClass').html("").end();
        $('.doctorClass').html("").end();
        $('.ageClass').html("").end();
        $('.phoneClass').html("").end(); 
        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";

                $('.patientIdClass').append(response.patient.id).end();
                $('.nameClass').append(response.patient.name).end();
                $('.DPatient').val(response.patient.name);
                $('.DPatient-id').val(response.patient.id);
                $('.emailClass').append(response.patient.email).end();
                $('.addressClass').append(response.patient.address).end();
                $('.phoneClass').append(response.patient.phone).end();
                $('.genderClass').append(response.patient.sex).end();
                $('.birthdateClass').append(response.patient.birthdate).end();
                $('.ageClass').append(response.age).end();
                $('.bloodgroupClass').append(response.patient.bloodgroup).end();
                $('.patientidClass').append(response.patient.patient_id).end();

                if (response.doctor !== null) {
                    $('.doctorClass').append(response.doctor.name).end();
                } else {
                    $('.doctorClass').append('').end();
                }


                $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");

                if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                    $("#img1").attr("src", response.patient.img_url);
                }


                $('#AddDietModal').modal('show');
            }
        })
    });

    $(".dietplan").on("change", function () {
        if($(".dietplan").val() == "GEN")
        {
            $(".appendChart").html("");
            var url = 'common/data/general.txt';
            fetch(url)
            .then(function(response) {
                response.text().then(function(text) {
                    $(".appendChart").append(text);
                    done(text);
                });
            });
        }
        if($(".dietplan").val() == "RED")
        {
            $(".appendChart").html("");
            var url = 'common/data/rd.txt';
            fetch(url)
            .then(function(response) {
                response.text().then(function(text) {
                    $(".appendChart").append(text);
                    done(text);
                });
            });
        }
        if($(".dietplan").val() == "CAD")
        {
            $(".appendChart").html("");
            var url = 'common/data/cad.txt';
            fetch(url)
            .then(function(response) {
                response.text().then(function(text) {
                    $(".appendChart").append(text);
                    done(text);
                });
            });
        }
        if($(".dietplan").val() == "REN")
        {
            $(".appendChart").html("");
            var url = 'common/data/renal.txt';
            fetch(url)
            .then(function(response) {
                response.text().then(function(text) {
                    $(".appendChart").append(text);
                    done(text);
                });
            });
        }
        function done(diet_data) {
            $(".diet-content").val(diet_data);
        };
    }) 

    $(".editplan").on('click', function() {
        if($(".dietplan").val() == null) {
            alert("Select Diet Plan");
        }
        else {
            $(".editplan").after('&nbsp;&nbsp;<a type="button" class="btn detailsbutton updateDiet" title="Update Diet Plans">Update Diet</a>');
            if($(".dietplan").val() == "GEN")
            {
                $(".appendChart").html("");
                var url = 'common/data/general.txt';
                fetch(url)
                .then(function(response) {
                    response.text().then(function(text) {
                        $(".appendChart").append(text);
                        done(text);
                    });
                });
            }
            if($(".dietplan").val() == "RED")
            {
                $(".appendChart").html("");
                var url = 'common/data/rd.txt';
                fetch(url)
                .then(function(response) {
                    response.text().then(function(text) {
                        $(".appendChart").append(text);
                        done(text);
                    });
                });
            }
            if($(".dietplan").val() == "CAD")
            {
                $(".appendChart").html("");
                var url = 'common/data/cad.txt';
                fetch(url)
                .then(function(response) {
                    response.text().then(function(text) {
                        $(".appendChart").append(text);
                        done(text);
                    });
                });
            }
            if($(".dietplan").val() == "REN")
            {
                $(".appendChart").html("");
                var url = 'common/data/renal.txt';
                fetch(url)
                .then(function(response) {
                    response.text().then(function(text) {
                        $(".appendChart").append(text);
                        done(text);
                    });
                });
            }
            function done(diet_data) {
                $(".diet-content").val(diet_data);
                $("td").prop("contenteditable",true);
                $("th").prop("contenteditable",true);
                $("td").prop("id","changeDiet");
                $("th").prop("id","changeDiet");
                $(".updateDiet").on("click", function() {
                    var diet_data = $(".appendChart").html();
                    $(".diet-content").val(diet_data);
                })
            };
        }
    });

    $("td[id^='changeDiet']").on("change", function() {
        console.log("updating...");
        var diet_data = $(".appendChart").html();
        $(".diet-content").val(diet_data);
    });

    $(".viewplan").on("click", function() {
        $("td").prop("contenteditable",false);
        $("th").prop("contenteditable",false);
        $(".appendChart").html("");
        var url = 'common/data/dietplans.txt';
        fetch(url)
          .then(function(response) {
            response.text().then(function(text) {
                $(".appendChart").append(text);
            });
          });
    })

    $(".close").on("click", function() {
        $("td").prop("contenteditable",false);
        $("th").prop("contenteditable",false);
    })

    $(".submitplan").on('click', function(event) {
        if($(".dietplan").val() == null) {
            alert("Select Diet Plan");
            event.preventDefault();
        }
        else {
            let data;
            if($(".appendChart").is(':empty')) {
                console.log("Empty");
            }
            else {
                data = $(".appendChart").html();
            }
        }
    });
});

$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,
        //   dom: 'lfrBtip',
        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            url: "patient/getPatient",
            type: 'POST',
        },
        scroller: {
            loadingIndicator: true
        },
        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            {extend: 'copyHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'excelHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'csvHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'pdfHtml5', exportOptions: {columns: [0, 1, 2], }},
            {extend: 'print', exportOptions: {columns: [0, 1, 2], }},
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 100,
        "order": [[0, "desc"]],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        }
    });
    table.buttons().container().appendTo('.custom_buttons');
});


$(document).ready(function () {
    "use strict";
    $("#doctorchoose").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorinfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });
    $("#doctorchoose1").select2({
        placeholder: select_doctor,
        allowClear: true,
        ajax: {
            url: 'doctor/getDoctorInfo',
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }

    });



});


$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});


/* Diet Plans JS */

function openPage(pageName,element) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  element.style.backgroundColor = '#39B27C';
}

function openPage1(pageName,element) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent1");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink1");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  element.style.backgroundColor = '#39B27C';
}

function openPage2(pageName,element) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent2");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink2");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  element.style.backgroundColor = '#39B27C';
}

function openPage3(pageName,element) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent3");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink3");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  element.style.backgroundColor = '#39B27C';
}

function openPage4(pageName,element) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent4");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink4");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  element.style.backgroundColor = '#39B27C';
}