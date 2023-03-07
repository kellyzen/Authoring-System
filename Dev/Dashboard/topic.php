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
                    <span id="delete-topic-btn" class="ellipsis-dropdown-box" data-id="<?php echo $topic_ID; ?>" onclick="deleteTopic(<?php echo $topic_ID; ?>)">
                        <span>Delete</span>
                        <i class="fal fa-solid fa-trash"></i>
                    </span>
                    <span id="clone-topic-btn" class="ellipsis-dropdown-box" data-id="<?php echo $topic_ID; ?>" onclick="cloneTopic(<?php echo $topic_ID; ?>)">
                        <span>Clone</span>
                        <i class="fal fa-solid fa-clone"></i>
                    </span>
                </div>
            </div>
        </div>
<?php
    }
}
?>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-delete-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content flex-column">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-delete-modal-label">Confirm Delete</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="icon-box">
                    <i class="fal fa-solid fa-times-circle"></i>
                </div>
                <h3>Are you sure?</h3>
                <p>Do you really want to delete this topic? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancelbtn secondary-btn" data-bs-dismiss="modal">Cancel</button>
                <input type="hidden" name="id" id="delete-id">
                <button type="button" class="deletebtn primary-btn" onclick="confirmDeleteTopic()">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Clone Modal -->
<div class="modal fade" id="confirm-clone-modal" tabindex="-1" role="dialog" aria-labelledby="confirm-clone-modal-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content flex-column">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm-clone-modal-label">Confirm Clone</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="icon-box">
                    <i class="fal fa-solid fa-times-circle"></i>
                </div>
                <h3>Are you sure?</h3>
                <p>Do you really want to clone this topic? This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancelbtn secondary-btn" data-bs-dismiss="modal">Cancel</button>
                <input type="hidden" name="id" id="clone-id">
                <button type="button" class="clonebtn primary-btn" onclick="confirmCloneTopic()">Clone</button>
            </div>
        </div>
    </div>
</div>

<script>
    //confirm delete topic
    function deleteTopic(topic_ID) {
        // Get the ID of the item to delete
        var id = topic_ID;
        // Set the ID in the confirmation modal
        $('#delete-id').val(id);
        $('#confirm-delete-modal').modal('show');
    }

    //confirm delete topic
    function confirmDeleteTopic() {
        var topicid = $('#delete-id').val();

        if (topicid != '') {
            $.ajax({
                url: 'topic_delete.php',
                type: 'post',
                data: {
                    topicid: topicid,
                },
                success: function(html) {
                    if (html == "true") {
                        $.jGrowl("Delete Topic Failed", {
                            header: 'Delete Topic'
                        });
                    } else {
                        $.jGrowl("Topic Successfully Deleted", {
                            header: 'Delete Topic'
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

    //clone topic
    function cloneTopic(topic_ID) {
        // Get the ID of the item to clone
        var id = topic_ID;
        // Set the ID in the confirmation modal
        $('#clone-id').val(id);
        $('#confirm-clone-modal').modal('show');
    }

    //confirm clone topic
    function confirmCloneTopic() {
        var topicid = $('#clone-id').val();

        if (topicid != '') {
            $.ajax({
                url: 'topic_clone.php',
                type: 'post',
                data: {
                    topicid: topicid,
                },
                success: function(html) {
                    if (html == "true") {
                        $.jGrowl("Clone Topic Failed", {
                            header: 'Clone Topic'
                        });
                    } else {
                        $.jGrowl("Topic Successfully Cloned", {
                            header: 'Clone Topic'
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