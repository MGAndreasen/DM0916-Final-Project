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
    var section = $("#projects");

    section.html("<p>projects</p>");

    // Test load data.
    var customerid = [1];
    var result = myPost('project', 'getProjects', customerid);

    $.each(result['projects'], function (key, value) {
        var p = "<div id='project-" + value['id'] + "'>" + value['name'] + "</div>";
        section.append(p);

        //bind evt. eventhandlers her, eller globalt?
    });

    section.append(JSON.stringify(result));
}

function pageTestDataSets() {
    $("#testdatasets").html("<p>data</p>");
}

function pageApiTest() {
    // Get section ref.
    var section = $("#apitest");
    var lePage = "<form>"
        + "<label>Ctrl: <input id='apitestCtrl' type='text' value='project'/></label></br>"
        + "<label>Func: <input id='apitestFunc' type='text' value='getProjects'/></label></br>"
        + "<label>Parms:<textarea></textarea></label></br>"
        + "<input class='runquery' type='button' value='Run Query'/>"
        + "<input class='example' type='button' value='Example'/>"
        + "</form></br>"
        + "<div id='apitestResult'></div>";

    section.html(lePage);

    section.on('click', '.example', function () {
        $("#apitestCtrl").val("project");
        $("#apitestFunc").val("getProjects");
        $("#apitest form textarea").val("[1]");
    });

    section.on('click', '.runquery', function () {
        // Test Query
        var ctrl = $("#apitestCtrl").val();
        var func = $("#apitestFunc").val();
        var parms = JSON.parse($("#apitest form textarea").val());
        var result = myPost(ctrl, func, parms);
        $("#apitestResult").html("<pre>"+JSON.stringify(result, null, "\t")+"</pre>");
    });

    
}