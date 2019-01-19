function page_testdatasets() {
    var section = $("#testdatasets");
    section.html(testdatasets_createLayout());

    if (typeof FileReader !== "function") {
        notify('FileReader Api', 'Not found... get a newer browser');
    } else {
        notify('FileReader Api', 'Found... GREAT!');
    }


    section.off(); // remove eventhandlers

    section.on('dragover', '.filedock', testdatasets_dragover());
    section.on('dragenter', '.filedock',testdatasets_dragenter());
    section.on('dragleave', '.filedock',testdatasets_dragleave());
    section.on('drop', '.filedock', testdatasets_dragdrop());
}

function testdatasets_createLayout() {
    return ""
        + "<p>data</p></br>"
        + "<div id='filedock' class='filedock'>Drop filer her</div>"
        + "<div id='filedock_file'></div>"
        + "<div id='file-result'></div >";
}

function testdatasets_dragover() {
    return function (e) {
        $(this).addClass('filedock_hover');
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragenter() {
    return function (e) {
        e.preventDefault();
        e.stopPropagation();
    };
}


function testdatasets_dragleave() {
    return function (e) {
        $(this).removeClass('filedock_hover');
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

function uploadFun(files) {
    var reader = new FileReader();
    for (var i = 0; i < files.length; i++) {
        console.log(i+' - '+files[i].name);
        $('#filedock_file').append("<p>" + files[i].name + " - " + files[i].size + "</p>");

        reader.onloadend = function () {
            $('#file-result').append('<p>' + reader.result + '</p>');
            //console.log(reader.result); //this is an ArrayBuffer
        };
        reader.readAsDataURL(files[i]);
    }
}

function filesChosen(evt) {
    var chosenFile = evt.target.files[0]; //get the first file in the FileList
    var fileName = chosenFile.name; //the name of the file as a string
    var fileSize = chosenFile.size; //the size of the file in bytes, as an integer
    var fileModifiedDate = chosenFile.lastModifiedDate; //a Date object
}