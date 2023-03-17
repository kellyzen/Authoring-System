<?php
include '../session.php';
include '../config.php';

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
                <input type='hidden' id='user_ID' value='<?php echo $user_ID ?>'>
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

<script type="text/javascript" src="profile.js"></script>  