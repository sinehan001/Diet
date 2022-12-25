"use strict";
    $(document).ready(function () {
        "use strict";
        $(".flashmessage").delay(3000).fadeOut(100);
    });


    $(document).ready(function () {
        "use strict";
        var table = $('#editable-sample').DataTable({
            responsive: true,
            

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "patient/getDocuments",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        
             buttons: [
                {extend: 'copyHtml5', exportOptions: {columns: [1, 2, 3], }},
                {extend: 'excelHtml5', exportOptions: {columns: [1, 2, 3], }},
                {extend: 'csvHtml5', exportOptions: {columns: [1, 2, 3], }},
                {extend: 'pdfHtml5', exportOptions: {columns: [1, 2, 3], }},
                {extend: 'print', exportOptions: {columns: [1, 2, 3], }},
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
                searchPlaceholder: "Search...",
                  "url": "common/assets/DataTables/languages/" + language + ".json"
            },

        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });


    $(document).ready(function () {
        "use strict";
        $("#patientchoose").select2({
            placeholder: select_patient,
            allowClear: true,
            ajax: {
                url: 'patient/getPatientinfo',
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
