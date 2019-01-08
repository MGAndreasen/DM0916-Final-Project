$(document).ready(function () {

    $(document).ajaxError(function (event, xhr, settings) {
            $("#status").text("The Ajax Error was: " + xhr.responseText);
    });

    $(document).ajaxSuccess(function (event, xhr, settings) {
            $("#status").text("Triggered ajaxSuccess handler");
    });

    $.ajax({
        url: "/backend/ajax.php",
        data: {
            test: 12
        }
    });

});

// Functions
function testOk(result) {
    $("#status").html("<p>STATUS: </p><strong>" + result + "</strong>");
}

function fejl() {
    $("#status").html("<p>STATUS: </p><strong>could not load ajax.php</strong>");
}