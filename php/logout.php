<?php
session_start();
$_SESSION = array();
unset($_SESSION["logged"]);
session_destroy();
header('Location: ../home.php');
exit;
 ?>
