//Toggle dropdown for files
function toggleImageDropdown(image_ID) {
    removeShow('.file-dropdown-content');

    let imageID = 'image_ID' + image_ID.toString();
    document.getElementById(imageID).classList.toggle("show");
}

//delete file
function deleteImage(file_id) {
    // Get the ID of the item to delete
    var id = file_id;
    // Set the ID in the confirmation modal
    $('#image-delete-id').val(id);
    $('#image-delete-modal').modal('show');
}

//confirm delete file
function confirmDeleteImage() {
    var fileid = $('#image-delete-id').val();

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