<div class="profile-container">
    <div class="profile-header">
        <div class="profile-title-box">
            <span class="profile-title">Profile</span>
        </div>
        <div class="profile-action-buttons">
            <button id="dashboard" class="profile-action-button action-btn" type="button">
                Back <i class="fal fa-solid fa-arrow-left"></i>
            </button>
            <button id="EditButton" class="profile-action-button action-btn" type="button" onclick="editProfile()">
                Edit <i class="fal fa-regular fa-edit"></i>
            </button>
        </div>
    </div>
    <div id="profile-content" class="profile-content">
        <div class="profile-left">
            <form id="profile-edit" action="" method="post">
                <div class="profile-edit-box">
                    <span>Email Address</span>
                    <input type="text" value="JohnDoe@domain.com" disabled required>
                </div>
                <div class="profile-edit-box">
                    <span>Username</span>
                    <input type="text" value="John_Doe" disabled required>
                </div>
                <div class="profile-edit-box">
                    <div class="profile-edit-name">
                        <div>
                            <span>Firstname</span>
                            <input type="text" value="John" disabled required>
                        </div>
                        <div>
                            <span>Lastname</span>
                            <input type="text" value="Doe" disabled required>
                        </div>
                    </div>

                </div>
                <div class="profile-edit-box">
                    <span>Password</span>
                    <input type="password" id="password" value="password" disabled required>
                    <input type="checkbox" id="pwVisibility" onclick="showPassword()" disabled><span style="font-size: 14px;">Show Password</span>
                </div>
            </form>

        </div>
        <div class="profile-right">
            <div class="profile-display-box">
                <i class="fal fa fa-user-circle-o"></i>
                <span>John_Doe</span>
            </div>
            <hr>
            <div class="profile-display-box">
                <span>No. Course(s)</span>
                <span>8</span>
            </div>
            <hr>
            <div class="profile-display-box">
                <span>No. Topic(s)</span>
                <span>18</span>
            </div>
        </div>
    </div>
</div>

<script>
    //Toggle between edit and save function
    function editProfile() {
        if (document.getElementById("profile-content").classList.contains("profile-edit")) {
            //change action button's content
            document.getElementById('EditButton').innerHTML = 'Edit <i class="fal fa-regular fa-edit"></i>';
            document.getElementById("profile-content").classList.remove("profile-edit")
            //disable all inputs
            $("#profile-edit :input").prop("disabled", true);
            //disable show password
            document.getElementById('pwVisibility').checked = false;
            document.getElementById("password").type = "password";
        } else {
            document.getElementById("profile-content").classList.toggle("profile-edit")
            document.getElementById('EditButton').innerHTML = 'Save <i class="fal fa-regular fa-save"></i>';
            //enable all inputs
            $("#profile-edit :input").prop("disabled", false);
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
</script>