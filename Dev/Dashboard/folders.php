<?php
include 'session.php';
include 'config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$query = mysqli_query($conn, "SELECT * FROM topic where course_ID='$get_id';");
$count = mysqli_num_rows($query);

if ($count != '0') {
    while ($row = mysqli_fetch_array($query)) {
        $topic_ID = $row['topic_ID'];
        $difficulty = '';
        if ($row['difficulty_ID'] == 1) {
            $difficulty = "difficulty-beginner";
        } else if ($row['difficulty_ID'] == 2) {
            $difficulty = "difficulty-intermediate";
        } else {
            $difficulty = "difficulty-advanced";
        } 
?>

        <a href="<?php echo '../Topic?id='.$topic_ID; ?>" class="dashboard-topic">
            <span class="svg svg-folder"></span>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title"><?php echo $row['topic_name']; ?></span>
                <span class="dashboard-topic-difficulty <?php echo $difficulty; ?>"></span>
            </span>
            
            <div class="ellipsis-dropdown" onclick="toggleEllipsisFunction()">
                <i class="fal fa-solid fa-ellipsis-h ellipsis-icon""></i>
                    <div id="ellipsis-dropdown-content" class="ellipsis-dropdown-content">
                        <div class="ellipsis-dropdown-box">
                            <button>Delete</button>
                        </div>
                        <div class="ellipsis-dropdown-box">
                            <button>Clone</button>
                        </div>
                    </div>
            </div>

        </a>  

<?php
    }
}
?>

<script>
    function toggleEllipsisFunction() {
        document.getElementById("ellipsis-dropdown-content").classList.toggle("show");
    }
</script>