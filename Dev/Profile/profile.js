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
    var userid = $('#user_ID').val().trim();
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
                success: function (html) {
                    if (html == "true") {
                        $.jGrowl("Profile Invalid", {
                            header: 'Update Profile Failed'
                        });
                    } else {
                        $.jGrowl("Profile Successfully  Updated", {
                            header: 'Profile Updated'
                        });
                        var delay = 2000;
                        setTimeout(function () {
                            window.location = ''
                        }, delay);
                    }
                }
            });
            return true;
        }
    }
}