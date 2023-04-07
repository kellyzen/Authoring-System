<?php
include '../config.php';
include '../header.php';
session_start();

$new_password = $confirm_password = "";
$password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['reset_password'])) {
    $user_ID = $_SESSION['user_ID'];

    // Validate password
    $verifypassword = trim($_POST["new_password"]);
    if (empty($verifypassword)) {
        $password_err = "Please enter a password.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',$verifypassword)) {
        $password_err = "Password should be of length 8-20 characters containing at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character (@$!%*?&)";
    } else {
        $new_password = $verifypassword;
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    if (empty($password_err) && empty($confirm_password_err)) {
        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_ID = ?");
        $stmt->bind_param("si", $new_password, $user_ID);
        $stmt->execute();

        unset($_SESSION['user_ID']);
        unset($_SESSION['reset_password']);
        header("Location: ../Login/login.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>stud.io | Reset Password</title>
    <link rel="stylesheet" href="../../Style/Reset/reset.css">
</head>

<body>

    <div class="body">
        <form action="reset_password.php" method="post">
            <label class="centre">Reset Password</label>

            <?php if (isset($error)): ?>
            <div class="error-box">
                <label class="error"><?= $error ?></label>
            </div>
            <?php endif; ?>

            <div>
                <label for="new_password">New Password:</label><br><br>
                <input type="password" name="new_password" id="new_password" placeholder="Enter New Password..." required><br><br>
                <label class="error"><?php echo $password_err; ?></label>
            </div>

            <div>
                <label for="confirm_password">Confirm New Password:</label><br><br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password..." required><br><br>
                <label class="error"><?php echo $confirm_password_err; ?></label>
            </div>

            <div class="button-box">
                <input class="button" type="submit" name="submit1" value="Submit">
            </div>

            <div class="link-box">
                <a href="../Signup/signup.php">Return to Signup page</a>
                <a href="../Login/login.php">Return to Login page</a>
            </div>
        </form>
    </div>
</body>

</html>