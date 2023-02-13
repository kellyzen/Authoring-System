<?php
if (empty($_SESSION['loggedin'])) :
    header('Location: ../Dev/Login/login.php');
endif;
?>