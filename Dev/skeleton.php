<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('Location:Login/login.php');
} else {
    //new course
}
include '../head.php';
include '../config.php';

$sql = "SELECT theme FROM user where username='$_SESSION[username]';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $theme = $row["theme"];
    }
}
?>