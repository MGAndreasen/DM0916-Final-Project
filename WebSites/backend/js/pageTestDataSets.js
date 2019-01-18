function page_testdatasets() {

    $("#testdatasets").html(testdatasets_createLayout());

    if (typeof FileReader !== "function") {
        notify('FileReader Api', 'Not found... get a newer browser');
    } else {
        notify('FileReader Api', 'Found... GREAT!');
    }

    var filedock = $('filedock');
    filedock.off(); // remove eventhandlers

    filedock.on('dragover', testdatasets_dragover(e));
    filedock.on('dragenter', testdatasets_dragenter(e));
    filedock.on('dragleave', testdatasets_dragleave(e));
    filedock.on('drop', testdatasets_dragdrop(e));
}

function testdatasets_createLayout() {
    return ""
        + "<p>data</p></br>"
        + "<div id='filedock' style='width: 300px; height:150px; border: 1px solid #999; background-color: #ddd; color: #999; text-align:center; margin: 0 auto;'>DROP IMAGE FILES HERE</div>"
        + "<div id='filedock_file'></div >"
        + "<div id='file-result'></div >";
}

function testdatasets_dragover(e) {
    return function (e) {
        $(this).attr('class', 'filedock_hover');
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragenter(e) {
    return function (e) {
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragleave(e) {
    return function (e) {
        $(this).attr('class', 'filedock');
    };
}


function testdatasets_dragdrop(e) {
    return function (e) {
        if (e.originalEvent.dataTransfer) {

            // Do progressbar here?

            // Any files
            if (e.originalEvent.dataTransfer.files.length) { 
                e.preventDefault();
                e.stopPropagation();

                //add adgang too the dropped files and pass work on
                uploadFun(e.originalEvent.dataTransfer.files);
            }
        }
    };
}

function uploadFun(file) {
    var reader = new FileReader();

    for (var i = 0; i < files.length; i++) {

        $('#filedock_files').append("<p>" + files[i].name + " - " + files[i].size + "</p>");

    $('#filedock_result').append(reader.readAsDataURL(files[i]));
    }
}

function filesChosen(evt) {
    var chosenFile = evt.target.files[0]; //get the first file in the FileList
    var fileName = chosenFile.name; //the name of the file as a string
    var fileSize = chosenFile.size; //the size of the file in bytes, as an integer
    var fileModifiedDate = chosenFile.lastModifiedDate; //a Date object
}