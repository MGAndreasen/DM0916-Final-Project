$(document).ready(function () {

    $(document).ajaxError(function (event, xhr, settings) {
        ajaxFejl();
    });

    $(document).ajaxSuccess(function (event, xhr, settings) {
        ajaxOk(xhr);
    });

    //$.ajax({
    //    url: "/backend/ajax.php",
    //    dataType: "json",
    //    data: {
    //        ctrl: "project",
    //        func: "getProjects"
    //    }
    //});
    var test = [1,2,"tesgf"];
    myPost('project', 'getProjects', test);
});

function myPost(ctrl, func, parms) {
    var mydata = new Array({ "ctrl": ctrl, "func": func, "parms": parms });
    var toSend = JSON.stringify(mydata);
    console.log("SENDES:\n" + toSend);
    $.ajax({
        type: "POST",
        url: "/backend/ajax.php",
        dataType: 'json',
        encode: true,
        data: { resp: toSend }
    });
}

// Functions
function ajaxOk(result) {
    var rawData = result.responseText;
    console.log("MODTAGET:\n" + rawData);
    var jsonData = JSON.parse(rawData);
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