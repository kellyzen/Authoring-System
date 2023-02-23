<?php
include '../session.php';
include '../config.php';

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

        <div class="dashboard-topic">
            <a href="<?php echo '../Topic?id=' . $topic_ID; ?>">
                <span class="svg svg-folder"></span>
                <span class="dashboard-topic-group">
                    <span class="dashboard-topic-title"><?php echo $row['topic_name']; ?></span>
                    <span class="dashboard-topic-difficulty <?php echo $difficulty; ?>"></span>
                </span>
            </a>
            <i class="fal fa-solid fa-ellipsis-h" onclick="toggleEllipsisFunction(<?php echo $topic_ID; ?>)"></i>
            <div class="ellipsis-dropdown">
            <div id="<?php echo 'topic_ID' . $topic_ID; ?>" class="ellipsis-dropdown-content">
                <div class="ellipsis-dropdown-box">
                    <span>Delete</span>
                    <i class="fal fa-solid fa-trash"></i>
                </div>
                <div class="ellipsis-dropdown-box">
                    <span>Clone</span>
                    <i class="fal fa-solid fa-clone"></i>
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
    function toggleEllipsisFunction(topic_ID) {
        removeShow('.ellipsis-dropdown-content');

        let topicID = 'topic_ID' + topic_ID.toString();
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