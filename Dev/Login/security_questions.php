<?php
include '../config.php';
include '../header.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  $query = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
  $count = mysqli_num_rows($query);

  if ($count != '0') {
    $row = mysqli_fetch_array($query);
    $id = $row['course_ID'];
  }
} else {
  // Show a jGrowl notification message
  echo "
  <script>
  $.jGrowl('You have been logged out successfully.', {
      header: 'Logout Successful'
  });
  </script>";
}

$ques1_ID = $ques2_ID = $ques3_ID = "";
$ques1_ans = $ques2_ans = $ques3_ans = "";
$ques1_err = $ques2_err = $ques3_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate security question selections and answers
  if (empty(trim($_POST["ques1_ID"])) || empty(trim($_POST["ques1_ans"]))) {
    $ques1_err = "Please select a question and provide an answer.";
  } else {
    $ques1_ID = trim($_POST["ques1_ID"]);
    $ques1_ans = trim($_POST["ques1_ans"]);
  }

  if (empty(trim($_POST["ques2_ID"])) || empty(trim($_POST["ques2_ans"]))) {
    $ques2_err = "Please select a question and provide an answer.";
  } else {
    $ques2_ID = trim($_POST["ques2_ID"]);
    $ques2_ans = trim($_POST["ques2_ans"]);
  }

  if (empty(trim($_POST["ques3_ID"])) || empty(trim($_POST["ques3_ans"]))) {
    $ques3_err = "Please select a question and provide an answer.";
  } else {
    $ques3_ID = trim($_POST["ques3_ID"]);
    $ques3_ans = trim($_POST["ques3_ans"]);
  }

  // Check input errors before inserting into database
if (empty($ques1_err) && empty($ques2_err) && empty($ques3_err)) {
  // Prepare an insert statement
  $sql = 'INSERT INTO user_security (ques1_ID, ques2_ID, ques3_ID, ques1_ans, ques2_ans, ques3_ans, security_ID, user_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

  if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iiisssii", $param_ques1_ID, $param_ques2_ID, $param_ques3_ID, $param_ques1_ans, $param_ques2_ans, $param_ques3_ans, $param_security_ID, $param_user_ID);

    // Set parameters
    $param_ques1_ID = $ques1_ID;
    $param_ques2_ID = $ques2_ID;
    $param_ques3_ID = $ques3_ID;
    $param_ques1_ans = $ques1_ans;
    $param_ques2_ans = $ques2_ans;
    $param_ques3_ans = $ques3_ans;
    $param_user_ID = $_SESSION['id']; // Get the user_ID from the session
    $param_security_ID = $param_user_ID;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
      //Redirect to dashboard page
      header('Location: ../Dashboard?id=' . $id);
    } else {
      echo "Something went wrong. Please try again later.";
    }
  }
}

// Close connection
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>stud.io | Security Questions</title>
    <link rel="stylesheet" href="../../Style/Login/login.css">
</head>

<body>
    <div class="body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="centre">Security Questions</label><br>
            <label>Please select and answer three security questions:</label><br><br>

            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div <?php echo (!empty(${"ques{$i}_err"})) ? 'has_error' : ''; ?>>
                    <label for="ques<?= $i ?>_ID">Question <?= $i ?> : </label><br><br>
                    <select name="ques<?= $i ?>_ID" id="ques<?= $i ?>_ID"><br><br>
                        <option value="">Select a question...</option>
                        <?php for ($j = ($i - 1) * 6 + 1; $j <= $i * 6; $j++): ?>
                            <?php
                            $stmt = $conn->prepare("SELECT question FROM security_ques WHERE ques_ID = ?");
                            $stmt->bind_param("i", $j);
                            $stmt->execute();
                            $question = $stmt->get_result()->fetch_assoc()["question"];
                            ?>
                            <option value="<?= $j ?>"><?= $question ?></option>
                        <?php endfor; ?>
                    </select>
                    <label class="error"><?php echo ${"ques{$i}_err"}; ?></label><br><br>
                    <input type="text" name="ques<?= $i ?>_ans" id="ques<?= $i ?>_ans" placeholder="Enter answer..." value="<?php echo ${"ques{$i}_ans"}; ?>"><br><br>
                </div>
            <?php endfor; ?>

            <div class="button-box">
                <input class="button" type="submit" value="Submit">
            </div>
        </form>
    </div>
</body>

</html>