<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
  $testo= isset($_POST['testopost']) ? $_POST['testopost'] : erroreTesto;
  $post1=mysqli_query($con,"INSERT INTO post (UserName,Tempo, Testo) VALUES ('$username', CURRENT_TIMESTAMP, '$testo')");
?>
