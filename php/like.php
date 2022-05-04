<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
  $usernamepost = isset($_POST['usernamepost']) ? $_POST['usernamepost'] : NULL;
  $tempo= isset($_POST['tempost']) ? $_POST['tempost'] : NULL;
  $scelta=isset($_POST['scelta']) ? $_POST['scelta'] : NULL;
  $codice=$_POST['codice'];
  if($scelta=="like")
  $tiny=1;
  else
  $tiny=0;

  $rapporto=mysqli_query($con,"INSERT INTO postlike (Autore,TimeSt, UtenteLike, Adesso, LikeDislike) VALUES ('$usernamepost','$tempo','$username', CURRENT_TIMESTAMP, '$tiny')");
  if($scelta=="like"){
    $aumentalike=mysqli_query($con, "UPDATE post  SET  MiPiace= MiPiace + 1 WHERE UserName='$usernamepost'AND Tempo='$tempo'");
    $stampalike=mysqli_query($con, "SELECT P.MiPiace  FROM post P WHERE P.UserName='$usernamepost' AND P.Tempo='$tempo'");
    $numerolike=mysqli_fetch_object($stampalike);
    echo $usernamepost.";".$username.";".$tempo.";".$scelta.";".$numerolike->MiPiace.";".$codice;
  }
  else{
    $aumentadislike=mysqli_query($con, "UPDATE post  SET Dislike=Dislike+1 WHERE UserName='$usernamepost'AND Tempo='$tempo'");
    $stampalike=mysqli_query($con, "SELECT P.Dislike  FROM post P WHERE P.UserName='$usernamepost' AND P.Tempo='$tempo'");
    $numerolike=mysqli_fetch_object($stampalike);
    echo $usernamepost.";".$username.";".$tempo.";".$scelta.";".$numerolike->Dislike.";".$codice;

  }
?>
