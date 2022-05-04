<?php
  session_start(); //apro la sessione
  include("../db_con.php"); // includo il file di connessione al database

  $query_registrazione = mysqli_query($con,"INSERT INTO infodon (Testo) VALUES ('".$_POST["textarea"]."')") // scrivo sul DB il testo
  or die ("query di registrazione non riuscita".mysqli_error()); // se la query fallisce mostrami questo errore

if(isset($query_registrazione)){
  echo 'Avviso inserito correttamente, Home Aggiornata';
  return;
}
else
  echo "Il tuo avviso non è stato inserito correttamente";
?>
