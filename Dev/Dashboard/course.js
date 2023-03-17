//delete course
function deleteCourse(course_ID) {
    // Get the ID of the item to delete
    var id = course_ID;
    // Set the ID in the confirmation modal
    $('#course-delete-id').val(id);
    $('#course-delete-modal').modal('show');
}

//confirm delete course
function confirmDeleteCourse() {
    var courseid = $('#course-delete-id').val();

    if (courseid != '') {
        $.ajax({
            url: 'Actions/course_delete.php',
            type: 'post',
            data: {
                courseid: courseid,
            },
            success: function (html) {
                if (html == "true") {
                    $.jGrowl("Delete Course Failed", {
                        header: 'Delete Course'
                    });
                } else {
                    $.jGrowl("Course Successfully Deleted", {
                        header: 'Delete Course'
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

//Toggle between edit and save function
function changeView() {
    if (document.getElementById("dashboard-content").classList.contains("dashboard-list")) {
        //change dashboard to grid view
        document.getElementById('viewButton').innerHTML = '<i class="fal fa-regular fa-list"></i>';
        document.getElementById("dashboard-content").classList.remove("dashboard-list");
    } else {
        //change dashboard to list view
        document.getElementById('viewButton').innerHTML = '<i class="fal fa-solid fa-grip-vertical"></i>';
        document.getElementById("dashboard-content").classList.toggle("dashboard-list");
    }
}

function showFilterMenu() {
    document.getElementById("filter-dropdown-content").classList.toggle("show");
}
//Auto update course information
setInterval(autoSaveCourse, 2000);

function autoSaveCourse() {
    var title = $('#course-header-title').html();
    var description = $('#course-description').html();
    var courseid = $('#get_id').val().trim();

    if (title == '') {
        document.getElementById('course-header-title').innerHTML = 'Untitled';
    }

    if (description == '') {
        document.getElementById('course-description').innerHTML = 'Add description here...';
    }

    if (title != '' || description != '') {
        $.ajax({
            url: 'Actions/course_update.php',
            type: 'post',
            data: {
                courseid: courseid,
                title: title,
                description: description,
            }
        });
    }
}

//Ignore enter key while editing course title and course description
document.querySelector('#course-header-title').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
});
document.querySelector('#course-description').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
    }
});