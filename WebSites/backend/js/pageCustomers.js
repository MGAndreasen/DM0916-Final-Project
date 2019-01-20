function page_customers() {
    var section = $('#customers');                                      // Get section ref.
    section.off();                                                      // unbind eventhandlers.
    section.on('click', '.customer', customers_click_customer());       // Create new eventhandler
    //section.on('click', '.addNew', projects_newProject());              // Create new eventhandler

    section.html(customers_createLayout());
    customers_populate_customerList();                                   // Populate section layout.
}

function customers_createLayout() {
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
        + "      <input class='email' type='text' placeholder='email'/>"
        + "      <input class='password' type='text' placeholder='new password'/>"
        + "      <input class='enabled' type='text' placeholder='enabled'/>"
        + "    </div>"
        + "  </div>"
        + "</div>";
}

function customers_populate_customerList() {
    var section = $('#customers .customer_list > .content');
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

function customers_click_customer() {
    return function () {
        if (!$(this).hasClass('active')) {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');

            customer = project.attr('id').replace('customer_', '');
        }
    };
}