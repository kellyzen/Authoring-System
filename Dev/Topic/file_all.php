<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$sql = "SELECT * FROM `file` where topic_ID='$get_id' ORDER BY file_ID DESC;;";
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

            if ($file_type == "image/jpeg" || $file_type == "image/png") {
                $file_svg = "svg-image";
            } else  if ($file_type == "application/pdf") {
                $file_svg = "svg-document";
            } else  if ($file_type == "audio/x-m4a" || $file_type == "audio/mpeg") {
                $file_svg = "svg-audio";
            } else {
                $file_svg = "svg-folder";
            }
        ?>
            <div class="topic-file">
                <a href="<?php echo $file_path; ?>" target="_blank">
                    <span class="svg <?php echo $file_svg; ?>"></span>
                    <span class="topic-file-group">
                        <span class="topic-file-title"><?php echo $file_name; ?></span>
                    </span>
                </a>
                <i class="fal fa-solid fa-ellipsis-h"></i>
                <div class="ellipsis-dropdown">
                    <div class="ellipsis-dropdown-content">
                        <div class="ellipsis-dropdown-box">
                            <span>Delete</span>
                            <i class="fal fa-solid fa-trash"></i>
                        </div>
                        <div class="ellipsis-dropdown-box">
                            <span>View</span>
                            <i class="fal fa-solid fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
    </div>

    <!--<div class="file-lists">
    <div class="topic-file">
        <a href="">
            <span class="svg svg-audio"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">File 1</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="topic-file">
        <a href="">
            <span class="svg svg-video"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">File 2</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="topic-file">
        <a href="">
            <span class="svg svg-document"></span>
            <span class="topic-file-group">
                <span class="topic-file-title">File 3</span>
            </span>
        </a>
        <i class="fal fa-solid fa-ellipsis-h"></i>
        <div class="ellipsis-dropdown">
            <div class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>View</span>
                    <i class="fal fa-solid fa-eye"></i>
                </div>
            </div>
        </div>
    </div>
</div>-->

    <script>
        //Toggle dropdown for topics
        function toggleEllipsisFunction(file_ID) {
            removeShow('.ellipsis-dropdown-content');

            let topicID = 'file_ID' + file_ID.toString();
            document.getElementById(topicID).classList.toggle("show");
        }

        //Remove show class
        function removeShow(classList) {
            const check = document.querySelectorAll(classList);
            check.forEach(e => {
                if (e.classList.contains('show')) {
                    e.classList.remove('show');
                }
            })
        }

        //Close all dropdowns if user clicks outside of it
        document.onclick = function(event) {
            if (!event.target.matches('.fa-ellipsis-h')) {
                removeShow('.ellipsis-dropdown-content');
            }
        }
    </script>