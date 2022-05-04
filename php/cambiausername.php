<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
    $result = mysqli_query($con,"UPDATE utente
                           SET UserName= \"" . $_POST['username'] . "\"
                           WHERE UserName='".$_SESSION["username"]."'");
    $change_img=mysqli_query($con,"UPDATE immprofilo
                           SET Username= \"" . $username . "\"
                           WHERE Username='".$_SESSION["username"]."'");
  $_SESSION["username"]=$username;
    if($result && $change_img){
      echo'<script> alert("UserName modificato correttamente") </script>';
      echo'<script>window.top.location.reload();</script>';
      }
    else{
      echo'<script> alert("Errore modifica UserName") </script>';
      echo'<script>window.top.location.reload();</script>';
    }
?>
