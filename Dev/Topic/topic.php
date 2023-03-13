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
  <div id="content-file-add" class="content-file-add" style="display: none;">
    <?php include 'file_add.php'; ?>
  </div>
</div>

<script>
  //Display add file popup
  let addFile = document.querySelector("#file-add");

  addFile.addEventListener("click", () => {
    $("#content-file-add").fadeIn(200);
    document.getElementById("content-file-add").style.display = "block";
  });

  //Close add file popup
  let closeFile = document.querySelector("#file-close-btn");
  closeFile.addEventListener("click", () => {
    $("#content-file-add").fadeOut(200);
    document.getElementById("content-file-add").style.display = "none";
  });

  let cancelFile = document.querySelector("#file-cancel-btn");
  cancelFile.addEventListener("click", () => {
    $("#content-file-add").fadeOut(200);
    document.getElementById("content-file-add").style.display = "none";
  });
</script>