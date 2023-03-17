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
    <input type='hidden' id='user_ID' value='<?php echo $user_ID ?>'>
    <input type='hidden' id='course_ID' value='<?php echo $course_ID ?>'>
</body>

<script type="text/javascript" src="index.js"></script>  