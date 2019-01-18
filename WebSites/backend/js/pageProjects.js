function page_projects() {
    var section = $("#projects");                                       // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    section.html(projects_createLayout());                              // Populate section layout.
    section.on('click', '.project', projects_populateHirachy());        // Create new eventhandler
    section.on('click', '.addNew', projects_newProject());              // Create new eventhandler


    populate_projectList();

    
}

function projects_createLayout() {
    return ""
        + "<div class='container'>"
        + "  <div class='project_list'>"
        + "    <div class='title'>Projects</div>"
        + "    <div class='content'></div>"
        + "    <div class='new'><i class='fas fa-project-diagram'></i ><input type='text' placeholder='New Project Name'/><i class='fas fa-plus-circle addNew'></i></div>"
        + "  </div>"
        + "  <div class='project_hirachy'>"
        + "    <div class='title'>Hirachy</div>"
        + "  </div>"
        + "  <div class='project_data'>"
        + "    <div class='title'>Data</div>"
        + "  </div>"
        + "</div>";
}

function populate_projectList() {
    var project_list = $('#projects  .project_list > .content');

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
        var pname = $(this).val();
        $(this).val('');
        var html = "<div class='project'><i class='fas fa-project-diagram'></i >" + pname + "</div >";
        $('#projects .project_list > .content').append(html);
    };
}

function projects_populateHirachy() {
    return function () {
        var hirachy = $('#projects .project_hirachy');
        hirachy.append('load stuff here');
    };
}