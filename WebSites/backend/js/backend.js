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
            // do page stuff
            handlePagechange();
        }
    });

    // Remove Splashscreen
    $("#loading").toggle();
});

//-- Page functions
function pageHome() {
    $("#home").html("<p>Home</p>");
}

function pageAbout() {
    $("#about").html("<p>about</p>");
}

function pageTests() {
    $("#tests").html("<p>tests</p>");
}

function pageProjects() {
    $("#projects").html("<p>projects</p>");

    // Test load data.
    var test = [1];
    var data = myPost('project', 'getProjects', test);
    $("#projects").append(data);
}

function pageTestDataSets() {
    $("#testdatasets").html("<p>data</p>");
}


//-- SITE Funcs
function handlePagechange() {
    var pageName = $('#pages .active').attr('id');
    //var pageName = $(page).attr('id');

    switch (pageName) {
        case 'home':
            pageHome();
            break;
        case 'about':
            pageAbout();
            break;
        case 'tests':
            pageTests();
            break;
        case 'projects':
            pageProjects();
            break;
        case 'testdatasets':
            pageTestDataSets();
            break;
        default:
            $("#status").html("<p>STATUS: FEJL! pageHandler (" + pageName + ")</p>");
    }
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
        data: { resp: toSend },
        done: function (result) {
            var rawData = result.responseText;
            alert(rawData);
            //var jsonData = JSON.parse(rawData);
            //return jsonData;
        }
    });
}

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