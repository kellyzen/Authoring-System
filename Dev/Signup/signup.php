<?php
include '../config.php';
// Define variables and initialize with empty values
$firstname = $lastname = $username = $email = $password = $confirm_password = "";
$firstname_err = $lastname_err = $username_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate first name
  if (empty(trim($_POST["firstname"]))) {
    $firstname_err = "Please enter your first name.";
  } else {
    $firstname = trim($_POST["firstname"]);
  }

  // Validate last name
  if (empty(trim($_POST["last_name"]))) {
    $lastname_err = "Please enter your last name.";
  } else {
    $lastname = trim($_POST["last_name"]);
  }

  // Validate username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  } 
  elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
  }
  else {
    // Prepare a select statement
    $sql = "SELECT user_ID FROM user WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("s", $param_username);
      $param_username = trim($_POST["username"]);

      if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $username_err = "This username is already taken.";
        } else {
          $username = trim($_POST["username"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      $stmt->close();
    }
  }

  // Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter your email address.";
  } else {
    // Prepare a select statement
    $sql = "SELECT user_ID FROM user WHERE email = ?";

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param("s", $param_email);
      $param_email = trim($_POST["email"]);

      if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
          $email_err = "This email address is already registered.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      $stmt->close();
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 8) {
    $password_err = "Password must have at least 8 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
    $confirm_password_err = "Password did not match.";
  }
  }

  // Check input errors before inserting into database
if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
  // Prepare an insert statement
$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

if ($stmt = mysqli_prepare($link, $sql)) {
  // Bind variables to the prepared statement as parameters
  mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

  // Set parameters
  $param_username = $username;
  $param_email = $email;
  $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

  // Attempt to execute the prepared statement
  if (mysqli_stmt_execute($stmt)) {
    // Redirect to login page
    header("location: login.php");
  } else {
    echo "Something went wrong. Please try again later.";
  }

  // Close statement
  mysqli_stmt_close($stmt);
}
}

// Close connection
mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sign-Up</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="wrapper">
    <h2>Sign-Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
        <label>First Name</label>
        <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstname; ?>">
        <span class="help-block"><?php echo $firstname_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $lastname; ?>">
        <span class="help-block"><?php echo $lastname_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
        <span class="help-block"><?php echo $email_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo $password; ?>">
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
      </div>
      <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
  </div>
</body>
</html>