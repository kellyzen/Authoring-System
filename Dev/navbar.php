<?php
include 'session.php';
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM course where user_ID='$_SESSION[id]';");
$count = mysqli_num_rows($query);

if ($count != '0') {
    $row = mysqli_fetch_array($query);
    $id = $row['course_ID'];
}
?>

<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <i class="fal fa-solid fa-bars" id="btn"></i>
                <a class="navbar-logo text-decoration-none" href="<?php echo '?id='.$id; ?>">stud.io</a>
            </li>
            <li class="nav-item search-container">
                <div class="search-bar">
                    <input type="search" placeholder="Search for...">
                    <span class="search-bar_icons">
                        <i class="fal fa-brands fa-search"></i>
                        <i id="filter-icon" class="fal fa-solid fa-sliders" onclick="toggleFilterFunction()"></i>
                        <div id="filter-dropdown" class="filter-dropdown-content">
                            <div class="filter-dropdown-box">
                                <span>Course</span>
                                <label class="toggle" for="courseToggle">
                                    <input class="toggle__input" name="" type="checkbox" id="courseToggle">
                                    <div class="toggle__fill"></div>
                                </label>
                            </div>
                            <div class="filter-dropdown-box">
                                <span>Topic</span>
                                <label class="toggle" for="topicToggle">
                                    <input class="toggle__input" name="" type="checkbox" id="topicToggle">
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
                    <div id="profile" class="setting-dropdown-box">
                        <span>Profile</span>
                        <i class="fal fa-regular fa-user"></i>
                    </div>
                    <div class="setting-dropdown-box">
                        <span>User view</span>
                        <label class="toggle" for="viewToggle">
                            <input class="toggle__input" name="" type="checkbox" id="viewToggle">
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
                    <div id="logout" class="setting-dropdown-box">
                        <span>Logout</span>
                        <i class="fal fa-solid fa-sign-out"></i>
                    </div>
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

    //Show search bar filter dropdown on click
    function toggleFilterFunction() {
        document.getElementById("filter-dropdown").classList.toggle("show");
        document.getElementById("filter-icon").classList.toggle("active");
    }

    //Change theme colour
    function toggleTheme() {
        if (document.body.classList.contains("dark")) {
            document.body.classList.remove("dark");
            document.body.classList.toggle("light");
        } else {
            document.body.classList.remove("light");
            document.body.classList.toggle("dark");
        }

    }
</script>