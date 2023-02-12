<?php
if (empty($_SESSION['loggedin'])) :
    header('Location: ../Login/login.php');
endif;
?>