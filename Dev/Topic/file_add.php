<?php 
include "../config.php";
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $topic_ID = $_POST["topicid"];

    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'mp3', 'mp4', 'm4a', 'txt', 'html', 'css', 'js', 'php', 'java', 'py', 'zip');

    // Check if file size exceeds 10MB
    if ($fileSize > 10 * 1024 * 1024) {
        echo "true";
        exit;
    }

    // Check if file type valid
    if (in_array($fileExt, $allowedExt)) {
        $fileName = str_replace("'", "", $fileName);
        $folderName = 'Topic' . $topic_ID;
        $targetDir = '../../Upload/' . $folderName . '/';
        $targetFile = $targetDir . $fileName;

        // Check if file exists in database
        $query = "SELECT * FROM `file` where file_path ='$targetFile'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // File already exists in database, do not insert again
            echo "true";
        } else {
            // Create new folder if not exists
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            // Move file the corresponding folder
            move_uploaded_file($fileTmpName, $targetFile);

            // Insert file into database
            $sql = "INSERT INTO file (file_name, file_size, file_type, file_path, topic_ID) VALUES ('$fileName', '$fileSize', '$fileType', '$targetFile', '$topic_ID')";
            $conn->query($sql);
            echo $fileName;
            echo 'File uploaded successfully.';
        }

        

    }else {
        echo "true";
    }
} else {
    echo "true";
}
?>
