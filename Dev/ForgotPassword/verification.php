<?php
include '../config.php';
include '../header.php';
include_once('../head.php');
session_start();

$stmt = $conn->prepare("SELECT * FROM user_security WHERE user_ID = ?");
$stmt->bind_param("i", $_SESSION['user_ID']);
$stmt->execute();
$security = $stmt->get_result()->fetch_assoc();

// Process verification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $correct = true;

    for ($i = 1; $i <= 3; $i++) {
        // Check if the answer key exists in the $_POST array before accessing it
        $answer = isset($_POST["answer{$i}"]) ? $_POST["answer{$i}"] : '';
        $stored_answer = $security["ques{$i}_ans"];

        if ($answer !== $stored_answer) {
            $correct = false;
            break;
        }
    }

    if ($correct) {
        $_SESSION['reset_password'] = true;
        header("Location: ../ForgotPassword/reset_password.php");
        exit;
    } else {
        $error_message = "One or more answers are incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>stud.io | Verification</title>
    <link rel="stylesheet" href="../../Style/Reset/reset.css">
</head>

<body>
    <div class="body">
        <form action="verification.php" method="post">
            <label class="centre">Security Questions Verification</label>
            
            <?php if (!empty($error_message)): ?>
                <div class="error" role="alert">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>

            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php
                $stmt = $conn->prepare("SELECT question FROM security_ques WHERE ques_ID = ?");
                $stmt->bind_param("i", $security["ques{$i}_ID"]);
                $stmt->execute();
                $question = $stmt->get_result()->fetch_assoc()["question"];
                ?>
                <div class="sec_ques">
                    <label for="answer<?= $i ?>">Question <?= $i ?>: <?= $question ?></label>
                    <input type="text" name="answer<?= $i ?>" id="answer<?= $i ?>" placeholder="Enter Answer..." required>
                </div>
            <?php endfor; ?>

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