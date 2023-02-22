<?php
include "../config.php";
if (isset($_POST["theme"])) {
    $newtheme = mysqli_real_escape_string($conn, $_POST["theme"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    if ($newtheme != '') {
        //update profile
        $sql = "Update user set theme='$newtheme' where user_ID='$user_id'";
        mysqli_query($conn, $sql);
    }
}
