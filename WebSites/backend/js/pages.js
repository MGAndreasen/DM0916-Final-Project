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

    section.html("<form><textarea></textarea></br><input type='button' value='Run Query'/><input class='example' type='button' value='Example'/></form><div id='#apitestResult'></div>");
}