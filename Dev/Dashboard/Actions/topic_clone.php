<?php
include "../../config.php";
if (isset($_POST["topicid"])) {
    $topic_id = mysqli_real_escape_string($conn, $_POST["topicid"]);

    if ($topic_id != '') {
        //update topic table
        $sql = "INSERT INTO topic (topic_name, topic_description, difficulty_ID, course_ID) SELECT topic_name, topic_description, difficulty_ID, course_ID FROM topic WHERE topic_ID = $topic_id";
        mysqli_query($conn, $sql);
    }
}
?>