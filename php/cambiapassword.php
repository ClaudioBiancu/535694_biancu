<?php
session_start(); //apro la sessione
include("db_con.php"); // includo il file di connessione al database
$VecchiaPass = isset($_POST['VecchiaPass']) ? $_POST['VecchiaPass'] : NULL;
$NuovaPass = isset($_POST['NuovaPass']) ? $_POST['NuovaPass'] : NULL;
$ConfermaPass= isset($_POST['ConfermaPass']) ? $_POST['ConfermaPass'] : NULL;
$result = mysqli_query($con,"SELECT Password
                             FROM utente
                             WHERE UserName='".$_SESSION["username"]."'");
$query_pass = mysqli_fetch_object($result);
if ($query_pass->Password==$VecchiaPass) {
  $change= mysqli_query($con,"UPDATE utente
                              SET Password='".$NuovaPass."'
                              WHERE UserName='".$_SESSION["username"]."'");
  $_SESSION["password"]=$NuovaPass;
  echo'<script> alert("Password modificata correttamente")</script>';
  echo'<script>window.top.location.reload();</script>';
}
else{
   echo'<script> alert("Vecchia Password Errata")</script>';
   echo'<script>window.top.location.reload();</script>';
}

?>
