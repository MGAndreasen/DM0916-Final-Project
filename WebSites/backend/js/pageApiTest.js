//-- Main entry
function page_apitest() {
    var section = $("#apitest");                                        // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    section.html(apitest_createLayout());                               // Populate section layout.
    section.on('click', '.example', apitest_populateExampleQueue());    // Create new eventhandler
    section.on('click', '.runquery', apitest_runQuery());               // Create new eventhandler
}

//-- Section Layout
function apitest_createLayout() {
    return "<form>"
        + "<label>Ctrl: <input id='apitestCtrl' type='text' value='project'/></label></br>"
        + "<label>Func: <input id='apitestFunc' type='text' value='getProjects'/></label></br>"
        + "<label>Parms:<textarea></textarea></label></br>"
        + "<input class='runquery' type='button' value='Run Query'/>"
        + "<input class='example' type='button' value='Example'/>"
        + "</form></br>"
        + "<div id='apitestResult'></div>";
}

//-- Example Query
function apitest_populateExampleQueue() {
    return function () {
        $("#apitestCtrl").val("project");
        $("#apitestFunc").val("getProjects");
        $("#apitest form textarea").val("[1]");
    };
}

//-- Test Query
function apitest_runQuery() {
    return function () {
        var ctrl = $("#apitestCtrl").val();
        var func = $("#apitestFunc").val();
        try {
            var parms = JSON.parse($("#apitest form textarea").val());
            var restData = myPost(ctrl, func, parms);
            $("#apitestResult").html("<pre>" + JSON.stringify(restData, null, "\t") + "</pre>");
        }
        catch (e) {
            $("#apitestResult").html("<pre>" + e + "</pre>");
            notify('JSON.parse', e);
        }
    };
}