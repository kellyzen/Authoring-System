<head>
  <meta charset="UTF-8">
  <title>stud.io</title>
</head>

<div class="content d-flex">
  <?php include 'sidebar.php'; ?>
  <?php include 'course.php'; ?>
  <div id="content-course-add" class="content-course-add" style="display: none;">
    <?php include 'add_course.php'; ?>
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