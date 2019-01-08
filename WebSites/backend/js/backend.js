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
    console.log(jsonData);
    if (jsonData['errors']) {
        $.each(jsonData['errors'], function (key, value) {
            alert("Ctrl: " + value['ERRCTRL'] + "\n\rFunc: " + value['ERRFUNC'] + "\n\rMSG: " + value['ERRMSG']);
        });
    }
    else {
        $("#status").html("<p>STATUS: OK!</p>");
    }
    
}

function ajaxFejl() {
    $("#status").html("<p>STATUS: could not load ajax.php</p>");
}