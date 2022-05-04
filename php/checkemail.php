<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $email = isset($_POST['email']) ? $_POST['email'] : NULL;
  $result = mysqli_query($con,"SELECT * FROM utente WHERE Email = \"" . $email . "\";");
    while($row = mysqli_fetch_array($result)){
      if(($row['Email'] == $_POST['email'])){
        echo "Email già registrata";
        return;
      }
  }
?>