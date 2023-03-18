<?php
include '../../config.php';

// Get the search query
$result = $_GET['q'];
$user_id = $_GET['userid'];
$course_id = $_GET['courseid'];
$query = mysqli_query($conn, "SELECT * FROM topic where course_ID='$course_id' AND (topic_name like '%$result%' OR topic_description like '%$result%');");
$count = mysqli_num_rows($query);

// Display the search results
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
        echo "
        <div class='dashboard-topic'>
            <a href='../Topic?id="; echo $topic_ID;echo "'>
                <span class='svg svg-folder'></span>
                <span class='dashboard-topic-group'>
                    <span class='dashboard-topic-title'>
        ";
        echo $row['topic_name'];
        echo "
                    </span>
                    <span class='dashboard-topic-difficulty";echo $difficulty;echo "'></span>
                </span>
            </a>
            <i class='fal fa-solid fa-ellipsis-h user-view' onclick='toggleEllipsisFunction(";echo $topic_ID;echo ")'></i>
            <div class='ellipsis-dropdown'>
                <div id='<?php echo 'topic_ID";echo $topic_ID;echo "' class='ellipsis-dropdown-content'>
                    <span id='delete-topic-btn' class='ellipsis-dropdown-box' data-id='";echo $topic_ID;echo "' onclick='deleteTopic("; echo $topic_ID; echo ")'>
                        <span>Delete</span>
                        <i class='fal fa-solid fa-trash'></i>
                    </span>
                    <span id='clone-topic-btn' class='ellipsis-dropdown-box' data-id='"; echo $topic_ID; echo "' onclick='cloneTopic("; echo $topic_ID; echo ")'>
                        <span>Clone</span>
                        <i class='fal fa-solid fa-clone'></i>
                    </span>
                </div>
            </div>
        </div>
        ";
    }
}
?>