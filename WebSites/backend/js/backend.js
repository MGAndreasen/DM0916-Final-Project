// For keeping track
var notifyNum = 0;

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

    // Check if page is loaded with a hash already in place
    if (location.hash && location.hash.length) {
        // and if so, decode that part and remove hashtag from it
        var hash = decodeURIComponent(location.hash.replace('#', ''));

        // if there is still something in it
        if (hash.length) {
            // lets try and find an menuelement with the given hash in the href attribute, and perform an automatic click on it, to load the correct section :-D
            $("nav ul li a[href='#"+hash+"']").get(0).click();
        }
    }       
});

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
        case 'apitest':
            pageApiTest();
            break;
        default:
            notify("AjaxOK", "FEJL! pageHandler (" + pageName + ")");
            //$("#status").html("<p>STATUS: FEJL! pageHandler (" + pageName + ")</p>");
    }
}

function myPost(ctrl, func, parms) {
    var mydata = new Array({ "ctrl": ctrl, "func": func, "parms": parms });
    var toSend = JSON.stringify(mydata);
    console.log("SENDES:\n" + toSend);
    var toReturn = [];
    var thecall = $.ajax({
        type: "POST",
        url: "/backend/ajax.php",
        dataType: 'json',
        encode: true,
        async: false,
        data: { resp: toSend },
        success: function (result) {
            console.log("MODTAGET:\n" + JSON.stringify(result));
            toReturn = result[0];
        }
    });
    return toReturn;
}

function ajaxOk(result) {
    var rawData = result.responseText;
    //console.log("MODTAGET:\n" + rawData);
    var jsonData = JSON.parse(rawData);
    if (jsonData['errors']) {
        $.each(jsonData['errors'], function (key, value) {
            alert("Ctrl: " + value['ERRCTRL'] + "\nFunc: " + value['ERRFUNC'] + "\nMSG: " + value['ERRMSG']);
        });
    }
    else {
        //$("#status").html("<p>STATUS: OK!</p>");
        notify("AjaxOK", "OK!");
    }
}

function ajaxFejl() {
    notify("Ajax", "Could not load ajax.php");
    //alert("Could not load ajax.php");
}

function notify(title, msg) {
    notifyNum++;
    var id = "#notify-"+notifyNum;
    var data = "<div class='notify' id='"+id+"'><div>"+title+"</div>"+msg+"</div>";
    //setTimeout(function () {
        $("#status").append(data);
        var notify = $(id);
        notify.hide("5000").remove();
    //}, 3000);
}