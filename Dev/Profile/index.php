<?php include '../skeleton.php'; ?>

<head>
  <meta charset="UTF-8">
  <title>Profile | stud.io</title>
</head>

<body class="<?php echo $theme; ?>">
    <div class="main-container">
        <?php 
        include '../navbar.php';
        include 'profile.php';
        ?>
    </div>
</body>

<script>
    //Tooltip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
