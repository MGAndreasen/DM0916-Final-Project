// Dom ready
$(document).ready(function () {

    $.ajax({
        url: "/backend/ajaxs.php",
        data: {
            test: 12
        },
        success: function (result) {
            $("#status").html("<strong>" + result + "</strong>");
        },
        error: function () {
            $("#status").html("<strong>could not load ajax.php</strong>");
        }
    });

});
