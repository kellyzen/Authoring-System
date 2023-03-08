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
    $firstname_err = "Please enter your first name.";
  } else {
    $firstname = trim($_POST["firstname"]);
  }

  // Validate last name
  if (empty(trim($_POST["lastname"]))) {
    $lastname_err = "Please enter your last name.";
  } else {
    $lastname = trim($_POST["lastname"]);
  }

  // Validate username

  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
  }  elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
  }  else {
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
    $email_err = "Please enter your email address.";
  } elseif(!(str_contains($verifyemail, '@'))){ 
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
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 8) {
    $password_err = "Password must have at least 8 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirmpassword"]))) {
    $confirm_password_err = "Please confirm password.";
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
  <title>Sign-Up</title>
  <head>
  <meta charset="UTF-8">
  <title>stud.io | Login</title>
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

.button {
background: #FF3838;
border: 1px solid #FF3838;
border-radius: 8px;
box-sizing: border-box;
display: block;
width: 75%;
padding: 10px;
margin: 10px auto;
color: #fff;
}

form {
width: 1000px;
height: 1000px;
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
margin-left:130px; 
}

.centre {
    display: block;
    text-align: center;
    font-size: 48px;
    margin-left: 0px;
    margin-top: 15px;
}

.error {
  font-family: 'Montserrat';
   font-size: 14px;
   color: #D8000C;
}


input::placeholder, a {
font-family: 'Montserrat';
font-style: italic;
font-weight: 400;
font-size: 24px;
color: #666666;
}


input[type=text], input[type=password], input[type=email]  {
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


</style>
</head>


<body>
  <div class="body">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label class="centre" >Signup</label><br><br>
      <div <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
        <label>First Name</label>
        <input class="inputfield" type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
        <label class="error"><?php echo $firstname_err; ?></label><br><br>

      </div>
      <div <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
        <label>Last Name</label>
        <input class="inputfield" type="text" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
        <label class="error"><?php echo $lastname_err; ?></label><br><br>
        
      </div>
      <div <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Username</label>
        <input class="inputfield" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
        <label class="error"><?php echo $username_err; ?></label><br><br>
       
      </div>
      <div <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
        <label>Email</label>
        <input class="inputfield" type="text" name="email" placeholder="Email" value="<?php echo $email; ?>">
        <label class="error"><?php echo $email_err; ?></label><br><br>

      </div>
      <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Password</label>
        <input class="inputfield" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>">
        <label class="error"><?php echo $password_err; ?></label><br><br>
        
      </div>
      <div <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label>Confirm Password</label>
        <input class="inputfield" type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $password; ?>">
        <label class="error"><?php echo $confirmpassword_err; ?></label><br><br>
       
      </div>
      <div>
        <input style="font-size: 25px;" class="button" type="submit" value="Submit">
      </div>
      <a style="margin-left:130px; color: white" href="login.php">Already a member? Log-in...</a>
    </form>
  </div>
</body>
</html>