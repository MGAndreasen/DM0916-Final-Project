function page_testdatasets() {

    $("#testdatasets").html(testdatasets_createLayout());

    if (typeof FileReader !== "function") {
        notify('FileReader Api', 'Not found... get a newer browser');
    } else {
        notify('FileReader Api', 'Found... GREAT!');
    }

    var filedock = $('filedock');
    filedock.off(); // remove eventhandlers

    filedock.on('dragover', testdatasets_dragover());
    filedock.on('dragenter', testdatasets_dragenter());
    filedock.on('dragleave', testdatasets_dragleave());
    filedock.on('drop', testdatasets_dragdrop());
}

function testdatasets_createLayout() {
    return ""
        + "<p>data</p></br>"
        + "<input type='file' id='filedock' class='filedock'/>"
        + "<div id='filedock_file'></div >"
        + "<div id='file-result'></div >";
}

function testdatasets_dragover() {
    return function (e) {
        alert(e);
        $(this).addClass('filedock_hover').removeClass('filedock');
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragenter() {
    return function (e) {
        alert(e);
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragleave() {
    return function (e) {
        alert(e);
        $(this).removeClass('filedock_hover').addClass('filedock');
    };
}


function testdatasets_dragdrop() {
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