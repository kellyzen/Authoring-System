<!DOCTYPE html>
<html>

<head>
    <title>stud.io | Reset Password</title>
    <!-- Include Bootstrap CSS and JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-DmY9Wu2aKs7vFb1TU2nRp2n4DouUGTlvpfwBk5Kg /QG6jmxhXk49j5g06U6ikJX" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container">
        <h1>Reset Password</h1>
        <form id="resetPasswordForm" method="post">
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
    <!-- Include Bootstrap and SweetAlert2 JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('#resetPasswordForm').on('submit', function(e) {
                e.preventDefault();
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();
                var token = '<?php echo $_GET['token']; ?>';
                if (password != confirmPassword) {
                    Swal.fire({
                        title: 'Passwords do not match!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'reset_password_handler.php',
                    data: {
                        password: password,
                        token: token
                    },
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'Password reset successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = 'login.php';
                            });
                        } else if (response == 'error') {
                            Swal.fire({
                                title: 'Error resetting password!',
                                text: 'There was an error resetting your password. Please try again later.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else if (response == 'invalid_token') {
                            Swal.fire({
                                title: 'Invalid token!',
                                text: 'The reset password token is invalid. Please try again.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }).then(function() {
                                window.location.href = 'forgot_password.php';
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error resetting password!',
                            text: 'There was an error resetting your password. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>