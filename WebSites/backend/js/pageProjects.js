function page_projects() {
    var section = $("#projects");                                       // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    section.html(projects_createLayout());                              // Populate section layout.
    section.on('click', '.project', projects_click_project());          // Create new eventhandler
    section.on('click', '.addNew', projects_newProject());              // Create new eventhandler


    projects_populate_projectList();

    
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
        + "    <div class='content'></div>"
        + "  </div>"
        + "  <div class='project_data'>"
        + "    <div class='title'>Data</div>"
        + "    <div class='content'>"
        + "      <input class='name' type='text' placeholder='name'/>"
        + "      <input class='size' type='text' placeholder='size'/>"
        + "      <input class='enabled' type='text' placeholder='enabled'/>"
        + "    </div>"
        + "  </div>"
        + "</div>";
}

function projects_populate_projectList() {
    var project_list = $('#projects  .project_list > .content');

    // Test load data.
    var customerid = customer;
    var parms = [customerid];
    var restData = myPost('project', 'getProjects', parms);
    var p;

    if (restData['status'] === "OK") {
        $.each(restData['result']['projects'], function (key, value) {
            p = "<div class='project' id='project_" + value['id'] + "'><i class='fas fa-project-diagram'></i >" + value['name'] + "</div>";
            project_list.append(p);
        });
    }
}

function projects_click_project() {
    return function () {
        if (!$(this).hasClass('active')) {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            projects_populateHirachy();
        }
    }
}

function projects_newProject() {
    return function () {
        var ele = $('#projects .project_list > .new > input');
        var pname = ele.val();
        ele.val('');
        var html = "<div class='project'><i class='fas fa-project-diagram'></i >" + pname + "</div >";
        $('#projects .project_list > .content').append(html);
        notify('Project', 'Created: '+pname);
    };
}

function projects_populateHirachy() {
        var id = $(this).attr('id').replace('project_','');
        var project_data = $('#projects  .project_data > .content');
        var project_hirachy = $('#projects  .project_hirachy > .content');
 

        var projectid = [id];
        var restData = myPost('project', 'getProject', projectid);

        if (restData['status'] === "OK") {
            project_data.children('.name').val(restData['result']['projects'][0]['name']);
            project_data.children('.size').val(restData['result']['projects'][0]['imagesize']);
            project_data.children('.enabled').val(restData['result']['projects'][0]['enabled']);

            /*
            $.each(restData['result']['projects'], function (key, value) {
                p = "<div class='project' id='project-" + value['id'] + "'><i class='fas fa-project-diagram'></i >" + value['name'] + "</div>";
                project_list.append(p);
            });
            */
        }

        project_hirachy.append('load stuff here');
}