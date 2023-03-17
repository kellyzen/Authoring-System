<div class="content d-flex">
  <?php
  include '../session.php';
  include '../config.php';

  $get_id = $_GET['id'];
  $user_ID = "$_SESSION[id]";

  $sql = "SELECT * FROM course where user_ID='$user_ID' AND course_ID='$get_id';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    include 'sidebar.php';
    include 'course.php';
  } else {
    include 'course_invalid.php';
  }
  ?>
  <div id="content-course-add" class="content-course-add" style="display: none;">
    <?php include 'course_popup.php'; ?>
  </div>
  <div id="content-topic-add" class="content-topic-add" style="display: none;">
    <?php include 'topic_popup.php'; ?>
  </div>
</div>

<script type="text/javascript" src="dashboard.js"></script> 