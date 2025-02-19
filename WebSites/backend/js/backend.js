var customer = 1;  // Cheat we have no login system
var hirachySortables;
var projectId;

$(document).ready(function () {
    // Ajax error eventhandler
    $(document).ajaxError(function (event, xhr, settings) {
        notify("SPA", "Ajax Request:</br>Failed connect to REST service ajax.php");
    });

    // Ajax eventhandler gemmes lidt i nu
    /*    
        $(document).ajaxSuccess(function (event, xhr, settings) {
            ajaxOk(xhr);
        });
    */

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
    if ($('#pages > .active').length) {
        var pageName = $('#pages > .active').attr('id');
        if ($('#' + pageName).length) {
            window['page_' + pageName]();
        }
        else {
            notify("SPA", "PageHandler</br>Section (" + pageName + ") not found!");
        }
    }
    else {
        notify("SPA", "PageHandler</br>No Section with .active class found!");
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
            if (result['errors']) {
                $.each(result['errors'], function (key, value) {
                    notify(value['ERRCTRL'], "Func: " + value['ERRFUNC'] + "</br>MSG: " + value['ERRMSG']);
                });
            }
            toReturn = result;
        }
    });
    return toReturn;
}

function notify(title, msg) {
    var notisElement = "<div class='notify'><div>" + title + "</div><div>" + msg + "</div></div>";
    $(notisElement).prependTo("#status").delay(10000).fadeOut(2000).delay(3000).queue(function () { $(this).remove(); });
}