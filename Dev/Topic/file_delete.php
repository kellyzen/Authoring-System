<?php
include "../config.php";
if (isset($_POST["fileid"])) {
    $file_id = mysqli_real_escape_string($conn, $_POST["fileid"]);

    $sql = "SELECT file_path FROM `file` where file_ID='$file_id';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $file_path = $row["file_path"];

    if ($file_id != '') {
        if (file_exists($file_path)) {
            unlink($file_path);
            //update file table
            $sql = "Delete from file where file_ID = $file_id";
            mysqli_query($conn, $sql);
            echo 'File deleted successfully';
        } else {
            echo 'File not found';
        }
    }
}
