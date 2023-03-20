<?php
include "../../config.php";
if (isset($_POST["topicid"])) {
    $topic_id = mysqli_real_escape_string($conn, $_POST["topicid"]);

    if ($topic_id != '') {
        //update topic table
        $sql = "INSERT INTO topic (topic_name, topic_description, difficulty_ID, course_ID) SELECT topic_name, topic_description, difficulty_ID, course_ID FROM topic WHERE topic_ID = $topic_id";
        mysqli_query($conn, $sql);

        $query = "SELECT MAX(topic_ID) AS topic_ID FROM topic";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $new_topic_id = $row["topic_ID"];

        $oldfolderName = 'Topic' . $topic_id;
        $newfolderName = 'Topic' . $new_topic_id;
        $sourceFolder = '../../../Upload/' . $oldfolderName;
        $destinationFolder = '../../../Upload/' . $newfolderName;


        // Create the destination folder if it doesn't exist
        if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0777, true);
        }


        // Get all files in the source folder
        $files = scandir($sourceFolder);


        foreach ($files as $file) {
            // Get file info
            $fileName = basename($file);
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

            // Skip . and .. directories
            if ($file == '.' || $file == '..') {
                continue;
            }
            // Get the full path of the source file
            $sourceFile = $sourceFolder . '/' . $file;
            
            // Get the full path of the destination file
            $destinationFile = $destinationFolder . '/' . $file;
            
            // Copy the file to the destination folder
            if (is_file($sourceFile)) {
                copy($sourceFile, $destinationFile);
            }
            $realDestinationFile = '../../Upload/' . $newfolderName . '/' . $file;

            $query = "SELECT * FROM file where topic_ID='$topic_id';";
            $result = $conn->query($query);    

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["file_name"] == $fileName) {
                        $fileSize = $row["file_size"];
                        $fileType = $row["file_type"];
                        break;
                    }
                }
            }

            // Insert file info into MySQL database
            $query = "INSERT INTO file (file_name, file_size, file_type, file_path, topic_ID) VALUES ('$fileName', '$fileSize', '$fileType', '$realDestinationFile', '$new_topic_id')";
            $conn->query($query);

        }
    }
}
?>