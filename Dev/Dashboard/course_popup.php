<?php
include '../session.php';
include '../config.php';

$user_ID = "$_SESSION[id]";
$query = mysqli_query($conn, "SELECT * FROM course_type ORDER BY c_type ASC;");
$count = mysqli_num_rows($query);
?>

<div class="course-add-popup">
    <div class="popup-content">
        <div class="popup-header-box">
            <span class="popup-header">Add new course</span>
        </div>
        <div class="popup-content-box" id="popup-content-box">
            <div class="popup-content-small-box">
                <span class="popup-content-title">Title</span>
                <input id="popup-course-title" type="text" placeholder="Add course title...">
            </div>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Course Type</span>
                <select class="dropdown" id="popup-course-type">
                    <?php
                    if ($count != '0') {
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <option value="<?php echo $row['c_type_ID']; ?>"><?php echo $row['c_type']; ?></option><?php
                                                                                                                }
                                                                                                            } ?>
                </select>
            </div>
            <input type='hidden' id='hidden' value=''>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Description</span>
                <textarea id="popup-course-desc" rows="4" cols="50" placeholder="Add course description..."></textarea>
            </div>
        </div>
        <div class="popup-footer-box">
            <button id="course-cancel-btn" class="popup-footer-btn secondary-btn" type="button">Cancel</button>
            <button class="popup-footer-btn primary-btn" type="button" onclick="createCourse()">Create</button>
        </div>
        <input type='hidden' id='user_ID' value='<?php echo $user_ID ?>'>
        <a id="course-close-btn" class="close-button">x</a>
    </div>
</div>

<script type="text/javascript" src="course_popup.js"></script>  
