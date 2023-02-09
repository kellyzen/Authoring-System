<?php
  session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: welcome.php');
    exit;
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
      $sql = 'SELECT id, username, password FROM users WHERE username = ?';

      if ($stmt = $mysql_db->prepare($sql)) {
        $param_username = $username;
        $stmt->bind_param('s', $param_username);

        if ($stmt->execute()) {
          $stmt->store_result();

          if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $username, $hashed_password);

            if ($stmt->fetch()) {
              if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                header('Location: welcome.php');
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

      $mysql_db->close();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="" rel="stylesheet">
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
            <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
              <span class="help-block"><?php echo $username_err;?></span>
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
              <span class="help-block"><?php echo $password_err;?></span>
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
