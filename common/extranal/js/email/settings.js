"use strict";
 $(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
    $('#emailCompany').select2();
    $(".emailSelectCompany").on("change", "#emailCompany", function () {
        "use strict";
        var value = $(this).val();
        $('#mailExtension').html(" ");
        if (value == 'gmail') {
            var extension = '@gmail.com';
        }
        if (value == 'yahoo') {
            var extension = '@yahoo.com';
        }
        if (value == 'outlook') {
            var extension = '@outlook.com';
        }
        if (value == 'hotmail') {
            var extension = '@hotmail.com';
        }
        if (value == 'zoho') {
            var extension = '@zohomail.com';
        }
        $('#mailExtension').html(extension);
        $('#emailAddress').val("");
    })
})
