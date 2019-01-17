function page_projects() {
    var section = $('#projects');
    section.html(projects_Layout());

    populate_projectList();

    
}

function projects_Layout() {
    return "<h1>projects</h1>"
        + "<div id='project_list'></div>";
}

function populate_projectList() {
    var project_list = $('#project_list');

    // Test load data.
    var customerid = [1];
    var restData = myPost('project', 'getProjects', customerid);
    var p;

    if (restData['status'] === "OK") {
        $.each(restData['result']['projects'], function (key, value) {
            p = "<div id='project-" + value['id'] + "'>" + value['name'] + "</div>";
            project_list.append(p);
        });
    }
}