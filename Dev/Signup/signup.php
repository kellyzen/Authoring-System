<?php
include '../config.php';
session_start();

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
// Define variables and initialize with empty values

$firstname = $lastname = $username = $email = $password = $confirmpassword = "";
$firstname_err = $lastname_err = $username_err = $email_err = $password_err = $confirmpassword_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate first name
  if (empty(trim($_POST["firstname"]))) {
    $firstname_err = "Incorrect first name.";
  } else {
    $firstname = trim($_POST["firstname"]);
  }

  // Validate last name
  if (empty(trim($_POST["lastname"]))) {
    $lastname_err = "Incorrect last name.";
  } else {
    $lastname = trim($_POST["lastname"]);
  }

  // Validate username
  if (empty(trim($_POST["username"]))) {
    $username_err = "Incorrect username.";
  } elseif (!preg_match('/^[a-zA-Z0-9]+$/', trim($_POST["username"]))) {
    $username_err = "Username can only contain letters, numbers, and underscores.";
  } else {
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
  $verifyemail = trim($_POST["email"]);
  if (empty(trim($_POST["email"]))) {
    $email_err = "Incorrect email address.";
  } elseif (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/',$verifyemail)) {
    $email_err = "Invalid email address";
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
  $verifypassword = trim($_POST["password"]);
  if (empty($verifypassword)) {
    $password_err = "Incorrect password.";
  } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',$verifypassword)) {
    $password_err = "Password should be of length 8-20 characters containing at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character (@$!%*?&)";
  } else {
    $password = $verifypassword;
  }

  // Validate confirm password
  if (empty(trim($_POST["confirmpassword"]))) {
    $confirmpassword_err = "Incorrect password.";
  } else {
    $confirmpassword = trim($_POST["confirmpassword"]);
    if (empty($password_err) && ($password != $confirmpassword)) {
      $confirmpassword_err = "Password did not match.";
    }
  }


  //   // Check input errors before inserting into database
  if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirmpassword_err)) {
    // Prepare an insert statement
    $sql = 'INSERT INTO user (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)';


    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sssss", $param_firstname, $param_lastname, $param_username, $param_email, $param_password);

      // Set parameters
      $param_firstname = $firstname;
      $param_lastname = $lastname;
      $param_username = $username;
      $param_email = $email;
      $param_password = $password;

      // Attempt to execute the prepared statement
      if ((mysqli_stmt_execute($stmt)) && empty($username_err) && empty($email_err) && empty($password_err) && empty($confirmpassword_err)) {
        //Redirect to login page
        header("location: ../Login/login.php");
        echo "Registartion completed. Please login to access your account.";
      } else {
        echo "Something went wrong. Please try again later.";
      }

      // Close statement
      // mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>stud.io | Sign-Up</title>
  <?php include '../head.php'; ?>
  <link rel="stylesheet" href="../../Style/Signup/signup.css">
</head>


<body>
  <div class="body">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label class="title centre">Sign-Up</label>
      <div class="signup-content">
        <div class="signup-box">
          <div class="input-field left" <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label class="input-title">First Name</label>
            <input class="inputfield" type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
            <label class="error"><?php echo $firstname_err; ?></label>

          </div>
          <div class="input-field right" <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
            <label class="input-title">Last Name</label>
            <input class="inputfield" type="text" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
            <label class="error"><?php echo $lastname_err; ?></label>

          </div>
        </div>
        <div class="signup-box">
          <div class="input-field left" <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label class="input-title">Username</label>
            <input class="inputfield" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            <label class="error"><?php echo $username_err; ?></label>

          </div>
          <div class="input-field right" <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <labe class="input-title" l>Email</label>
              <input class="inputfield" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
              <label class="error"><?php echo $email_err; ?></label>

          </div>
        </div>
        <div class="signup-box">
          <div class="input-field left" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label class="input-title">Password</label>
            <input class="inputfield" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
            <label class="error"><?php echo $password_err; ?></label>

          </div>
          <div class="input-field right" <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label class="input-title">Confirm Password</label>
            <input class="inputfield" type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $password; ?>">
            <label class="error"><?php echo $confirmpassword_err; ?></label>

          </div>
        </div>
      </div>
      <div class="button-field">
        <input class="button" type="submit" value="Sign-up">
      </div>
      <a class="link centre" href="../Login/login.php">Already a member? Log in...</a>
    </form>
  </div>
</body>

</html>