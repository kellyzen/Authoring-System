//delete topic
function deleteTopic(topic_ID) {
    // Get the ID of the item to delete
    var id = topic_ID;
    // Set the ID in the confirmation modal
    $('#delete-id').val(id);
    $('#confirm-delete-modal').modal('show');
}

//confirm delete topic
function confirmDeleteTopic() {
    var topicid = $('#delete-id').val();

    if (topicid != '') {
        $.ajax({
            url: 'Actions/topic_delete.php',
            type: 'post',
            data: {
                topicid: topicid,
            },
            success: function (html) {
                if (html == "true") {
                    $.jGrowl("Delete Topic Failed", {
                        header: 'Delete Topic'
                    });
                } else {
                    $.jGrowl("Topic Successfully Deleted", {
                        header: 'Delete Topic'
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

//clone topic
function cloneTopic(topic_ID) {
    // Get the ID of the item to clone
    var id = topic_ID;
    // Set the ID in the confirmation modal
    $('#clone-id').val(id);
    $('#confirm-clone-modal').modal('show');
}

//confirm clone topic
function confirmCloneTopic() {
    var topicid = $('#clone-id').val();

    if (topicid != '') {
        $.ajax({
            url: 'Actions/topic_clone.php',
            type: 'post',
            data: {
                topicid: topicid,
            },
            success: function (html) {
                if (html == "true") {
                    $.jGrowl("Clone Topic Failed", {
                        header: 'Clone Topic'
                    });
                } else {
                    $.jGrowl("Topic Successfully Cloned", {
                        header: 'Clone Topic'
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

//Toggle dropdown for topics
function toggleEllipsisFunction(topic_ID) {
    removeShow('.ellipsis-dropdown-content');

    let topicID = 'topic_ID' + topic_ID.toString();
    document.getElementById(topicID).classList.toggle("show");
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

//Close all dropdowns if user clicks outside of it
document.onclick = function (event) {
    if (!event.target.matches('.fa-ellipsis-h')) {
        removeShow('.ellipsis-dropdown-content');
    }
}