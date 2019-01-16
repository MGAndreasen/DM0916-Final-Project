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
        try {
            var parms = JSON.parse($("#apitest form textarea").val());
            var result = myPost(ctrl, func, parms);
            $("#apitestResult").html("<pre>" + JSON.stringify(result, null, "\t") + "</pre>");
        }
        catch (e) {
            $("#apitestResult").html("<pre>" + e + "</pre>");
        }
    });


}