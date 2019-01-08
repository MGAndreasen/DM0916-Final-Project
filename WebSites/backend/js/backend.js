$(document).ready(function () {

    $(document).ajaxError(function (event, xhr, settings) {
        ajaxFejl();
    });

    $(document).ajaxSuccess(function (event, xhr, settings) {
        ajaxOk(xhr.responseText);
    });

    $.ajax({
        url: "/backend/ajax.php",
        data: {
            test: 12
        }
    });

});

// Functions
function ajaxOk(result) {
    console.log(result);
    $("#status").html("<p>STATUS: </p><strong>OK!</strong>");
}

function ajaxFejl() {
    $("#status").html("<p>STATUS: </p><strong>could not load ajax.php</strong>");
}