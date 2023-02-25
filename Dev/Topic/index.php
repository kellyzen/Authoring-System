<?php include '../skeleton.php'; ?>

<head>
  <meta charset="UTF-8">
  <title>Topic | stud.io</title>
</head>

<body class="<?php echo $theme; ?>">
    <div class="main-container">
        <?php 
        include '../navbar.php';
        include 'topic.php';
        ?>
    </div>
</body>

<script>
    //Tooltip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
