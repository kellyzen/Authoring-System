<?php
include "../../config.php";
if (isset($_POST["title"]) && isset($_POST["type"]) && isset($_POST["desc"])) {
    $course_title = mysqli_real_escape_string($conn, $_POST["title"]);
    $course_type = mysqli_real_escape_string($conn, $_POST["type"]);
    $course_desc = mysqli_real_escape_string($conn, $_POST["desc"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    //add new course
    $sql = "INSERT INTO course (c_name,c_description,c_type_ID,user_ID) VALUES ('$course_title', '$course_desc', $course_type, $user_id)";
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM course where user_ID='$user_id' AND c_name='$course_title';";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $course_ID = $row["course_ID"];
    }
    echo $course_ID;
}
?>