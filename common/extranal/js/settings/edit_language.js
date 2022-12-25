 "use strict";
$(document).ready(function () {
     "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

$(document).ready(function () {
    "use strict";
    $("#myForm").on("click", "#submit", function () {
        "use strict";
        var indexes = $("input[name='index[]']")
                .map(function () {
                    return $(this).val();
                }).get();
        var values = $("input[name='value[]']")
                .map(function () {
                    return $(this).val();
                }).get();
        $("input[name='value[]']").attr("disabled");
        $("input[name='index[]']").attr("disabled");
        var indexupdate = "";
        var valueupdate = "";
        $.each(indexes, function (index, value) {
            indexupdate = indexupdate + "#**##***" + value;
        });
        $.each(values, function (index, value) {
            valueupdate = valueupdate + "*##**###" + value;
        });
        $('#myForm').find('[name="valueupdate"]').val(valueupdate).end();
        $('#myForm').find('[name="indexupdate"]').val(indexupdate).end();
        $('#myForm').submit();

    });
});
