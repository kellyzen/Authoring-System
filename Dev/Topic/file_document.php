<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$query = mysqli_query($conn, "SELECT * FROM file where topic_ID='$get_id';");
$count = mysqli_num_rows($query);

if ($count != '0') {
    while ($row = mysqli_fetch_array($query)) {
        $file_ID = $row['file_ID'];
?>

        <div class="topic-file">
            <a href="">
                <span class="svg svg-folder"></span>
                <span class="topic-file-group">
                    <span class="topic-file-title"><?php echo $row['file_name']; ?></span>
                </span>
            </a>
            <i class="fal fa-solid fa-ellipsis-h" onclick="toggleEllipsisFunction(<?php echo $file_ID; ?>)"></i>
            <div class="ellipsis-dropdown">
            <div id="<?php echo 'file_ID' . $file_ID; ?>" class="ellipsis-dropdown-content">
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