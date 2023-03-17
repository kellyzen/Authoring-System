//Create new topic
function createTopic() {
    var courseid = $('#get_id').val().trim();
    var title = $('#popup-topic-title').val().trim();
    var difficulty = $('#popup-topic-difficulty').val().trim();
    var desc = $('#popup-topic-desc').val().trim();

    if (title == '') {
        title = 'Untitled';
    }

    if (desc == '') {
        desc = 'Add description here...';
    }

    $.ajax({
        url: 'Actions/topic_add.php',
        type: 'post',
        data: {
            title: title,
            difficulty: difficulty,
            desc: desc,
            courseid: courseid,
        },
        success: function (html) {
            if (html == "true") {
                $.jGrowl("Add Topic Failed", {
                    header: 'Add Topic Failed'
                });
            } else {
                $.jGrowl("Topic Successfully Added", {
                    header: 'Topic Added'
                });
                var delay = 2000;
                setTimeout(function () {
                    window.location = ''
                }, delay);
            }
        }
    });
}