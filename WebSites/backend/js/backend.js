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
            ctrl: 'project',
            func: 'stuf'
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
            alert("Ctrl: " + value['ERRCTRL'] + "\nFunc: " + value['ERRFUNC'] + "\nMSG: " + value['ERRMSG']);
        });
    }
    else {
        $("#status").html("<p>STATUS: OK!</p>");
    }
    
}

function ajaxFejl() {
    alert("Could not load ajax.php");
}