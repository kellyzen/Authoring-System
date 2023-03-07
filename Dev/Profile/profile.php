<?php
$sql = "SELECT * FROM user where username='$_SESSION[username]';";
$result = $conn->query($sql);

$user_ID = "$_SESSION[id]";
$email = $username = $firstname = $lastname = $password = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $email = $row["email"];
        $password = $row["password"];
    }
}

$query = mysqli_query($conn, "SELECT * FROM course where user_ID='$user_ID';");
$count = mysqli_num_rows($query);

if ($count != '0') {
    $row = mysqli_fetch_array($query);
    $id = $row['course_ID'];
}

$cquery = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
$course_count = mysqli_num_rows($cquery);

$tquery = mysqli_query($conn, "SELECT * FROM topic INNER JOIN course ON course.course_ID = topic.course_ID where user_ID='$_SESSION[id]';");
$topic_count = mysqli_num_rows($tquery);
?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-title-box">
            <span class="profile-title">Profile</span>
        </div>
        <div class="profile-action-buttons">
            <button id="dashboardButton" class="profile-action-button action-btn" type="button" onclick="location.href='<?php echo '../Dashboard?id=' . $id; ?>'">
                Back <i class="fal fa-solid fa-arrow-left"></i>
            </button>
            <button id="editButton" class="profile-action-button action-btn" type="button" onclick="editProfile()">
                Edit <i class="fal fa-regular fa-edit"></i>
            </button>
        </div>
    </div>
    <div id="profile-content" class="profile-content">
        <div class="profile-left">
            <div id="profile-edit">
                <div class="profile-edit-box">
                    <span>Email Address</span>
                    <input type="text" value="<?php echo $email; ?>" id="email" name="email" disabled required>
                    <div id="email_err" class="error_text"></div>
                </div>
                <div class="profile-edit-box">
                    <span>Username</span>
                    <input type="text" value="<?php echo $username; ?>" id="username" name="username" disabled required>
                    <div id="username_err" class="error_text"></div>
                </div>
                <div class="profile-edit-box">
                    <div class="profile-edit-name">
                        <div>
                            <span>Firstname</span>
                            <input type="text" value="<?php echo $firstname; ?>" id="firstname" name="firstname" disabled required>
                        </div>
                        <div>
                            <span>Lastname</span>
                            <input type="text" value="<?php echo $lastname; ?>" id="lastname" name="lastname" disabled required>
                        </div>
                    </div>
                    <div id="name_err" class="error_text"></div>

                </div>
                <div class="profile-edit-box">
                    <span>Password</span>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" disabled required>
                    <input type="checkbox" id="pwVisibility" onclick="showPassword()" disabled><span style="font-size: 14px;">Show Password</span>
                    <div id="password_err" class="error_text"></div>
                </div>
            </div>
        </div>
        <div class="profile-right">
            <div class="profile-display-box">
                <i class="fal fa fa-user-circle-o"></i>
                <span id="username-display"><?php echo $username; ?></span>
            </div>
            <hr>
            <div class="profile-display-box">
                <span>No. Course(s)</span>
                <span><?php echo $course_count; ?></span>
            </div>
            <hr>
            <div class="profile-display-box">
                <span>No. Topic(s)</span>
                <span><?php echo $topic_count; ?></span>
            </div>
        </div>
    </div>
</div>

