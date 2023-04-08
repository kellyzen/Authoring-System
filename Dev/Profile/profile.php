<?php
include '../session.php';
include '../config.php';

$id = "";
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

$ques1 = mysqli_query($conn, "SELECT * FROM security_ques where ques_section = '1' ORDER BY ques_ID ASC;");
$ques1_count = mysqli_num_rows($ques1);

$ques2 = mysqli_query($conn, "SELECT * FROM security_ques where ques_section = '2' ORDER BY ques_ID ASC;");
$ques2_count = mysqli_num_rows($ques2);

$ques3 = mysqli_query($conn, "SELECT * FROM security_ques where ques_section = '3' ORDER BY ques_ID ASC;");
$ques3_count = mysqli_num_rows($ques3);

$security = mysqli_query($conn, "SELECT * FROM user_security where user_ID='$user_ID';");
$security_count = mysqli_num_rows($security);
if ($security_count != '0') {
    $row = mysqli_fetch_array($security);
    $ques1_ID = $row['ques1_ID'];
    $ques2_ID = $row['ques2_ID'];
    $ques3_ID = $row['ques3_ID'];
    $ques1_ans = $row['ques1_ans'];
    $ques2_ans = $row['ques2_ans'];
    $ques3_ans = $row['ques3_ans'];
}
?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-title-box">
            <span class="profile-title">Profile</span>
        </div>
        <div class="profile-action-buttons">
            <button id="dashboardButton" class="profile-action-button action-btn" type="button" onclick="location.href='<?php echo '../Dashboard?id=' . $id; ?>'">
                <span>Back</span> <i class="fal fa-solid fa-arrow-left"></i>
            </button>
            <button id="editButton" class="profile-action-button action-btn" type="button" onclick="editProfile()">
                <span>Edit</span> <i class="fal fa-regular fa-edit"></i>
            </button>
        </div>
    </div>
    <div id="profile-content" class="profile-content">
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
        <div class="profile-left">
            <div id="profile-edit">
                <input type='hidden' id='user_ID' value='<?php echo $user_ID ?>'>
                <div class="profile-edit-box">
                    <span>Email Address</span>
                    <input type="text" value="<?php echo $email; ?>" id="email" name="email" placeholder="Enter email address..." disabled required>
                    <div id="email_err" class="error_text"></div>
                </div>
                <div class="profile-edit-box">
                    <span>Username</span>
                    <input type="text" value="<?php echo $username; ?>" id="username" name="username" placeholder="Enter username..." disabled required>
                    <div id="username_err" class="error_text"></div>
                </div>
                <div class="profile-edit-box">
                    <div class="profile-edit-name">
                        <div>
                            <span>Firstname</span>
                            <input type="text" value="<?php echo $firstname; ?>" id="firstname" name="firstname" placeholder="Enter firstname..." disabled required>
                        </div>
                        <div>
                            <span>Lastname</span>
                            <input type="text" value="<?php echo $lastname; ?>" id="lastname" name="lastname" placeholder="Enter lastname..." disabled required>
                        </div>
                    </div>
                    <div id="name_err" class="error_text"></div>

                </div>
                <div class="profile-edit-box">
                    <span>Password</span>
                    <input type="password" id="password" name="password" value="<?php echo $password; ?>" placeholder="Enter password..." disabled required>
                    <input type="checkbox" id="pwVisibility" onclick="showPassword()" disabled><span style="font-size: 14px;">Show Password</span>
                    <div id="password_err" class="error_text"></div>
                </div>

                <!-- Accordion-->
                <hr style="border:2px solid; ">
                <div class="accordion" id="accordionExample">
                    <span>Security Questions</span>
                    <div class="accordion-item profile-edit-box">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>Question 1</span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <select class="dropdown" id="profile-dropdown-q1" disabled required>
                                    <?php
                                    if ($ques1_count != '0') {
                                        while ($row = mysqli_fetch_array($ques1)) { ?>
                                            <option value="<?php echo $row['ques_ID']; ?>" <?= ($ques1_ID == $row['ques_ID']) ? "selected" : "" ?>><?php echo $row['question']; ?></option><?php
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>
                                </select>
                                <input type="password" id="security-ques1" name="q1" value="<?php echo $ques1_ans; ?>" placeholder="Enter question 1 answer..." disabled required>
                                <input type="checkbox" id="q1Visibility" onclick="showQ1()" disabled><span style="font-size: 14px;">Show Answer</span>
                                <div id="q1_err" class="error_text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item profile-edit-box">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span>Question 2</span>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <select class="dropdown" id="profile-dropdown-q2" disabled required>
                                    <?php
                                    if ($ques2_count != '0') {
                                        while ($row = mysqli_fetch_array($ques2)) { ?>
                                            <option value="<?php echo $row['ques_ID']; ?>" <?= ($ques2_ID == $row['ques_ID']) ? "selected" : "" ?>><?php echo $row['question']; ?></option><?php
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>
                                </select>
                                <input type="password" id="security-ques2" name="q2" value="<?php echo $ques2_ans; ?>" placeholder="Enter question 2 answer..." disabled required>
                                <input type="checkbox" id="q2Visibility" onclick="showQ2()" disabled><span style="font-size: 14px;">Show Answer</span>
                                <div id="q2_err" class="error_text"></div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item profile-edit-box">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span>Question 3</span>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <select class="dropdown" id="profile-dropdown-q3" disabled required>
                                    <?php
                                    if ($ques3_count != '0') {
                                        while ($row = mysqli_fetch_array($ques3)) { ?>
                                            <option value="<?php echo $row['ques_ID']; ?>" <?= ($ques3_ID == $row['ques_ID']) ? "selected" : "" ?>><?php echo $row['question']; ?></option><?php
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>
                                </select>
                                <input type="password" id="security-ques3" name="q3" value="<?php echo $ques3_ans; ?>" placeholder="Enter question 3 answer..." disabled required>
                                <input type="checkbox" id="q3Visibility" onclick="showQ3()" disabled><span style="font-size: 14px;">Show Answer</span>
                                <div id="q3_err" class="error_text"></div>
                            </div>
                        </div>
                    </div>
                    <div id="q_err" class="error_text"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="profile.js"></script>