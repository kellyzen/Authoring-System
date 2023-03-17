<?php
include "../../config.php";
if (isset($_POST["courseid"])) {
    $course_id = mysqli_real_escape_string($conn, $_POST["courseid"]);

    if ($course_id != '') {
        //update topic table
        $sql = "Delete from course where course_ID = $course_id";
        mysqli_query($conn, $sql);
    }
}
?>