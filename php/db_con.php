<?php
$nomeHost = "localhost";
$nomeUtente = "root";
$password = "";
$nomeDb = "avis";
$con= new mysqli($nomeHost, $nomeUtente, $password,
$nomeDb);
if ($con->connect_error) {
die('Connect Error (' . $con->connect_errno . ') '
. $con->connect_error);
}

?>
