<?php
include '../skeleton.php';
include '../session.php';
$user_ID = "$_SESSION[id]";
$course_ID = $_GET['id'];
?>

<head>
    <meta charset="UTF-8">
    <title>Dashboard | stud.io</title>
</head>

<body class="<?php echo $theme; ?>">
    <div class="main-container">
        <?php
        include '../navbar.php';
        include 'dashboard.php';
        ?>
    </div>
</body>

<script>
    //Toggle sidebar
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });

    //Tooltip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //Show search bar filter dropdown on click
    let dropdown = document.querySelector("#filter-dropdown");
    let icon = document.querySelector("#filter-icon");

    icon.addEventListener("click", () => {
        dropdown.classList.toggle("show");
        icon.classList.toggle("active");
    });

    //Search bar
    let search = document.querySelector("#search-input");
    let courses = document.querySelector("#course-lists");
    let topics = document.querySelector("#topic-lists");
    let courseToggle = document.querySelector("#courseToggle");
    let topicToggle = document.querySelector("#topicToggle");

    $(function() {
        var userid = <?php echo $user_ID ?>;
        var courseid = <?php echo $course_ID ?>;
        // When the user types in the search bar
        $(search).on('input', function() {
            // Get the search query
            var query = $(this).val();

            // If the search query is not empty
            if (query.length > 0) {
                if (courseToggle.checked == true) {
                    // Send an AJAX request to the server to perform course search
                    $.ajax({
                        url: 'course_search.php',
                        type: 'GET',
                        data: {
                            q: query,
                            userid: userid,
                            courseid: courseid,
                        },
                        success: function(data) {
                            // Display the search results in course
                            $(courses).html(data);
                        }
                    });
                } else {
                    // Send an AJAX request to the server to perform topic search
                    $.ajax({
                        url: 'topic_search.php',
                        type: 'GET',
                        data: {
                            q: query,
                            userid: userid,
                            courseid: courseid,
                        },
                        success: function(data) {
                            // Display the search results in topics
                            $(topics).html(data);
                        }
                    });
                }

            } else {
                // Reload window if the search query is empty
                window.location = ''
            }
        });
    });
</script>