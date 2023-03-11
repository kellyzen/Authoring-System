<?php
include_once('../head.php');

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  include '../config.php';
  $query = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
  $count = mysqli_num_rows($query);

  if ($count != '0') {
    $row = mysqli_fetch_array($query);
    $id = $row['course_ID'];
  }
  header('Location: ../?id=' . $id);
} else {
  // Show a jGrowl notification message
  echo "
  <script>
  $.jGrowl('You have been logged out successfully.', {
      header: 'Logout Successful'
  });
  </script>";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studiodb";
// Create connection 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $password = $username_err = $password_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (empty(trim($_POST['username']))) {
    $username_err = 'Incorrect username.';
  } else {
    $username = trim($_POST['username']);
  }

  if (empty(trim($_POST['password']))) {
    $password_err = 'Incorrect password.';
  } else {
    $password = trim($_POST['password']);
  }

  if (empty($username_err) && empty($password_err)) {
    $sql = 'SELECT user_ID, username, password FROM user WHERE username = ?';

    if ($stmt = $conn->prepare($sql)) {
      $param_username = $username;
      $stmt->bind_param('s', $param_username);

      if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $stmt->bind_result($id, $username, $hashed_password);

          if ($stmt->fetch()) {
            if ($password == $hashed_password) {
              $_SESSION['loggedin'] = true;
              $_SESSION['id'] = $id;
              $_SESSION['username'] = $username;

              $query = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
              $count = mysqli_num_rows($query);

              if ($count != '0') {
                $row = mysqli_fetch_array($query);
                $id = $row['course_ID'];
              }
              header('Location: ../Dashboard?id=' . $id);
            } else {
              $password_err = 'Incorrect password.';
            }
          }
        } else {
          $username_err = 'Username not found.';
        }
      } else {
        echo 'An error occurred. Please try again later.';
      }

      $stmt->close();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>stud.io | Login</title>
  <link rel="stylesheet" href="../../Style/Login/login.css">
</head>

<body>
    <div class="body">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label class="centre">Login</label>

        <div <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Enter Username..." value="<?php echo $username ?>">
          <label class="error"><?php echo $username_err; ?></label>
        </div>

        <div <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Enter Password..." value="<?php echo $password ?>">
          <label class="error"><?php echo $password_err; ?></label>
        </div>

        <div class="button-box">
          <input class="button" type="submit" value="Login">
        </div>

        <div class="link-box">
          <a href="../Signup/signup.php">No Account?</a>
          <a href="../ForgotPassword/forgot_password.php">Forgot Password?</a>
        </div>
      </form>
      </section>
  </main>
</body>

</html>