<?php
include "../../config.php";
if (isset($_POST["title"]) && isset($_POST["difficulty"]) && isset($_POST["desc"])) {
    $topic_title = mysqli_real_escape_string($conn, $_POST["title"]);
    $topic_difficulty = mysqli_real_escape_string($conn, $_POST["difficulty"]);
    $topic_desc = mysqli_real_escape_string($conn, $_POST["desc"]);
    $course_id = mysqli_real_escape_string($conn, $_POST["courseid"]);

    //add new course
    $sql = "INSERT INTO `topic` (`topic_ID`, `topic_name`, `topic_description`, `difficulty_ID`, `course_ID`) VALUES (NULL, '$topic_title', '$topic_desc', '$topic_difficulty', '$course_id')";
    mysqli_query($conn, $sql);
}