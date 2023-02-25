<?php
include '../session.php';
include '../config.php';

$get_id = $_GET['id'];
$user_ID = "$_SESSION[id]";

$sql = "SELECT * FROM course where user_ID='$user_ID' AND course_ID='$get_id';";
$result = $conn->query($sql);

$c_name = $c_description = $c_type_ID = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $c_name = $row["c_name"];
        $c_description = $row["c_description"];
        $c_type_ID = $row["c_type_ID"];
    }
}

$query = "SELECT * FROM course_type where c_type_ID='$c_type_ID';";
$result = $conn->query($query);

$c_type = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $c_type = $row["c_type"];
    }
}
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="dashboard-title-box">
            <span id="course-header-title" class="course-header-title" contenteditable="true" value=><?php echo $c_name; ?></span>
            <span class="course-type"><?php echo $c_type; ?></span>
        </div>
        <div class="dashboard-description-box">
            <span id="course-description" class="course-description" contenteditable="true"><?php echo $c_description; ?></span>
            <div class="dashboard-action-buttons-box">
                <div class="dashboard-action-buttons">
                    <button id = "filterButton" class="action-btn" type="button" onclick="showFilterMenu()">
                        Filter <i class="fal fa-solid fa-filter"></i>
                    </button>
                    <div id = "filterDropdown" class = "filter-dropdown-content">
                            <div id="BeginnerDifficulty" class="filter-dropdown-box">
                                <span>Beginner</span>
                                <label class = "toggle" for = "BeginnerFilterToggle">

                                </label>
                            </div>
                        </div>
                        <div id = "filterDropdown" class = "filter-dropdown-content">
                            <div id="IntermediateDifficulty" class="filter-dropdown-box">
                                <span>Intermediate</span>
                                <label class = "toggle" for = "IntermediateFilterToggle">

                                </label>
                            </div>
                        </div>
                        <div id = "filterDropdown" class = "filter-dropdown-content">
                            <div id="AdvancedDifficulty" class="filter-dropdown-box">
                                <span>Advanced</span>
                                <label class = "toggle" for = "AdvancedFilterToggle">
                                    
                                </label>
                            </div>
                        </div>
                    <button id="topic-add" class="action-btn" type="button">
                        Add <i class="fal fa-regular fa-plus"></i>
                    </button>
                </div>
                <div class="dashboard-action-buttons">
                    <button id="viewButton" class="dashboard-action-button action-btn" type="button" onclick="changeView()">
                        <i class="fal fa-regular fa-list"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!--List of Topics-->
    <div id="dashboard-content" class="dashboard-content">
        <?php
        include '../session.php';
        include '../config.php';

        $get_id = $_GET['id'];
        $user_ID = "$_SESSION[id]";

        $query = mysqli_query($conn, "SELECT * FROM topic where course_ID='$get_id';");
        $count = mysqli_num_rows($query);

        if ($count != '0') {
            include 'topic.php';
        } else {
            include 'topic_invalid.php';
        }
        ?>
    </div>
</div>
<script>
    //Toggle between edit and save function
    function changeView() {
        if (document.getElementById("dashboard-content").classList.contains("dashboard-list")) {
            //change dashboard to grid view
            document.getElementById('viewButton').innerHTML = '<i class="fal fa-regular fa-list"></i>';
            document.getElementById("dashboard-content").classList.remove("dashboard-list");
        } else {
            //change dashboard to list view
            document.getElementById('viewButton').innerHTML = '<i class="fal fa-solid fa-grip-vertical"></i>';
            document.getElementById("dashboard-content").classList.toggle("dashboard-list");
        }
    }

    function showFilterMenu() {
        document.getElementById("filter-dropdown").classList.toggle("show");
    }
    //Auto update course information
    setInterval(autoSaveCourse, 2000);

    function autoSaveCourse() {
        var title = $('#course-header-title').html();
        var description = $('#course-description').html();
        var courseid = <?php echo $get_id ?>;

        if (title == '') {
            document.getElementById('course-header-title').innerHTML = 'Untitled';
        }

        if (description == '') {
            document.getElementById('course-description').innerHTML = 'Add description here...';
        }

        if (title != '' || description != '') {
            $.ajax({
                url: 'course_update.php',
                type: 'post',
                data: {
                    courseid: courseid,
                    title: title,
                    description: description,
                }
            });
        }
    }

    //Ignore enter key while editing course title and course description
    document.querySelector('#course-header-title').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
    document.querySelector('#course-description').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
</script>