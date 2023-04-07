<?php
include 'session.php';
include 'config.php';
$id1="";

$user_ID = "$_SESSION[id]";
$query = mysqli_query($conn, "SELECT * FROM course where user_ID='$user_ID';");
$count = mysqli_num_rows($query);

if ($count != '0') {
    $row = mysqli_fetch_array($query);
    $id1 = $row['course_ID'];
}

//Cookie for userview
function detect_userview()
{
    // Read cookie value
    if (isset($_COOKIE["userview"])) {
        return $_COOKIE["userview"];
    }
    // If cookie not found, use default userview
    return "unchecked";
}
$userview = detect_userview();

//Cookie for filter toggle
function detect_coursetoggle()
{
    // Read cookie value
    if (isset($_COOKIE["coursetoggle"])) {
        return $_COOKIE["coursetoggle"];
    }
    // If cookie not found, use default coursetoggle
    return "checked";
}
function detect_topictoggle()
{
    // Read cookie value
    if (isset($_COOKIE["topictoggle"])) {
        return $_COOKIE["topictoggle"];
    }
    // If cookie not found, use default topictoggle
    return "unchecked";
}
$coursetoggle = detect_coursetoggle();
$topictoggle = detect_topictoggle();
?>

<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <i class="fal fa-solid fa-bars" id="btn"></i>
                <a class="navbar-logo text-decoration-none" href="<?php echo '../Dashboard?id=' . $id1; ?>">stud.io</a>
            </li>
            <li class="nav-item search-container">
                <div class="search-bar">
                    <input id="search-input" type="search" placeholder="Search for...">
                    <span class="search-bar_icons">
                        <i class="fal fa-brands fa-search"></i>
                        <i id="filter-icon" class="fal fa-solid fa-sliders"></i>
                        <div id="filter-dropdown" class="filter-dropdown-content">
                            <div class="filter-dropdown-box">
                                <span>Course</span>
                                <label class="toggle" for="courseToggle">
                                    <input id="courseToggle" class="toggle__input" name="filterToggle" type="checkbox" <?php echo $coursetoggle; ?>>
                                    <div class="toggle__fill"></div>
                                </label>
                            </div>
                            <div class="filter-dropdown-box">
                                <span>Topic</span>
                                <label class="toggle" for="topicToggle">
                                    <input id="topicToggle" class="toggle__input" name="filterToggle" type="checkbox" <?php echo $topictoggle; ?>>
                                    <div class="toggle__fill"></div>
                                </label>
                            </div>
                        </div>
                    </span>
                </div>
            </li>
            <li class="nav-item setting-container" onclick="toggleSettingFunction()">
                <i class="fal fa-solid fa-gear float-end"></i>
                <div id="setting-dropdown" class="setting-dropdown-content">
                    <a href="../Profile/" id="profile" class="setting-dropdown-box">
                        <span>Profile</span>
                        <i class="fal fa-regular fa-user"></i>
                    </a>
                    <div class="setting-dropdown-box">
                        <span>User view</span>
                        <label class="toggle" for="userViewToggle">
                            <input class="toggle__input" name="" type="checkbox" id="userViewToggle" onclick="toggleUserView()" <?php echo $userview; ?>>
                            <div class="toggle__fill"></div>
                        </label>
                    </div>
                    <div class="setting-dropdown-box">
                        <span>Dark theme</span>
                        <label class="toggle" for="themeToggle">
                            <input class="toggle__input" name="" type="checkbox" id="themeToggle" onclick="toggleTheme()">
                            <div class="toggle__fill"></div>
                        </label>
                    </div>
                    <a href="../Login/logout.php" id="logout" class="setting-dropdown-box">
                        <span>Logout</span>
                        <i class="fal fa-solid fa-sign-out"></i>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<script>
    //Close all dropdowns if user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.fa-gear') && !event.target.matches('.fa-sliders')) {
            document.getElementById("setting-dropdown").classList.remove("show");
            document.getElementById("filter-dropdown").classList.remove("show");
            document.getElementById("filter-icon").classList.remove("active");
        }
    }

    //Show setting dropdown on click
    function toggleSettingFunction() {
        document.getElementById("setting-dropdown").classList.toggle("show");
    }

    // Function to set userview
    function set_userview(userview) {
        // Set cookie with userview value
        document.cookie = "userview=" + userview + "; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
    }

    // Function to set coursetoggle
    function set_coursetoggle(coursetoggle) {
        // Set cookie with coursetoggle value
        document.cookie = "coursetoggle=" + coursetoggle + "; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
    }

    // Function to set topictoggle
    function set_topictoggle(topictoggle) {
        // Set cookie with topictoggle value
        document.cookie = "topictoggle=" + topictoggle + "; expires=" + new Date(Date.now() + 30 * 24 * 60 * 60 * 1000).toUTCString() + "; path=/";
    }

    $(document).ready(function() {
        if ($('#userViewToggle').is(":checked")) {
            $('.user-view').attr('style', 'display: none !important');
            $("#course-lists").css("max-height", "calc(100vh - 8rem)");
        } else {
            $(".user-view").show();
            $("#course-lists").css("max-height", "calc(100vh - 12rem)");
        }

        //Change coursetoggle cookie value
        let topictoggle = document.querySelector("#topicToggle");

        topictoggle.addEventListener("click", () => {
            if ($('#topicToggle').is(":checked")) {
                set_coursetoggle("unchecked");
                set_topictoggle("checked");
                $( "#topicToggle" ).prop( "checked", true );
                $( "#courseToggle" ).prop( "checked", false );
            } else {
                set_coursetoggle("checked");
                set_topictoggle("unchecked");
                $( "#topicToggle" ).prop( "checked", false );
                $( "#courseToggle" ).prop( "checked", true );
            }
        });

        //Change coursetoggle cookie value
        let coursetoggle = document.querySelector("#courseToggle");

        coursetoggle.addEventListener("click", () => {
            if ($('#courseToggle').is(":checked")) {
                set_coursetoggle("checked");
                set_topictoggle("unchecked");
                $( "#topicToggle" ).prop( "checked", false );
                $( "#courseToggle" ).prop( "checked", true );
            } else {
                set_coursetoggle("unchecked");
                set_topictoggle("checked");
                $( "#topicToggle" ).prop( "checked", true );
                $( "#courseToggle" ).prop( "checked", false );
            }
        });
    });

    //Change user view
    function toggleUserView() {
        if ($('#userViewToggle').is(":checked")) {
            $('.user-view').attr('style', 'display: none !important');
            $("#course-lists").css("max-height", "calc(100vh - 8rem)");
            set_userview("checked");
        } else {
            $(".user-view").show();
            $("#course-lists").css("max-height", "calc(100vh - 12rem)");
            set_userview("unchecked");
        }
    }

    //Change theme colour
    function toggleTheme() {
        var userid = <?php echo $user_ID ?>;
        if (document.body.classList.contains("dark")) {
            document.body.classList.remove("dark");
            document.body.classList.toggle("light");
            var theme = "light";
        } else {
            document.body.classList.remove("light");
            document.body.classList.toggle("dark");
            var theme = "dark";
        }

        $.ajax({
            url: '../Theme/theme.php',
            type: 'post',
            data: {
                theme: theme,
                userid: userid,
            }
        });
    }

    if (document.body.classList.contains("light")) {
        document.getElementById("themeToggle").checked = false;
    } else {
        document.getElementById("themeToggle").checked = true;
    }
</script>