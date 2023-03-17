//Toggle dropdown for files
function toggleDocDropdown(doc_ID) {
    removeShow('.file-dropdown-content');

    let docID = 'doc_ID' + doc_ID.toString();
    document.getElementById(docID).classList.toggle("show");
}

//delete file
function deleteDoc(file_id) {
    // Get the ID of the item to delete
    var id = file_id;
    // Set the ID in the confirmation modal
    $('#doc-delete-id').val(id);
    $('#doc-delete-modal').modal('show');
}

//confirm delete file
function confirmDeleteDoc() {
    var fileid = $('#doc-delete-id').val();

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