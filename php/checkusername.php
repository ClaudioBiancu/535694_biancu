<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $username = isset($_POST['username']) ? $_POST['username'] : NULL;
    $result = mysqli_query($con,"SELECT * FROM utente WHERE UserName = \"" . $username . "\";");
    while($row = mysqli_fetch_array($result)){
      if(($row['UserName'] == $_POST['username'])){
        echo "Username non disponibile.";
        return;
      }
  }
?>