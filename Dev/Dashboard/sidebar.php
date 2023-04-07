<?php
include '../session.php';
include '../config.php';
$id="";

$query = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
$count = mysqli_num_rows($query);
?>

<div class="sidebar">
  <div class="header-box">
    <span class="header">Your course(s)</span>
    <span class="course-badge"><?php echo $count; ?></span>
  </div>

  <ul id="course-lists" class="course-lists list-unstyled">
    <?php
    if ($count != '0') {
      while ($row = mysqli_fetch_array($query)) {
        $id = $row['course_ID'];

        if ($id == $_GET['id']) { ?>
          <li class="course active"><?php
        } else { ?>
          <li class="course"><?php
        }?>
          <a href="<?php echo '?id='.$id; ?>" class="course-list text-decoration-none d-block">
            <span class="course-title">
              <i class="fal fa-regular fa-book"></i>
              <?php echo $row['c_name']; ?>
            </span>
          </a>
        </li>
    <?php
      }
    }
    ?>
  </ul>

  <ul id="course-add" class="course-add list-unstyled user-view">
    <li class=""><a class="text-decoration-none d-flex justify-content-between">Add course<i class="fal fa-solid fa-plus"></i></a></li>
  </ul>

</div>