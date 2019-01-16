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
    var customerid = [1];
    var projects = myPost('project', 'getProjects', customerid);

    $.each(projects, function (key, value) {
        var p = "<div id='project-" + value['id'] + "'>" + value['name'] + "</div>";
        $("#projects").append(p);

        //bind evt. eventhandlers her, eller globalt?
    });

    $("#projects").append(JSON.stringify(projects));
}

function pageTestDataSets() {
    $("#testdatasets").html("<p>data</p>");
}

function pageApiTest() {
    $("#apitest").html("some Test data");
}