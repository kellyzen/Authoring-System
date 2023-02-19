<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('Location:Login/login.php');
} else {
    //new course
}
include 'head.php';
include 'config.php';

$sql = "SELECT theme FROM user where username='$_SESSION[username]';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $theme = $row["theme"];
    }
}
?>

<body class="<?php echo $theme; ?>">
    <div class="main-container">
        <?php 
        include 'navbar.php'; 

        if ($_GET['id'] == NULL) {
            include 'Profile/profile.php';
        } else {
            include 'Dashboard/dashboard.php';
        }
        
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

    //Switch to profile page
    let profile = document.querySelector("#profile");

    profile.addEventListener("click", () => {
        //document.getElementById("main-profile").style.display = "block";
        //document.getElementById("main-dashboard").style.display = "none";
    });

    //Switch to dashboard page
    let dashboardButton = document.querySelector("#dashboardButton");

    dashboardButton.addEventListener("click", () => {
        //document.getElementById("main-dashboard").style.display = "block";
        //document.getElementById("main-profile").style.display = "none";
    });
</script>