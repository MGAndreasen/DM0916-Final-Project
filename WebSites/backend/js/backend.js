$(document).ready(function () {

    $(document).ajaxError(function (event, xhr, settings) {
        ajaxFejl();
    });

    $(document).ajaxSuccess(function (event, xhr, settings) {
        ajaxOk(xhr.responseText);
    });

    $.ajax({
        url: "/backend/ajax.php",
        dataType: "json",
        data: {
            test: 12
        }
    });

});

// Functions
function ajaxOk(result) {
    var json = JSON.parse(result);
    console.log(json["Data"]);
    $("#status").html("<p>STATUS: OK!</p>");
}

function ajaxFejl() {
    $("#status").html("<p>STATUS: could not load ajax.php</p>");
}