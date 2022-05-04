<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database

  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
  $tempo= isset($_POST['tempo']) ? $_POST['tempo'] : NULL;
  $codice= isset($_POST['codice']) ? $_POST['codice'] : NULL;
  $query0=mysqli_query($con,"DELETE FROM post WHERE UserName='$username' AND Tempo='$tempo' ");
  $query1=mysqli_query($con,"DELETE FROM postlike WHERE Autore='$username' AND TimeSt='$tempo' ");
  $query2=mysqli_query($con,"DELETE FROM segnalazioni WHERE UserName='$username' AND Tempo='$tempo' ");
  echo $codice;

?>
