<?php
include "../config.php";
if (isset($_POST["topicid"])) {
    $topic_id = mysqli_real_escape_string($conn, $_POST["topicid"]);

    if ($topic_id != '') {
        //update topic table
        $sql = "Delete from topic where topic_ID = $topic_id";
        mysqli_query($conn, $sql);
    }
}
?>