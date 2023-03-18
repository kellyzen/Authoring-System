<?php 
include '../skeleton.php'; 
include '../session.php';
$user_ID = "$_SESSION[id]";
$topic_ID = $_GET['id'];
?>

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
    <input type='hidden' id='user_ID' value='<?php echo $user_ID ?>'>
    <input type='hidden' id='topic_ID' value='<?php echo $topic_ID ?>'>
</body>

<script type="text/javascript" src="index_topic.js"></script>  
