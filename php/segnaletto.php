<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
  $tempo=isset($_POST['tempo']) ? $_POST['tempo'] : NULL;
    $result = mysqli_query($con,"SELECT * FROM messaggioutente
                           WHERE UserName='$username' AND Tempo='$tempo' AND Letto=0");
    if($variabile=mysqli_fetch_object($result)){
      $change_img=mysqli_query($con,"UPDATE messaggioutente
                                     SET Letto=1
                                     WHERE Tempo='$tempo'");
    }


?>
