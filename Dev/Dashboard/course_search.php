<?php
include '../config.php';

  // Get the search query
  $result = $_GET['q'];
  $user_id = $_GET['userid'];
  $course_id = $_GET['courseid'];
  $query = mysqli_query($conn, "SELECT * FROM course where user_ID='$user_id' AND (c_name like '%$result%' OR c_description like '%$result%');");
  $count = mysqli_num_rows($query);

  // Display the search results
    if ($count != '0') {
      while ($row = mysqli_fetch_array($query)) {
        $id = $row['course_ID'];

        if ($id == $course_id) {
            echo '<li class="course active">';
          
        } else {
            echo '<li class="course">';
        }
        echo "
          <a href='?id=";echo $id;echo "' class='course-list text-decoration-none d-block'>
            <span class='course-title'>
              <i class='fal fa-regular fa-book'></i>
        ";
        echo $row['c_name'];
        echo "
            </span>
          </a>
        </li>
        ";
      }
    }
?>
