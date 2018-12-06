$(document).ready(function () {

    $.ajax({
        url: "/backend/ajax.php",
        data: {
            test: 12
        },
        success: testOk(result),
        error: fejl()
    });

});

// Functions
function testOk(result) {
    $("#status").html("<p>STATUS: </p><strong>" + result + "</strong>");
}

function fejl() {
    $("#status").html("<p>STATUS: </p><strong>could not load ajax.php</strong>");
}