<?php
include "../config.php";
if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["password"])) {
    $profile_email = mysqli_real_escape_string($conn, $_POST["email"]);
    $profile_username = mysqli_real_escape_string($conn, $_POST["username"]);
    $profile_firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $profile_lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $profile_password = mysqli_real_escape_string($conn, $_POST["password"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    //update profile
    $sql1 = "Update user set email='" . $profile_email . "', username='" . $profile_username . "', firstname='" . $profile_firstname . "', lastname='" . $profile_lastname . "', password='" . $profile_password . "' where user_ID = $user_id";
    mysqli_query($conn, $sql1);
}

if (isset($_POST["q1"]) && isset($_POST["q2"]) && isset($_POST["q3"]) && isset($_POST["ans1"]) && isset($_POST["ans2"]) && isset($_POST["ans3"])) {
    $profile_q1 = mysqli_real_escape_string($conn, $_POST["q1"]);
    $profile_q2 = mysqli_real_escape_string($conn, $_POST["q2"]);
    $profile_q3 = mysqli_real_escape_string($conn, $_POST["q3"]);
    $profile_ans1 = mysqli_real_escape_string($conn, $_POST["ans1"]);
    $profile_ans2 = mysqli_real_escape_string($conn, $_POST["ans2"]);
    $profile_ans3 = mysqli_real_escape_string($conn, $_POST["ans3"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    //update profile
    $sql2 = "Update user_security set ques1_ID='" . $profile_q1 . "', ques2_ID='" . $profile_q2 . "', ques3_ID='" . $profile_q3 . "', ques1_ans='" . $profile_ans1 . "', ques2_ans='" . $profile_ans2 . "', ques3_ans='" . $profile_ans3 . "' where user_ID = $user_id";
    mysqli_query($conn, $sql2);
}
