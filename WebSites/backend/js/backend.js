$(document).ready(function () {

    // Ajax error eventhandler
    $(document).ajaxError(function (event, xhr, settings) {
        ajaxFejl();
    });

    // Ajax eventhandler
    $(document).ajaxSuccess(function (event, xhr, settings) {
        ajaxOk(xhr);
    });

    // Mainmenu
    $('nav ul li a').click(function () {
        if (!$(this).hasClass('active')) {
            var section = $(this).attr('href');

            $('nav ul li a').removeClass('active');

            $(this).addClass('active');

            $(section).addClass('active');
            $('#pages .page').not(section).removeClass('active');

            handlePagechange(section);
        }
    });

    // Remove Splashscreen
    $("#loading").toggle();

    // Test load data.
    var test = [1];
    myPost('project', 'getProjects', test);
});


//-- Funcs
function handlePagechange(thepage) {
    var lePage = $(thepage);

    lePage.html("stuff: " + lePage);
}



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