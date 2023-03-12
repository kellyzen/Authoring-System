<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";
$query = mysqli_query($conn, "SELECT * FROM difficulty ORDER BY difficulty_ID ASC;");
$count = mysqli_num_rows($query);
?>

<div class="topic-add-popup">
    <div class="popup-content">
        <div class="popup-header-box">
            <span class="popup-header">Add new topic</span>
        </div>
        <div class="popup-content-box" id="popup-content-box">
            <div class="popup-content-small-box">
                <span class="popup-content-title">Title</span>
                <input id="popup-topic-title" type="text" placeholder="Add topic title...">
            </div>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Difficulty Level</span>
                <select class="dropdown" id="popup-topic-difficulty">
                    <?php
                    if ($count != '0') {
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <option value="<?php echo $row['difficulty_ID']; ?>"><?php echo $row['difficulty']; ?></option><?php
                                                                                                                }
                                                                                                            } ?>
                </select>
            </div>
            <input type='hidden' id='hidden' value=''>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Description</span>
                <textarea id="popup-topic-desc" rows="4" cols="50" placeholder="Add topic description..."></textarea>
            </div>
        </div>
        <div class="popup-footer-box">
            <button id="topic-cancel-btn" class="popup-footer-btn secondary-btn" type="button">Cancel</button>
            <button class="popup-footer-btn primary-btn" type="button" onclick="create()">Create</button>
        </div>
        <a id="topic-close-btn" class="close-button">x</a>
    </div>
</div>

<script>
    //Change theme colour
    function create() {
        var courseid = <?php echo $get_id ?>;
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
            url: 'topic_add_action.php',
            type: 'post',
            data: {
                title: title,
                difficulty: difficulty,
                desc: desc,
                courseid: courseid,
            },
            success: function(html) {
                if (html == "true") {
                    $.jGrowl("Add Topic Failed", {
                        header: 'Add Topic Failed'
                    });
                } else {
                    $.jGrowl("Topic Successfully Added", {
                        header: 'Topic Added'
                    });
                    var delay = 2000;
                    setTimeout(function() {
                        window.location = ''
                    }, delay);
                }
            }
        });
    }
</script>