<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$query = mysqli_query($conn, "SELECT * FROM `file` where topic_ID='$get_id';");
$count = mysqli_num_rows($query);

if ($count != '0') { ?>
    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab"><?php include 'file_all.php'; ?></div>
    <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">Document</div>
    <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab"><?php include 'file_video.php'; ?></div>
    <div class="tab-pane fade" id="nav-audio" role="tabpanel" aria-labelledby="nav-audio-tab">Audio</div>
    <div class="tab-pane fade" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">Image</div>
    <div class="tab-pane fade" id="nav-text" role="tabpanel" aria-labelledby="nav-text-tab">Text</div> 
    <div class="tab-pane fade" id="nav-quiz" role="tabpanel" aria-labelledby="nav-quiz-tab">Quiz</div> 
<?php } else {
    include 'file_invalid.php';
}
?>