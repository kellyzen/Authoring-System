<?php 
include "../config.php";
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $topic_ID = $_POST["topicid"];

    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'mp3', 'mp4', 'm4a');

    if (in_array($fileExt, $allowedExt)) {
        $targetDir = '../../Upload/';
        $targetFile = $targetDir . $fileName;

        move_uploaded_file($fileTmpName, $targetFile);

        // Insert file into database

        $sql = "INSERT INTO file (file_name, file_size, file_type, file_path, topic_ID) VALUES ('$fileName', '$fileSize', '$fileType', '$targetFile', '$topic_ID')";
        $conn->query($sql);
        echo 'File uploaded successfully.';

    }else {
        echo "true";
    }
} else {
    echo "true";
}
?>
