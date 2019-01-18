function page_projects() {
    var section = $('#projects');
    section.html(projects_Layout());

    populate_projectList();

    
}

function projects_Layout() {
    return "" +
        + "<div class='project_list'>"
        + "  <div class='title'>Projects</div>"
        + "  <div class='content'></div>"
        + "  <div class='bottom'><i class='far fa - plus - circle'></i>add</div>"
        + "</div>"
        + "<div class='project_hirachy'></div>"
        + "<div class='project_images'></div>";
}

function populate_projectList() {
    var project_list = $('#projects > .project_list > .content');

    // Test load data.
    var customerid = [1];
    var restData = myPost('project', 'getProjects', customerid);
    var p;

    if (restData['status'] === "OK") {
        $.each(restData['result']['projects'], function (key, value) {
            p = "<div class='project' id='project-" + value['id'] + "'>" + value['name'] + "</div>";
            project_list.append(p);
        });
    }
}