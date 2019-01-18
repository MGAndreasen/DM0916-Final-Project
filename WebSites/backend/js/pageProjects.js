function page_projects() {
    var section = $("#projects");                                       // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    section.html(projects_createLayout());                              // Populate section layout.
    section.on('click', '.project', projects_populateHirachy());        // Create new eventhandler
    section.on('click', '.new', projects_newProject());                 // Create new eventhandler


    populate_projectList();

    
}

function projects_createLayout() {
    return ""
        + "<div class='project_list'>"
        + "  <div class='title'>Projects</div>"
        + "  <div class='content'></div>"
        + "  <div class='new'><i class='fas fa-plus-circle'></i></div>"
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
            p = "<div class='project' id='project-" + value['id'] + "'><i class='fas fa-project-diagram'></i >" + value['name'] + "</div>";
            project_list.append(p);
        });
    }
}

function projects_newProject() {
    return function () {
        $(this).append('WooooT');
    };
}

function projects_populateHirachy() {
    return function () {
        $(this).append('Hirachy');
    };
}