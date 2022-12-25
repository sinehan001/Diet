"use strict";
var myEditor;

$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

});
var myEditor1;
var myEditor2;
var myEditor3;
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor1 = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor2 = editor;
            })
            .catch(error => {
                console.error(error);
            });
    ClassicEditor
            .create(document.querySelector('#editor3'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '200px';
                myEditor3 = editor;
            })
            .catch(error => {
                console.error(error);
            });


});
$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        var iid = $(this).attr('data-id');
        $('#myModal2').modal('show');
        $.ajax({
            url: 'patient/editMedicalHistoryByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end();
                $('#medical_historyEditForm').find('[name="date"]').val(response.medical_history.date).end();
                myEditor.setData(response.medical_history.description);
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editPrescription", function () {

        var iid = $(this).attr('data-id');
        $('#myModal5').modal('show');
        $.ajax({
            url: 'prescription/editPrescriptionByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#prescriptionEditForm').find('[name="id"]').val(response.prescription.id).end();
                $('#prescriptionEditForm').find('[name="patient"]').val(response.prescription.patient).end();
                $('#prescriptionEditForm').find('[name="doctor"]').val(response.prescription.doctor).end();

                myEditor1.setData(response.prescription.symptom);
                myEditor2.setData(response.prescription.medicine);
                myEditor3.setData(response.prescription.note);
            }
        })
    });
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

