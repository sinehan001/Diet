 "use strict";
$(document).ready(function () {
    "use strict";
    $(".button_option").on("click", "#backup_files", function (e) {
        "use strict";

        e.preventDefault();
        $('#wModalLabel').text(backup_modal_heading);
        $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
        window.location.href = href_file;
    });
    $(".button_option").on("click", ".restore_backup", function (e) {
        "use strict";

        e.preventDefault();
        var href = $(this).attr('href');
        var r = confirm(restore_confirm);
        if (r === true) {
            $('#wModalLabel').text(restore_modal_heading);
            $('#wModal').modal({backdrop: 'static', keyboard: true}).appendTo('body').modal('show');
            window.location.href = href;
        } else {
            return false;
        }
    });
    $(".button_option").on("click", ".restore_db", function (e) {
        "use strict";

        e.preventDefault();
        var href = $(this).attr('href');
        var r = confirm(restore_confirm);
        if (r === true) {
            window.location.href = href;
        } else {
            return false;
        }
    });
    $(".button_option").on("click", ".delete_file", function (e) {
        "use strict";

        e.preventDefault();
        var href = $(this).attr('href');
        var r = confirm(delete_confirm);
        if (r === true) {
            window.location.href = href;
        } else {
            return false;
        }
    });
});
