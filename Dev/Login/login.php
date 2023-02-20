<?php
include '../head.php'; 
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
    $username_err = 'Please enter a username.';
  } else {
    $username = trim($_POST['username']);
  }

  if (empty(trim($_POST['password']))) {
    $password_err = 'Please enter your password.';
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
              header('Location: ../?id=' . $id);
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
  <?php include '../head.php'; ?>
  <link rel="stylesheet" href="../../Style/Login/login.css">
  <style>
    .wrapper {
      width: 500px;
      padding: 20px;
    }

    .wrapper h2 {
      text-align: center;
    }

    .wrapper form .form-group span {
      color: red;
    }
  </style>
</head>

<body>
  <main>
    <section class="container wrapper">
      <h2 class="display-4 pt-3">Login</h2>
      <p class="text-center">Please fill this form to create an account.</p>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

        <div class="form-group <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
          <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
          <span class="help-block"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-block btn-outline-primary" value="login">
        </div>
        
        <p>Don't have an account? <a href="register.php">Sign in</a>.</p>
      </form>
    </section>
  </main>
</body>

</html>