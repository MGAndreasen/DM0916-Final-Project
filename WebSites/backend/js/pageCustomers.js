//function page_customers() {
//    var section = $('#customers');
//    section.html(customers_Layout());

//    populate_customerList();


//}

//function customers_Layout() {
//    return "<div id='customer_list'></div>"
//
//
//}

function populate_customerList() {
    var section = $("#customers");

    section.html("<p>Customers</p>");

    // Test load data.
    var customerid = [1];
    var restData = myPost('customers', 'getCustomer', customerid);

    $.each(restData['result']['customers'], function (key, value) {
        var p = "<div id='customer-" + value['id'] + "'>" + value['email'] + "</div>";
        section.append(p);
    });
}