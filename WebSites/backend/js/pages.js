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

    section.html("<form><lable>Ctrl: <input id='apitestCtrl' type='text' value='project'/><lable></br><lable>Func: <input id='apitestFunc' type='text' value='getProjects'/><lable></br><lable>Parms:<textarea></textarea></lable></br><input class='runquery' type='button' value='Run Query'/><input class='example' type='button' value='Example'/></form><div id='#apitestResult'></div>");

    section.on('click', '.example', function () {
        $("#apitestCtrl").html("project");
        $("#apitestFunc").html("getProjects");
        $("#apitest form textarea").html("[1]");
    });

    section.on('click', '.runquery', function () {
        // Test Query
        var ctrl = $("#apitestCtrl").val();
        var func = $("#apitestFunc").val();
        var parms = JSON.parse($("#apitest form textarea").val());
        var result = myPost(ctrl, func, parms);
        $("#apitestResult").html(JSON.stringify(result));
    });

    
}