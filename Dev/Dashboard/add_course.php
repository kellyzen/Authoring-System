<?php
include 'session.php';
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM course_type ORDER BY c_type ASC;");
$count = mysqli_num_rows($query);
?>

<div class="course-add-popup">
    <div class="popup-content">
        <div class="popup-header-box">
            <span class="popup-header">Add new course</span>
        </div>
        <div class="popup-content-box">
            <div class="popup-content-small-box">
                <span class="popup-content-title">Title</span>
                <input type="text" placeholder="Add course title...">
            </div>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Course Type</span>
                <select class="dropdown">
                    <?php
                    if ($count != '0') {
                        while ($row = mysqli_fetch_array($query)) {?>
                            <option><?php echo $row['c_type']; ?></option><?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="popup-content-small-box">
                <span class="popup-content-title">Description</span>
                <textarea rows="4" cols="50" placeholder="Add topic description..."></textarea>
            </div>
        </div>
        <div class="popup-footer-box">
            <button id="cancel-btn" class="popup-footer-btn secondary-btn" type="button">Cancel</button>
            <button class="popup-footer-btn primary-btn" type="button">Create</button>
        </div>
        <a id="close-btn" class="close-button">x</a>
    </div>
</div>