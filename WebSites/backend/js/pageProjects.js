function page_projects() {
    var section = $('#projects');
    section.html(projects_Layout());

    populate_projectList();

    
}

function projects_Layout() {
    return "<div id='project_list'></div>"
        + "<div id='project_hirachy'></div>"
        + "<div id='project_images'></div>";
}

function populate_projectList() {
    var project_list = $('#project_list');
    project_list.html("<div id='#project_list_title'>Projects</div>");

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