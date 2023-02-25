<?php include '../skeleton.php'; ?>

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
</script>