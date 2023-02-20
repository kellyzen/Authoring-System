<head>
  <meta charset="UTF-8">
  <title>stud.io</title>
</head>

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
    include 'Dashboard/course_invalid.php';
  }
  ?>
  <div id="content-course-add" class="content-course-add" style="display: none;">
    <?php include 'course_add.php'; ?>
  </div>
</div>

<script>
  //Display add course popup
  let addCourse = document.querySelector("#course-add");

  addCourse.addEventListener("click", () => {
    $("#content-course-add").fadeIn(200);
    document.getElementById("content-course-add").style.display = "block";
  });

  //Close add course popup
  let closeCourse = document.querySelector("#close-btn");
  closeCourse.addEventListener("click", () => {
    $("#content-course-add").fadeOut(200);
    document.getElementById("content-course-add").style.display = "none";
  });

  let cancelCourse = document.querySelector("#cancel-btn");
  cancelCourse.addEventListener("click", () => {
    $("#content-course-add").fadeOut(200);
    document.getElementById("content-course-add").style.display = "none";
  });
</script>