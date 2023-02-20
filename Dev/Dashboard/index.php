<?php include '../skeleton.php'; ?>

<body class="<?php echo $theme; ?>">
    <div class="main-container">
        <?php 
        include '../navbar.php';
        include 'dashboard.php'; 

        /*if ($_GET['id'] == NULL) {
            include '../Profile/profile.php';
        } else {
            include 'dashboard.php';
        }*/
        
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
</script>