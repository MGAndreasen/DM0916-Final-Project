$(document).ready(function () {

    $(document).ajaxError(function (event, xhr, settings) {
        ajaxFejl();
    });

    $(document).ajaxSuccess(function (event, xhr, settings) {
        ajaxOk(xhr);
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
    var rawData = result.responseText;
    var jsonData = JSON.parse(rawData);
    console.log(jsonData[0][0]['ERRMSG']);
    $("#status").html("<p>STATUS: OK!</p>");
}

function ajaxFejl() {
    $("#status").html("<p>STATUS: could not load ajax.php</p>");
}