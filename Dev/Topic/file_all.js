//Toggle dropdown for files
function toggleFileDropdown(file_ID) {
    removeShow('.file-dropdown-content');

    let fileID = 'file_ID' + file_ID.toString();
    document.getElementById(fileID).classList.toggle("show");
}

//Remove show class
function removeShow(classList) {
    const check = document.querySelectorAll(classList);
    check.forEach(e => {
        if (e.classList.contains('show')) {
            e.classList.remove('show');
        }
    })
}

//delete file
function deleteFile(file_id) {
    // Get the ID of the item to delete
    var id = file_id;
    // Set the ID in the confirmation modal
    $('#file-delete-id').val(id);
    $('#confirm-delete-modal').modal('show');
}

//confirm delete file
function confirmDeleteFile() {
    var fileid = $('#file-delete-id').val();

    if (fileid != '') {
        $.ajax({
            url: 'file_delete.php',
            type: 'post',
            data: {
                fileid: fileid,
            },
            success: function (html) {
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

//Close all dropdowns if user clicks outside of it
document.addEventListener('click', function (event) {
    if (!event.target.matches('.fa-ellipsis-h')) {
        removeShow('.file-dropdown-content');
    }
});