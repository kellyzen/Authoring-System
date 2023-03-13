<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";
?>

<div class="file-add-popup">
    <div class="popup-content">
        <div class="popup-header-box">
            <span class="popup-header">Add new file</span>
        </div>
        <form id="file-upload-form" enctype="multipart/form-data">
            <div class="popup-content-box" id="popup-content-box">
                <div class="popup-content-small-box">
                    <div id="dropzone">
                        <i class="fal fa-solid fa-upload"></i>
                        <div class="text">Click or drop files here to upload</div>
                    </div>
                    <input type="file" name="file" id="file">
                    <br>
                </div>
            </div>
            <div class="popup-footer-box">
                <button id="file-cancel-btn" class="popup-footer-btn secondary-btn" type="button">Cancel</button>
                <button class="popup-footer-btn primary-btn" type="submit">Upload</button>
            </div>
        </form>
        <a id="file-close-btn" class="close-button">x</a>
    </div>
</div>

<script>
    //Drag and drop file
    $(document).ready(function() {
        var dropzone = $('#dropzone');

        dropzone.click(function() {
            $("#file").click();
        });

        dropzone.on('dragover', function() {
            dropzone.addClass('hover');
            return false;
        });

        dropzone.on('dragleave', function() {
            dropzone.removeClass('hover');
            return false;
        });

        dropzone.on('drop', function(e) {
            e.preventDefault();
            dropzone.removeClass('hover');

            var file = e.originalEvent.dataTransfer.files[0];
            var formData = new FormData();
            formData.append('file', file);
            uploadData(formData);
        });

        $('#file-upload-form').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            uploadData(formData);
        });

        // Sending AJAX request and upload file
        function uploadData(formdata) {
            var topicid = <?php echo $get_id ?>;
            formdata.append('topicid', topicid);

            $.ajax({
                url: 'file_add_action.php',
                type: 'post',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == "true") {
                        $.jGrowl("Invalid File Type", {
                            header: 'Add File Failed'
                        });
                    } else {
                        $.jGrowl("File Successfully Added", {
                            header: 'File Added'
                        });
                        var delay = 2000;
                        setTimeout(function() {
                            window.location = ''
                        }, delay);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr.responseText); // Debug any issues with AJAX request
                }
            });
        }

    });
</script>