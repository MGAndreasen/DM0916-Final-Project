function page_errorlog() {
    var section = $('#errorlog');
    var error_list = $('#error_list');

    section.html(error_Layout());

    $.ajax({
        type: "GET",
        url: "/error.log",
        dataType: 'text',
        encode: true,
        async: false,
        success: function (result) {
            error_list.html(result);
        }
    });
}

function errorlog_Layout() {
    return "<h1>errorlog</h1>"
        + "<pre id='error_list'></pre>";
}