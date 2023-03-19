<?php
include '../config.php';

// Get the search query
$result = $_GET['q'];
$user_id = $_GET['userid'];
$topic_id = $_GET['topicid'];
$query = mysqli_query($conn, "SELECT * FROM `file` where topic_ID='$topic_id' AND file_name like '%$result%' ORDER BY file_ID DESC;");
$count = mysqli_num_rows($query);

// Display the search results
if ($count != '0') {
    while ($row = mysqli_fetch_array($query)) {
        $file_id = $row["file_ID"];
        $file_name = $row["file_name"];
        $file_size = $row["file_size"];
        $file_type = $row["file_type"];
        $file_path = $row["file_path"];

        $image_array = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
        $doc_array = array('application/pdf', 'text/plain', 'text/html', 'text/css', 'text/js', 'text/php', 'text/java', 'text/py');
        $audio_array = array('audio/x-m4a', 'audio/mpeg');
        $vid_array = array('video/mp4');

        if (in_array($file_type, $image_array)) {
            $file_svg = "svg-image";
        } else  if (in_array($file_type, $doc_array)) {
            $file_svg = "svg-document";
        } else  if (in_array($file_type, $audio_array)) {
            $file_svg = "svg-audio";
        } else  if (in_array($file_type, $vid_array)) {
            $file_svg = "svg-video";
        } else {
             $file_svg = "svg-folder";
        }
        echo "
        <div class='topic-file'>
                <a href="; echo $file_path; echo "' target='_blank'>
                    <span class='svg "; echo $file_svg; echo "'></span>
                    <span class='topic-file-group'>
                        <span class='topic-file-title'>"; echo $file_name; echo "</span>
                    </span>
                </a>
                <i class='fal fa-solid fa-ellipsis-h user-view' onclick='toggleFileDropdown("; echo $file_id; echo ")'></i>
                <div class='file-dropdown'>
                    <div id='file_ID";echo $file_id; echo"' class='file-dropdown-content'>
                        <span id='delete-file-btn' class='file-dropdown-box' data-id='"; echo $file_id; echo "' onclick='deleteFile("; echo $file_id; echo ")'>
                            <span>Delete</span>
                            <i class='fal fa-solid fa-trash'></i>
                        </span>
                        <a href='"; echo $file_path; echo "' target='_blank' id='view-file-btn' class='file-dropdown-box'>
                            <span>View</span>
                            <i class='fal fa-solid fa-eye'></i>
                        </a>
                    </div>
                </div>
            </div>
        ";
    }
}