<script>
    //Toggle between edit and save function
    function editProfile() {
        if (document.getElementById("profile-content").classList.contains("profile-edit")) {
            if (saveProfile() == true) {
                //disable edit profile
                document.getElementById('editButton').innerHTML = 'Edit <i class="fal fa-regular fa-edit"></i>';
                document.getElementById("profile-content").classList.remove("profile-edit")
                //disable all inputs
                $("#profile-edit :input").prop("disabled", true);
                //disable show password
                document.getElementById('pwVisibility').checked = false;
                document.getElementById("password").type = "password";
                //enable back button
                document.getElementById("dashboardButton").disabled = false;
                //change username display
                document.getElementById('username-display').innerHTML = $('#username').val();
                //reset error texts
                document.getElementById('email_err').innerHTML = "";
                document.getElementById('username_err').innerHTML = "";
                document.getElementById('name_err').innerHTML = "";
                document.getElementById('password_err').innerHTML = "";
            }

        } else {
            //enable edit profile
            document.getElementById("profile-content").classList.toggle("profile-edit");
            document.getElementById('editButton').innerHTML = 'Save <i class="fal fa-regular fa-save"></i>';
            //enable all inputs
            $("#profile-edit :input").prop("disabled", false);
            //disable back button
            document.getElementById("dashboardButton").disabled = true;
        }
    }

    //Toggle password visibility
    function showPassword() {
        var checkbox = document.getElementById('pwVisibility');
        var pw = document.getElementById("password");
        if (checkbox.checked == true) {
            pw.type = "text";
        } else {
            pw.type = "password";
        }
    }

    // Validate new email
    function validateEmail(emailV) {
        // Email validation rule
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        // Check if the email matches the pattern
        if (emailRegex.test(emailV)) {
            return true;
        } else {
            return false;
        }
    }

    // Validate new username
    function validateUsername(usernameV) {
        // Username validation rule
        const usernameRegex = /^[a-zA-Z0-9]+$/;

        // Check if the username matches the pattern
        if (usernameRegex.test(usernameV)) {
            return true;
        } else {
            return false;
        }
    }

    // Validate new name
    function validateName(nameV) {
        // Name validation rule
        const nameRegex = /^[a-zA-Z]+$/;

        // Check if the name matches the pattern
        if (nameRegex.test(nameV)) {
            return true;
        } else {
            return false;
        }
    }

    // Validate new password
    function validatePassword(passwordV) {
        // Password validation rules
        const pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
        const minLength = 8;
        const maxLength = 20;

        // Check if the password meets the length requirement
        if (passwordV.length >= minLength && passwordV.length <= maxLength) {
            // Check if the password matches the pattern
            if (pwRegex.test(passwordV)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Update profile to database
    function saveProfile() {
        var userid = <?php echo $user_ID ?>;
        var email = $('#email').val().trim();
        var username = $('#username').val().trim();
        var firstname = $('#firstname').val().trim();
        var lastname = $('#lastname').val().trim();
        var password = $('#password').val().trim();

        if (email != '' || username != '' || firstname != '' || lastname != '' || password != '') {
            if (!validateEmail(email) || !validateUsername(username) || !validateName(firstname) || !validateName(lastname) || !validatePassword(password)) {
                if (!validateEmail(email)) {
                    document.getElementById('email_err').innerHTML = "Invalid email address!";
                } else {
                    document.getElementById('email_err').innerHTML = "";
                }

                if (!validateUsername(username)) {
                    document.getElementById('username_err').innerHTML = "Invalid username!";
                } else {
                    document.getElementById('username_err').innerHTML = "";
                }

                if (!validateName(firstname) || !validateName(lastname)) {
                    document.getElementById('name_err').innerHTML = "Invalid firstname or lastname!";
                } else {
                    document.getElementById('name_err').innerHTML = "";
                }

                if (!validatePassword(password)) {
                    document.getElementById('password_err').innerHTML = "Password should be of length 8-20 characters containing at least 1 lowercase letter, 1 uppercase letter, 1 digit and 1 special character (@$!%*?&)";
                } else {
                    document.getElementById('password_err').innerHTML = "";
                }
                return false;
            } else {
                $.ajax({
                    url: '../Profile/profile_update.php',
                    type: 'post',
                    data: {
                        userid: userid,
                        email: email,
                        username: username,
                        firstname: firstname,
                        lastname: lastname,
                        password: password,
                    },
                    success: function(html) {
                        if (html == "true") {
                            $.jGrowl("Profile Invalid", {
                                header: 'Update Profile Failed'
                            });
                        } else {
                            $.jGrowl("Profile Successfully  Updated", {
                                header: 'Profile Updated'
                            });
                            var delay = 2000;
                            setTimeout(function() {
                                window.location = ''
                            }, delay);
                        }
                    }
                });
                return true;
            }
        }
    }
</script>