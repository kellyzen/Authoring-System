//Toggle dropdown for files
function toggleVideoDropdown(video_ID) {
    removeShow('.file-dropdown-content');

    let videoID = 'video_ID' + video_ID.toString();
    document.getElementById(videoID).classList.toggle("show");
}

//delete file
function deleteVideo(file_id) {
    // Get the ID of the item to delete
    var id = file_id;
    // Set the ID in the confirmation modal
    $('#video-delete-id').val(id);
    $('#video-delete-modal').modal('show');
}

//confirm delete file
function confirmDeleteVideo() {
    var fileid = $('#video-delete-id').val();

    if (fileid != '') {
        $.ajax({
            url: 'file_delete.php',
            type: 'post',
            data: {
                fileid: fileid,
            },
            success: function (html) {
                console.log(html);
                if (html == "true") {
                    $.jGrowl("Delete File Failed", {
                        header: 'Delete File'
                    });
                } else {
                    $.jGrowl("File Successfully Deleted", {
                        header: 'Delete File'
                    });
                    var delay = 2000;
                    setTimeout(function () {
                        window.location = ''
                    }, delay);
                }
            }
        });
    }
}