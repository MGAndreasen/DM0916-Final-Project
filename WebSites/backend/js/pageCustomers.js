function page_customers() {
    var section = $('#customers');                                      // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    customer_populate_customerList();                                   // Populate section layout.
    //section.on('click', '.project', projects_populateHirachy());        // Create new eventhandler
    //section.on('click', '.addNew', projects_newProject());              // Create new eventhandler
}

function customers_Layout() {
    return ""
        + "<div class='container'>"
        + "  <div class='customer_list'>"
        + "    <div class='title'>Customers</div>"
        + "    <div class='content'></div>"
        + "    <div class='new'><i class='fas fa-project-diagram'></i ><input type='text' placeholder='New Customer'/><i class='fas fa-plus-circle addNew'></i></div>"
        + "  </div>"
        + "  <div class='customer_data'>"
        + "    <div class='title'>Data</div>"
        + "    <div class='content'>"
        + "      <input class='email' type='text' placeholder='name'/>"
        + "      <input class='password' type='text' placeholder='size'/>"
        + "      <input class='enabled' type='text' placeholder='enabled'/>"
        + "    </div>"
        + "  </div>"
        + "</div>";
}

function customer_populate_customerList() {
    var section = $('#customers > .customer_list > .content');
    var parms = [];
    var restData = myPost('customer', 'getCustomers', parms);

    if (restData['status'] === "OK") {
        var c;
        $.each(restData['result']['customers'], function (key, value) {
            c = "<div class='customer' id='customer_" + value['id'] + "'><i class='fas fa-project-diagram'></i >" + value['email'] + "</div>";
            section.append(c);
        });
    }
}