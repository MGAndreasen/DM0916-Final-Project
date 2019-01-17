function page_errorlog() {
    var section = $('#errorlog');

    section.html(errorlog_Layout());

    $.ajax({
        type: "GET",
        url: "/error.log",
        dataType: 'text',
        encode: true,
        async: false
    }).done(function (html) {
        $('#error_list').html(html);
    });
}

function errorlog_Layout() {
    return "<h1>errorlog</h1>"
        + "<pre id='error_list'></pre>";
}