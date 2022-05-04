<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database

  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
  $tempo= isset($_POST['tempo']) ? $_POST['tempo'] : NULL;
  $query1=mysqli_query($con,"SELECT* FROM segnalazioni WHERE UserName='$username'AND Tempo='$tempo' ");
  if($result=mysqli_fetch_object($query1))
    mysqli_query($con,"UPDATE segnalazioni SET Numero=Numero+1 WHERE UserName='$username'AND Tempo='$tempo' ");
  else
    $query0=mysqli_query($con,"INSERT INTO segnalazioni(UserName,Tempo,Numero) VALUES('$username','$tempo',1) ");

?>
