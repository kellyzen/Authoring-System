<div id="topic-content" class="topic-content">
<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$query = mysqli_query($conn, "SELECT * FROM `file` where topic_ID='$get_id';");
$count = mysqli_num_rows($query);

if ($count != '0') { ?>
    <div class="tab-pane fade show active" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">Document</div>
    <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">Video</div>
    <div class="tab-pane fade" id="nav-audio" role="tabpanel" aria-labelledby="nav-audio-tab">Audio</div>
    <div class="tab-pane fade" id="nav-text" role="tabpanel" aria-labelledby="nav-text-tab">Text</div> 
    <div class="tab-pane fade" id="nav-quiz" role="tabpanel" aria-labelledby="nav-quiz-tab">Quiz</div> 
<?php } else {
    include 'file_invalid.php';
}
?>
</div>