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
  <link rel="text/stylesheet" href="../../Style/Login/login.css">
</head>
<?php include '../head.php'; ?>
  
<style>

.body {
background: #464646;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
flex-direction: column;
}

form {
width: 1000px;
height: 550px;
padding: 20px;
background: #363636;
border-radius: 8px;
}

label {
font-family: 'Montserrat';
font-style: normal;
font-weight: 600;
font-size: 32px;
line-height: 10px;
color: #CCCCCC;
margin-left:120px; 
}

input[type=text], input[type=password]  {

font-family: 'Montserrat';
font-style: italic;
font-weight: 600;
font-size: 25px;
height: 50px;
background:  #464646;
border: 2px solid #666666;
border-radius: 2px;
box-sizing: border-box;
display: block;
width: 75%;
padding: 5px;
/* margin: 0px auto; */
margin-left:120px; 
color: white;

}

.button {

background: #FF3838;
border: 1px solid #FF3838;
border-radius: 8px;
box-sizing: border-box;
display: block;
width: 75%;
padding: 10px;
/* margin: 10px auto; */
margin-left:120px; 
color: #fff;

}

input::placeholder, a {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
font-size: 24px;
color: #666666;
}



/* ::placeholder { 
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
font-size: 24px; 
line-height: 29px;
color: blue;
} */

.centre {
    display: block;
    text-align: center;
    font-size: 48px;
    margin-left: 0px;
    margin-top: 15px;
}

</style>
</head>

<body>
  <main>
    <div class="body">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
      <label class="centre" >Login</label><br><br>

        <div <?php (!empty($username_err)) ? 'has_error' : ''; ?>">
          <label for="username">Username</label><br><br>
          <input type="text" name="username" id="username" placeholder="Enter Username..." value="<?php echo $username ?>"><br><br>
          <!-- <span ><?php echo $username_err; ?></span> -->
        </div>

        <div <?php (!empty($password_err)) ? 'has_error' : ''; ?>">
          <label for="password">Password</label><br><br>
          <input type="password" name="password" id="password" placeholder="Enter Password..." value="<?php echo $password ?>"><br><br>
          <!-- <span ><?php echo $password_err; ?></span> -->
        </div>

        <div>
          <input style="font-size: 25px;" class="button" type="submit" value="Login">
        </div>
        
        <a style="margin-left:130px; color: white" href="../Register/register.php">No Account</a>
        <a style="margin-right:130px; float:right; color: white" href="../Reset/reset.php">Forgot Password?</a>
      </form>
    </section>
  </main>
</body>

</html>