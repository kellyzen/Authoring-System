<?php
include "../config.php";
if (isset($_POST["email"])) {
	// Get email address from form data
	$email = $_POST['email'];
	//$email = mysqli_real_escape_string($conn, $_POST['email']);

// Check if email exists in database
$stmt = $conn->prepare('SELECT user_ID FROM user WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
	// Generate unique reset password token
	$resetPasswordToken = "1234";

	// Save reset password token, email address, and time in database
	$stmt = $conn->prepare('INSERT INTO reset_password_tokens (user_ID, token, created_at) VALUES (?, ?, ?)');
	$stmt->execute([$user['user_ID'], $resetPasswordToken, date('Y-m-d H:i:s')]);

	// Send email with reset password link
	$resetPasswordLink = 'http://example.com/reset_password.php?token=' . $resetPasswordToken;
	$subject = 'Reset Your Password';
	$message = "Hello,\r\n\r\nYou have requested to reset your password. Please click the link below to reset your password:\r\n\r\n$resetPasswordLink\r\n\r\nIf you did not request this, please ignore this email.\r\n\r\nThanks,\r\nExample.com";
	$headers = 'From: example@example.com' . "\r\n" .
	    'Reply-To: example@example.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	if (mail($email, $subject, $message, $headers)) {
		// Email sent successfully
		echo 'success';
	} else {
		// Email failed to send
		echo 'error';
	}
} else {
	// Email does not exist in database
	echo 'not_found';
}
}
?>