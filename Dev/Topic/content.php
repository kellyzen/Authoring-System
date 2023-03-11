<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$sql = "SELECT * FROM topic INNER JOIN course ON course.course_ID = topic.course_ID where user_ID='$user_ID' AND topic_ID='$get_id';";
$result = $conn->query($sql);

$topic_name = $topic_description = $difficulty_ID = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $topic_name = $row["topic_name"];
        $topic_description = $row["topic_description"];
        $difficulty_ID = $row["difficulty_ID"];
        $course_ID = $row["course_ID"];
    }
}
?>

<div class="topic-container">
    <div class="topic-header">
        <div class="topic-header-box">
            <div class="topic-title-box">
                <span id="topic-header-title" class="topic-header-title" contenteditable="true" value=><?php echo $topic_name; ?></span>
            </div>
            <div class="topic-action-buttons-box">
                <div class="topic-action-buttons">
                    <button id="topicButton" class="action-btn" type="button" onclick="location.href='<?php echo '../Dashboard?id=' . $course_ID; ?>'">
                        Back <i class="fal fa-solid fa-arrow-left"></i>
                    </button>
                    <button id="editButton" class="action-btn" type="button">
                        Add <i class="fal fa-solid fa-file-plus"></i>
                    </button>
                </div>
                <div class="topic-action-buttons">
                    <button id="viewBtn" class="topic-action-button action-btn" type="button" onclick="changeView()">
                        <i class="fal fa-regular fa-list"></i>
                    </button>
                    </button>
                </div>
            </div>
        </div>
        <div class="topic-header-box">
            <span id="topic-description" class="topic-description" contenteditable="true"><?php echo $topic_description; ?></span>
        </div>
    </div>
    <!--List of Files-->
    <div class="topic-content-box">
        <?php include 'tab.php';?>
    </div>
</div>
<script>
    //Toggle between edit and save function
    function changeView() {
        if (document.getElementById("topic-content").classList.contains("topic-list")) {
            //change topic to grid view
            document.getElementById('viewBtn').innerHTML = '<i class="fal fa-regular fa-list"></i>';
            document.getElementById("topic-content").classList.remove("topic-list");
        } else {
            //change topic to list view
            document.getElementById('viewBtn').innerHTML = '<i class="fal fa-solid fa-grip-vertical"></i>';
            document.getElementById("topic-content").classList.toggle("topic-list");
        }
    }

    function showFilterMenu() {
        document.getElementById("filter-dropdown").classList.toggle("show");
    }

    //Auto update topic information
    setInterval(autoSaveTopic, 2000);

    function autoSaveTopic() {
        var title = $('#topic-header-title').html();
        var description = $('#topic-description').html();
        var topicid = <?php echo $get_id ?>;

        if (title == '') {
            document.getElementById('topic-header-title').innerHTML = 'Untitled';
        }

        if (description == '') {
            document.getElementById('topic-description').innerHTML = 'Add description here...';
        }

        if (title != '' || description != '') {
            $.ajax({
                url: 'topic_update.php',
                type: 'post',
                data: {
                    topicid: topicid,
                    title: title,
                    description: description,
                }
            });
        }
    }

    //Ignore enter key while editing topic title and topic description
    document.querySelector('#topic-header-title').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
    document.querySelector('#topic-description').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
</script>
