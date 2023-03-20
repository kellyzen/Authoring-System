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

//Toggle security question visibility
function showQ1() {
    var checkbox = document.getElementById('q1Visibility');
    var q = document.getElementById("security-ques1");
    if (checkbox.checked == true) {
        q.type = "text";
    } else {
        q.type = "password";
    }
}

function showQ2() {
    var checkbox = document.getElementById('q2Visibility');
    var q = document.getElementById("security-ques2");
    if (checkbox.checked == true) {
        q.type = "text";
    } else {
        q.type = "password";
    }
}

function showQ3() {
    var checkbox = document.getElementById('q3Visibility');
    var q = document.getElementById("security-ques3");
    if (checkbox.checked == true) {
        q.type = "text";
    } else {
        q.type = "password";
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

// Validate new password
function validateSecurityAns(ansV) {
    // Check if the password meets the length requirement
    if (ansV.length > 0) {
        return true;
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
    var q1 = $('#profile-dropdown-q1').val().trim();
    var q2 = $('#profile-dropdown-q2').val().trim();
    var q3 = $('#profile-dropdown-q3').val().trim();
    var ans1 = $('#security-ques1').val().trim();
    var ans2 = $('#security-ques2').val().trim();
    var ans3 = $('#security-ques3').val().trim();


    if (email != '' || username != '' || firstname != '' || lastname != '' || password != '') {
        if (!validateEmail(email) || !validateUsername(username) || !validateName(firstname) || !validateName(lastname) || !validatePassword(password) || !validateSecurityAns(ans1) || !validateSecurityAns(ans2) || !validateSecurityAns(ans3)) {
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

            if (!validateSecurityAns(ans1)) {
                document.getElementById('q1_err').innerHTML = "Invalid answer";
            } else {
                document.getElementById('q1_err').innerHTML = "";
            }

            if (!validateSecurityAns(ans2)) {
                document.getElementById('q2_err').innerHTML = "Invalid answer";
            } else {
                document.getElementById('q2_err').innerHTML = "";
            }

            if (!validateSecurityAns(ans3)) {
                document.getElementById('q3_err').innerHTML = "Invalid answer";
            } else {
                document.getElementById('q3_err').innerHTML = "";
            }

            if (!validateSecurityAns(ans1) || !validateSecurityAns(ans2) || !validateSecurityAns(ans3)) {
                document.getElementById('q_err').innerHTML = "Invalid answer";
            } else {
                document.getElementById('q_err').innerHTML = "";
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
                    q1: q1,
                    q2: q2,
                    q3: q3,
                    ans1: ans1,
                    ans2: ans2,
                    ans3: ans3,
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