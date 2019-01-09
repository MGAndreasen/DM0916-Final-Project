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
    var test = new Array(1, 2, 3, 4);
    myPost('projects', 'getProject', test);
});

function myPost(ctrl, func, parms) {
    var mydata = new Array();
    mydata['ctrl'] = ctrl;
    mydata['func'] = func;
    mydata['parms'] = parms;
    console.log(mydata);
    var toSend = JSON.stringify({ resp: mydata });
    alert("SENDES:\n" + toSend);
    $.ajax({
        type: "POST",
        url: "/backend/ajax.php",
        dataType: 'json',
        encode: true,
        data: toSend
    });
}

// Functions
function ajaxOk(result) {
    var rawData = result.responseText;
    alert(rawData);
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