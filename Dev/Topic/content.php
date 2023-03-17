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
                    <button id="file-add" class="action-btn" type="button">
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
        <input type='hidden' id='get_id' value='<?php echo $get_id ?>'>
    </div>
    <!--List of Files-->
    <div class="topic-content-box">
        <?php include 'tab.php';?>
    </div>
</div>

<script type="text/javascript" src="content.js"></script>  