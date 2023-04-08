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
            <span id="course-header-title" class="course-header-title" contenteditable="true" data-toggle="tooltip" data-placement="left" title="Click to edit course title" value=><?php echo $c_name; ?></span>
            <span class="course-type"><?php echo $c_type; ?></span>
            <input type='hidden' id='id1' value='<?php echo $id1 ?>'>
        </div>
        <div class="dashboard-description-box">
            <span id="course-description" class="course-description" contenteditable="true" data-toggle="tooltip" data-placement="left" title="Click to edit course description"><?php echo $c_description; ?></span>
            <div class="dashboard-action-buttons-box">
                <div class="dashboard-action-buttons">
                    <!--<button id="filterButton" class="action-btn" type="button" onclick="showFilterMenu()">
                        Filter <i class="fal fa-solid fa-filter"></i>
                    </button>
                    <div id="filterDropdown" class="filter-dropdown-content">
                        <div id="BeginnerDifficulty" class="filter-dropdown-box">
                            <span>Beginner</span>
                            <label class="toggle" for="BeginnerFilterToggle">

                            </label>
                        </div>
                    </div>
                    <div id="filterDropdown" class="filter-dropdown-content">
                        <div id="IntermediateDifficulty" class="filter-dropdown-box">
                            <span>Intermediate</span>
                            <label class="toggle" for="IntermediateFilterToggle">

                            </label>
                        </div>
                    </div>
                    <div id="filterDropdown" class="filter-dropdown-content">
                        <div id="AdvancedDifficulty" class="filter-dropdown-box">
                            <span>Advanced</span>
                            <label class="toggle" for="AdvancedFilterToggle">

                            </label>
                        </div>
                    </div>-->
                    <button id="course-delete" class="action-btn user-view" type="button" data-id="<?php echo $get_id; ?>" onclick="deleteCourse(<?php echo $get_id; ?>)">
                        <span>Delete</span> <i class="fal fa-regular fa-trash"></i>
                    </button>
                    <button id="topic-add" class="action-btn user-view" type="button">
                    <span>Add</span> <i class="fal fa-regular fa-plus"></i>
                    </button>
                </div>
                <div class="dashboard-action-buttons">
                    <button id="viewButton" class="dashboard-action-button action-btn" type="button" onclick="changeView()">
                        <i class="fal fa-regular fa-list"></i>
                    </button>
                </div>
                <input type='hidden' id='get_id' value='<?php echo $get_id ?>'>
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

<!-- Confirm Delete Modal -->
<div class="modal fade" id="course-delete-modal" tabindex="-1" role="dialog" aria-labelledby="course-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content flex-column">
            <div class="modal-header">
                <h5 class="modal-title" id="course-delete-modal-label">Confirm Delete Course</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="icon-box">
                    <i class="fal fa-solid fa-times-circle"></i>
                </div>
                <h3>Are you sure?</h3>
                <p class="text-center">Do you really want to delete this course? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancelbtn secondary-btn" data-bs-dismiss="modal">Cancel</button>
                <input type="hidden" name="id" id="course-delete-id">
                <button type="button" class="deletebtn primary-btn" onclick="confirmDeleteCourse()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="course.js"></script>  