<?php
  session_start(); //apro la sessione
  include("../db_con.php"); // includo il file di connessione al database

  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
  $tempo= isset($_POST['tempo']) ? $_POST['tempo'] : NULL;
  $codice= isset($_POST['codice']) ? $_POST['codice'] : NULL;

  $risposta=isset($_POST['risposta']) ? $_POST['risposta'] : NULL;
  $query0=mysqli_query($con,"UPDATE messaggioutente SET TestoRisposta='$risposta', Revisione=1 WHERE UserName='$username' AND Tempo='$tempo' ");
  if($query0)
   echo $codice;


?>
