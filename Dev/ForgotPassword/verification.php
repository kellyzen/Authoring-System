<?php
include '../config.php';
include '../header.php';
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
            <label class="centre">Security Questions Verification</label><br><br>
            
            <?php if (!empty($error_message)): ?>
                <div class="error" role="alert">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>
            
            <input type="hidden" name="email" value="<?= $email ?>">

            <?php for ($i = 1; $i <= 3; $i++): ?>
                <?php
                $stmt = $conn->prepare("SELECT question FROM security_ques WHERE ques_ID = ?");
                $stmt->bind_param("i", $security["ques{$i}_ID"]);
                $stmt->execute();
                $question = $stmt->get_result()->fetch_assoc()["question"];
                ?>
                <div>
                    <label for="answer<?= $i ?>">Question <?= $i ?>: <?= $question ?></label><br><br>
                    <input type="text" name="answer<?= $i ?>" id="answer<?= $i ?>" placeholder="Enter Answer..." required><br><br>
                </div>
            <?php endfor; ?>

            <div class="button-box">
                <input class="button" type="submit" name="submit" value="Submit">
            </div>

            <div class="link-box">
                <a href="../Signup/signup.php">Return to Signup page</a>
                <a href="../Login/login.php">Return to Login page</a>
            </div>
        </form>
    </div>
</body>

</html>