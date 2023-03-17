<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";
?>

<div class="file-add-popup">
    <div class="popup-content">
        <div class="popup-header-box">
            <span class="popup-header">Add new file</span>
        </div>
        <form id="file-upload-form" enctype="multipart/form-data">
            <div class="popup-content-box" id="popup-content-box">
                <div class="popup-content-small-box">
                    <div id="dropzone">
                        <i class="fal fa-solid fa-upload"></i>
                        <div class="text">Click or drop files here to upload</div>
                    </div>
                    <input type="file" name="file" id="file">
                    <br>
                </div>
            </div>
            <div class="popup-footer-box">
                <button id="file-cancel-btn" class="popup-footer-btn secondary-btn" type="button">Cancel</button>
                <button class="popup-footer-btn primary-btn" type="submit">Upload</button>
            </div>
        </form>
        <input type='hidden' id='get_id' value='<?php echo $get_id ?>'>
        <a id="file-close-btn" class="close-button">x</a>
    </div>
</div>

<script type="text/javascript" src="file_popup.js"></script> 