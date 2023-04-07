//Create new course
function createCourse() {
    var userid = $('#user_ID').val().trim();
    var title = $('#popup-course-title').val().trim();
    var type = $('#popup-course-type').val().trim();
    var desc = $('#popup-course-desc').val().trim();

    if (title == '') {
        title = 'Untitled';
    }

    if (desc == '') {
        desc = 'Add description here...';
    }

    $.ajax({
        url: 'Actions/course_add.php',
        type: 'post',
        data: {
            title: title,
            type: type,
            desc: desc,
            userid: userid,
        },
        success: function (html) {
            if (html == "true") {
                $.jGrowl("Add Course Failed", {
                    header: 'Add Course Failed'
                });
            } else {
                $.jGrowl("Course Successfully Added", {
                    header: 'Course Added'
                });
                var delay = 2000;
                var loc = html;
                setTimeout(function () {
                    window.location = '?id=' + loc;
                }, delay);
            }
        }
    });
}