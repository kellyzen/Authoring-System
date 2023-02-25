<div class="content d-flex">
  <?php
  include '../session.php';
  include '../config.php';

  $get_id = $_GET['id'];
  $user_ID = "$_SESSION[id]";

  $sql = "SELECT * FROM topic INNER JOIN course ON course.course_ID = topic.course_ID where user_ID='$user_ID' AND topic_ID='$get_id';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    include 'content.php';
  } else {
    include 'topic_invalid.php';
  }
  ?>
</div>