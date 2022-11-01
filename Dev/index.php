<?php include 'head.php'; ?>

<!--remove class after implementing toggle dark/light mode-->

<body class="dark">
    <div class="main-container">
        <?php include 'navbar.php'; ?>
        <?php include 'Dashboard/dashboard.php'; ?>
    </div>
</body>

<!--Toggle sidebar-->
<script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
</script>