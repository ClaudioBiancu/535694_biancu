<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database

  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
  echo $username;
  $query0=mysqli_query($con,"DELETE FROM post WHERE UserName='$username' ");
  $query1=mysqli_query($con,"DELETE FROM postlike WHERE Autore='$username' ");
  $query2=mysqli_query($con,"DELETE FROM segnalazioni WHERE UserName='$username' ");
  $query3=mysqli_query($con,"DELETE FROM utente WHERE UserName='$username' ");
  $query4=mysqli_query($con,"DELETE FROM messaggioutente WHERE UserName='$username' ");
  $query5=mysqli_query($con,"DELETE FROM immprofilo WHERE Username='$username' ");
  $query6=mysqli_query($con,"DELETE FROM donazione WHERE UserName='$username' ");
  $query7=mysqli_query($con,"DELETE FROM donatore WHERE UserName='$username' ");
  $_SESSION = array();
  unset($_SESSION["logged"]);
  session_destroy();
  echo "<script>window.top.location.href = \"../home.php\";</script>";


?>
