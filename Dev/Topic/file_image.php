<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$sql = "SELECT * FROM `file` where topic_ID='$get_id' ORDER BY file_ID DESC;";
$result = $conn->query($sql);

$file_id = $file_name = $file_size = $file_type = $file_path = $file_svg = "";

if ($result->num_rows > 0) {
?>
    <div class="file-lists" id="file-lists-image">
        <?php
        while ($row = $result->fetch_assoc()) {
            $file_id = $row["file_ID"];
            $file_name = $row["file_name"];
            $file_size = $row["file_size"];
            $file_type = $row["file_type"];
            $file_path = $row["file_path"];

            $image_array = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');

            if (in_array($file_type, $image_array)) {
                $file_svg = "svg-image";
        ?>
                <div class="topic-file">
                    <a href="<?php echo $file_path; ?>" target="_blank">
                        <span class="svg <?php echo $file_svg; ?>"></span>
                        <span class="topic-file-group">
                            <span class="topic-file-title"><?php echo $file_name; ?></span>
                        </span>
                    </a>
                    <i class="fal fa-solid fa-ellipsis-h user-view" onclick="toggleImageDropdown(<?php echo $file_id; ?>)"></i>
                    <div class="file-dropdown">
                        <div id="<?php echo 'image_ID' . $file_id; ?>" class="file-dropdown-content">
                            <span id="delete-file-btn" class="file-dropdown-box" data-id="<?php echo $file_id; ?>" onclick="deleteImage(<?php echo $file_id; ?>)">
                                <span>Delete</span>
                                <i class="fal fa-solid fa-trash"></i>
                            </span>
                            <a href="<?php echo $file_path; ?>" target="_blank" id="view-file-btn" class="file-dropdown-box">
                                <span>View</span>
                                <i class="fal fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    }
    ?>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="image-delete-modal" tabindex="-1" role="dialog" aria-labelledby="image-delete-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content flex-column">
                <div class="modal-header">
                    <h5 class="modal-title" id="image-delete-modal-label">Confirm Delete Image</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="icon-box">
                        <i class="fal fa-solid fa-times-circle"></i>
                    </div>
                    <h3>Are you sure?</h3>
                    <p class="text-center">Do you really want to delete this image? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancelbtn secondary-btn" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="id" id="image-delete-id">
                    <button type="button" class="deletebtn primary-btn" onclick="confirmDeleteImage()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="file_image.js"></script>  
