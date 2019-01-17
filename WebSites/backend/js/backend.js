$(document).ready(function () {
    // Ajax error eventhandler
    $(document).ajaxError(function (event, xhr, settings) {
        notify("Ajax", "Request: Could not load ajax.php");
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
    if ($('#pages .active').length) {
        var pageName = $('#pages .active').attr('id');
        if ($('#' + pageName).length) {
            window['page_' + pageName]();
        }
        else {
            notify("PageHandler", "Section (" + pageName + ") not found!");
        }
    }
    else {
        notify("PageHandler", "No Section with .active class found!");
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
            toReturn = result;
        }
    });
    return toReturn;
}

function ajaxOk(result) {
    var rawData = result.responseText;
    var jsonData = JSON.parse(rawData);
    if (jsonData['errors']) {
        $.each(jsonData['errors'], function (key, value) {
            notify("Ajax", "Ctrl: " + value['ERRCTRL'] + "\nFunc: " + value['ERRFUNC'] + "\nMSG: " + value['ERRMSG']);
        });
    }
    else {
        notify("AjaxOK", "OK!");
    }
}

function notify(title, msg) {
    var notisElement = "<div class='notify'><div>" + title + "</div><div>" + msg + "</div></div>";
    $(notisElement).prependTo("#status").delay(10000).fadeOut(2000).delay(3000).queue(function () { $(this).remove(); });
}