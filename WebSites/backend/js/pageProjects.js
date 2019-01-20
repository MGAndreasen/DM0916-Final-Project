function page_projects() {
    var section = $("#projects");                                                // Get section ref.
    section.off();                                                               // unbind eventhandlers.
    section.html(projects_createLayout());                                       // Populate section layout.
    section.on('click', '.project', projects_click_project());                   // Create new eventhandler
    section.on('click', '.project_list .addNew', projects_newProject());                       // Create new eventhandler
    section.on('click', '.project_new_element .addNew', projects_create_hirachy_element());  // Create new eventhandler
    projectId = null;

    projects_populate_projectList();
    projects_refresh_sortable();
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
        + "    <div class='content'>"
        + "      <ul class='connectedSortable sortable' style='width:100%; height:100%;'>"
        + "        <li class='ui-state-highlight'><div>Item 0</div><ul class='connectedSortable sortable'></ul></li>"
        + "        <li class='ui-state-highlight'><div>Item 1</div><ul class='connectedSortable sortable'></ul></li>"
        + "        <li class='ui-state-highlight'><div>Item 2</div><ul class='connectedSortable sortable'></ul></li>"
        + "      </ul>"
        + "    </div>"
        + "  </div>"

        + "  <div class='project_panel'>"

        + "    <div class='project_data'>"

        + "      <div class='title'>Data</div>"
        + "      <div class='content'>"
        + "        <input class='name' type='text' placeholder='name'/>"
        + "        <input class='size' type='text' placeholder='size'/>"
        + "        <input class='enabled' type='text' placeholder='enabled'/>"
        + "      </div>"
        + "    </div>"

        + "    <div class='project_new_element'>"
        + "      <div class='title'>New hirachy element</div>"
        + "      <div class='content'>"
        + "        <input class='name' type='text' placeholder='name'/>"
        + "        <i class='fas fa-plus-circle addNew'></i>"
        + "      </div>"
        + "    </div>"

        + "    <div class='project_upload'>"
        + "      <div class='title'>Upload</div>"
        + "      <div class='content'>"
        + "        <div class='dropArea'>Drag'n'Drop</br>Images files here</br>too Upload em!</div>"
        + "        <div class='progress'>0 / 0</div>"
        + "      </div>"
        + "    </div>"

        + "  </div>"

        + "</div>";
}

function projects_populate_projectList() {
    var project_list = $('#projects  .project_list > .content');

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

            projects_populateHirachy($(this));
        }
    };
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

function projects_populateHirachy(project) {
        projectId = project.attr('id').replace('project_','');
        var project_data = $('#projects .project_data > .content');
        var project_hirachy = $('#projects .project_hirachy > .content');
 

        var parms = [projectId];
        var restData = myPost('project', 'getProject', parms);

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

        //project_hirachy.append('load stuff here');
}

function projects_create_hirachy_element() {
    return function () {
        var nameElement = $('#projects .project_new_element .name'); // ref input element
        var name = nameElement.val(); // Copy value
        nameElement.val(''); // Clear value

        if (name.length) {
            if (projectId) {
                var parms = [parseInt(projectId), 0, 128, 3, 20, name];
                var restData = myPost('project', 'createStructureElement', parms);

                if (restData['status'] === "OK") {
                    var result = restData['result']['projectStructures'][0];

                    if (result['id']) {
                        var element = "<li id='project_hirachy_element_" + result['id'] + "' class='ui-state-highlight'><div>" + result['name'] + "</div><ul class='connectedSortable sortable'></ul></li>";
                        var project_hirachy = $('#projects .project_hirachy > .content > .sortable');
                        project_hirachy.append(element);
                        projects_refresh_sortable();

                    }
                    else { notify('Create Structure Element','No id, returned'); }
                }
               
            }
            else { notify('Create Hirachy Element','Failed!  Pleace select a Project first!'); }
        }
    };
}

function projects_refresh_sortable() {
    hirachy = $(".project_hirachy .content .sortable").sortable({
        connectWith: ".connectedSortable",
        items: "li",
        toleranceElement: "> div",
        cursor: "move",
        delay: 150,
        dropOnEmpty: true,
        forceHelperSize: true,
        forcePlaceholderSize: true,
        grid: [20, 10],
        helper: "clone",
        hightlight: ".highlightClass"
    }).disableSelection();
}