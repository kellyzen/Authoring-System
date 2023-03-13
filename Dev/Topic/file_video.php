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
    <div class="file-lists">
        <?php
        while ($row = $result->fetch_assoc()) {
            $file_id = $row["file_ID"];
            $file_name = $row["file_name"];
            $file_size = $row["file_size"];
            $file_type = $row["file_type"];
            $file_path = $row["file_path"];

            if ($file_type == "video/mp4") {
                $file_svg = "svg-video";
        ?>
                <div class="topic-file">
                    <a href="<?php echo $file_path; ?>" target="_blank">
                        <span class="svg <?php echo $file_svg; ?>"></span>
                        <span class="topic-file-group">
                            <span class="topic-file-title"><?php echo $file_name; ?></span>
                        </span>
                    </a>
                    <i class="fal fa-solid fa-ellipsis-h" onclick="toggleVideoDropdown(<?php echo $file_id; ?>)"></i>
                    <div class="file-dropdown">
                        <div id="<?php echo 'video_ID' . $file_id; ?>" class="file-dropdown-content">
                            <span id="delete-file-btn" class="file-dropdown-box" data-id="<?php echo $file_id; ?>" onclick="deleteVideo(<?php echo $file_id; ?>)">
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
    <div class="modal fade" id="video-delete-modal" tabindex="-1" role="dialog" aria-labelledby="video-delete-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content flex-column">
                <div class="modal-header">
                    <h5 class="modal-title" id="video-delete-modal-label">Confirm Delete Video</h5>
                    <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="icon-box">
                        <i class="fal fa-solid fa-times-circle"></i>
                    </div>
                    <h3>Are you sure?</h3>
                    <p class="text-center">Do you really want to delete this video? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancelbtn secondary-btn" data-bs-dismiss="modal">Cancel</button>
                    <input type="hidden" name="id" id="video-delete-id">
                    <button type="button" class="deletebtn primary-btn" onclick="confirmDeleteVideo()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Toggle dropdown for files
        function toggleVideoDropdown(video_ID) {
            removeShow('.file-dropdown-content');

            let videoID = 'video_ID' + video_ID.toString();
            document.getElementById(videoID).classList.toggle("show");
        }

        //delete file
        function deleteVideo(file_id) {
            // Get the ID of the item to delete
            var id = file_id;
            // Set the ID in the confirmation modal
            $('#video-delete-id').val(id);
            $('#video-delete-modal').modal('show');
        }

        //confirm delete file
        function confirmDeleteVideo() {
            var fileid = $('#video-delete-id').val();

            if (fileid != '') {
                $.ajax({
                    url: 'file_delete.php',
                    type: 'post',
                    data: {
                        fileid: fileid,
                    },
                    success: function(html) {
                        console.log(html);
                        if (html == "true") {
                            $.jGrowl("Delete File Failed", {
                                header: 'Delete File'
                            });
                        } else {
                            $.jGrowl("File Successfully Deleted", {
                                header: 'Delete File'
                            });
                            var delay = 2000;
                            setTimeout(function() {
                                window.location = ''
                            }, delay);
                        }
                    }
                });
            }
        }
    </script>