<?php
include '../config.php';
include '../header.php';
include_once('../head.php');
session_start();
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
  $email = $_POST['email'];

  $stmt = $conn->prepare("SELECT user_ID FROM user WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      $_SESSION['user_ID'] = $user['user_ID'];
      $_SESSION['email'] = $email;
      header("Location: ../ForgotPassword/verification.php");
  } else {
      $error_message = "Email not found in our records."; 
  }
} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>stud.io | Forgot Password</title>
  <link rel="stylesheet" href="../../Style/Reset/reset.css">
  
</head>

<body>
  <div class="body">
    <form action="forgot_password.php" method="post">
      <label class="centre">Forgot Password</label>

      <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter email eddress..." required>
        <label class="error" role="alert"><?php echo $error_message; ?></label>
        
      </div>

      <div class="button-box">
        <input class="button" type="submit" name="submit" value="Submit">
      </div>

      <div class="link-box">
        <a href="../Signup/signup.php">No account?</a>
        <a href="../Login/login.php">Already a member? Log in...</a>
      </div>
    </form>
  </div>
</body>

</html>