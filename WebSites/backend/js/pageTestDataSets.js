function page_testdatasets() {
    var layout = "<p>data</p></br>"
        + "<div id='dropfiles' style='width: 300px; height:150px; border: 1px solid #999; background-color: #ddd; color: #999; text-align:center; margin: 0 auto;'>DROP IMAGE FILES HERE</div>"
        +"<div id='file-result'></div >";

    $("#testdatasets").html(layout);

    if (typeof FileReader !== "function") {
        notify('FileReader Api', 'Not found... get a newer browser');
    } else {
        notify('FileReader Api', 'Found... GREAT!');
    }

    
}