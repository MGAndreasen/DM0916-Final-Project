function page_customers() {
    var section = $('#customers');
    section.html(customers_Layout());

    customer_populate_customerList();


}

function customers_Layout() {
    return ""
        + "<div id='customer_list'></div>";
}

function customer_populate_customerList() {
    var section = $('#customers');
    var parms = [];
    var restData = myPost('customer', 'getCustomers', parms);

    if (restData['status'] === "OK") {
        $.each(restData['result']['customers'], function (key, value) {
            var c = "<div id='customer-" + value['id'] + "'>" + value['email'] + "</div>";
            section.append(c);
        });
    }
}