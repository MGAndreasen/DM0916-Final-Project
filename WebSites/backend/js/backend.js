// Dom ready
$(document).ready(function () {

    $.ajax({
        url: "/backend/ajax.php",
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
