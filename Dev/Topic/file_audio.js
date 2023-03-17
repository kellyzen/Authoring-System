//Toggle dropdown for files
function toggleAudioDropdown(audio_ID) {
    removeShow('.file-dropdown-content');

    let audioID = 'audio_ID' + audio_ID.toString();
    document.getElementById(audioID).classList.toggle("show");
}

//delete file
function deleteAudio(file_id) {
    // Get the ID of the item to delete
    var id = file_id;
    // Set the ID in the confirmation modal
    $('#audio-delete-id').val(id);
    $('#audio-delete-modal').modal('show');
}

//confirm delete file
function confirmDeleteAudio() {
    var fileid = $('#audio-delete-id').val();

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