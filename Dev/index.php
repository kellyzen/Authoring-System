<?php include 'head.php'; ?>

<body class="light">
    <div class="main-container">
        <?php include 'navbar.php'; ?>

        <div id="main-dashboard" class="main-dashboard">
            <?php include 'Dashboard/dashboard.php'; ?>
        </div>
        <div id="main-profile" class="main-profile" style="display: none;">
            <?php include 'Profile/profile.php'; ?>
        </div>
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
        document.getElementById("main-profile").style.display = "block";
        document.getElementById("main-dashboard").style.display = "none";
    });

    //Switch to dashboard page
    let dashboard = document.querySelector("#dashboard");
    
    dashboard.addEventListener("click", () => {
        document.getElementById("main-dashboard").style.display = "block";
        document.getElementById("main-profile").style.display = "none";
    });
</script>