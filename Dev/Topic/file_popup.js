//Drag and drop file
$(document).ready(function () {
    var dropzone = $('#dropzone');

    dropzone.click(function () {
        $("#file").click();
    });

    dropzone.on('dragover', function () {
        dropzone.addClass('hover');
        return false;
    });

    dropzone.on('dragleave', function () {
        dropzone.removeClass('hover');
        return false;
    });

    dropzone.on('drop', function (e) {
        e.preventDefault();
        dropzone.removeClass('hover');

        var file = e.originalEvent.dataTransfer.files[0];
        var formData = new FormData();
        formData.append('file', file);
        uploadData(formData);
    });

    $('#file-upload-form').submit(function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        uploadData(formData);
    });

    // Sending AJAX request and upload file
    function uploadData(formdata) {
        var topicid = $('#get_id').val().trim();
        formdata.append('topicid', topicid);

        $.ajax({
            url: 'file_add.php',
            type: 'post',
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response == "true") {
                    console.log(response);
                    $.jGrowl("Invalid File Type", {
                        header: 'Add File Failed'
                    });
                } else {
                    $.jGrowl("File Successfully Added", {
                        header: 'File Added'
                    });
                    var delay = 2000;
                    setTimeout(function () {
                        window.location = ''
                    }, delay);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.error(xhr.responseText); // Debug any issues with AJAX request
            }
        });
    }

});