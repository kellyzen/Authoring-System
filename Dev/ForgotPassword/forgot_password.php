<!DOCTYPE html>
<html>

<head>
    <title>stud.io | Forgot Password</title>
    <!-- Include Bootstrap CSS and JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-DmY9Wu2aKs7vFb1TU2nRp2n4DouUGTlvpfwBk5Kg /QG6jmxhXk49j5g06U6ikJX" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php include_once('../head.php');?>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Forgot Password</h1>
        <form id="forgotPasswordForm">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Include JavaScript to handle form submission -->
    <script>
        $(document).ready(function() {
            $('#forgotPasswordForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                //var email = $('#email').val();

                $.ajax({
                    url: 'forgot_password_handler.php',
                    type: 'POST',
                    data: {
                        formData,
                    },
                    success: function(response) {
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'An email with instructions to reset your password has been sent to your email address.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../Login/login.php';
                            }
                        });
                    },
                    error: function() {
                        // Show error message
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error sending the email. Please try again later.',
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