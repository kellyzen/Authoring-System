<?php
include "../../config.php";
if (isset($_POST["title"]) && isset($_POST["description"])) {
    $topic_id = mysqli_real_escape_string($conn, $_POST["topicid"]);
    $topic_title = mysqli_real_escape_string($conn, $_POST["title"]);
    $topic_description = mysqli_real_escape_string($conn, $_POST["description"]);

    if ($topic_id != '') {
        //update course information
        $sql = "Update topic set topic_name='" . $topic_title . "', topic_description='" . $topic_description . "' where topic_ID = $topic_id";
        mysqli_query($conn, $sql);
    }
}
