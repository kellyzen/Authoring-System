<?php
include "../../config.php";
if (isset($_POST["title"]) && isset($_POST["description"])) {
    $course_id = mysqli_real_escape_string($conn, $_POST["courseid"]);
    $course_title = mysqli_real_escape_string($conn, $_POST["title"]);
    $pcourse_description = mysqli_real_escape_string($conn, $_POST["description"]);

    if ($course_id != '') {
        //update course information
        $sql = "Update course set c_name='" . $course_title . "', c_description='" . $pcourse_description . "' where course_ID = $course_id";
        mysqli_query($conn, $sql);
    }
}
