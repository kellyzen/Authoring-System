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
            <a href="<?php echo '../Topic?id=' . $topic_ID; ?>"><span class="svg svg-folder"></span></a>
            <span class="dashboard-topic-group">
                <span class="dashboard-topic-title"><?php echo $row['topic_name']; ?></span>
                <span class="dashboard-topic-difficulty <?php echo $difficulty; ?>"></span>
            </span>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="ellipsis-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fal fa-solid fa-ellipsis-h dropdown-toggle"></i>
                </button>
                <div class="dropdown-menu ellipsis-dropdown-content" aria-labelledby="ellipsis-icon" id="<?php echo 'topic_ID' . $topic_ID; ?>">
                    <div class="ellipsis-dropdown-box dropdown-item">
                        <span>Delete</span>
                        <i class="fal fa-solid fa-trash"></i>
                    </div>
                    <div class="ellipsis-dropdown-box dropdown-item">
                        <span>Clone</span>
                        <i class="fal fa-solid fa-clone"></i>
                    </div>
                </div>
            </div>

        </div>
        <!--///////////////////////////////////////////////
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown button
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>-->
<?php
    }
}
?>

<script>
    //Toggle dropdown for topics
    /*function toggleEllipsisFunction(topic_ID) {
        removeShow('.ellipsis-dropdown .ellipsis-dropdown-content');

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
    window.onclick = function(event) {
        if (!event.target.matches('.fa-ellipsis-h')) {
            removeShow('.ellipsis-dropdown .ellipsis-dropdown-content');
        }
    }*/
</script>