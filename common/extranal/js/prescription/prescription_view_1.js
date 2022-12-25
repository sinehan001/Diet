 "use strict";
$(".download_button").on("click", "#download", function () {
    "use strict";
    var pdf = new jsPDF('p', 'pt', 'letter');
    pdf.addHTML($('#prescription'), function () {
        "use strict";
        pdf.save('prescription_id_' + id_pres + '.pdf');
    });
});

