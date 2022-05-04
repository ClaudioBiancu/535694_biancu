<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
  $testo= isset($_POST['messaggioaiuto']) ? $_POST['messaggioaiuto'] : 'erroreTesto';
  $testo1=mysqli_real_escape_string($con,$testo);
  $post1=mysqli_query($con,"INSERT INTO messaggioutente (UserName, Testo) VALUES ('$username', '$testo1')");
  header("location: ../Iframe/aiuto.php");
?>
