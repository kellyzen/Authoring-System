<?php
echo "profile_update";
include "../config.php";
if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["password"])) {
    $profile_id = mysqli_real_escape_string($conn, $_POST["profileid"]);
    $profile_email = mysqli_real_escape_string($conn, $_POST["email"]);
    $profile_username = mysqli_real_escape_string($conn, $_POST["username"]);
    $profile_firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $profile_lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $profile_password = mysqli_real_escape_string($conn, $_POST["password"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    if ($profile_id != '') {
        //update profile
        $sql = "Update user set email='" . $profile_email . "', username='" . $profile_username . "', firstname='" . $profile_firstname . "', lastname='" . $profile_lastname . "', password='" . $profile_password . "' where user_ID = $user_id";
        mysqli_query($conn, $sql);
    }
}
