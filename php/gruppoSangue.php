<?php
session_start(); //apro la sessione
include("db_con.php"); // includo il file di connessione al database

	if(isset($_POST['Gruppo'])) {
	 	$gruppos = $_POST['Gruppo'];
    $username= $_SESSION["username"];
		$controllo= mysqli_query($con,"SELECT * FROM donatore WHERE UserName='".$username."'");
		$query = mysqli_fetch_object($controllo);
		if($query){
			$aggiornamento=mysqli_query($con,"UPDATE donatore
												 SET GruppoSangue='".$gruppos."'
												 WHERE UserName='".$_SESSION["username"]."'")
			  or die ("query di registrazione non riuscita1");
		}
		else{
		$inserimento = mysqli_query($con,"INSERT INTO donatore (GruppoSangue, UserName) VALUES ('".$gruppos."','".$username."')")
		  or die ("query di registrazione non riuscita2");
		}// se la query fallisce mostrami questo errore
      if($inserimento || ($query && $aggiornamento)){
        echo'<script>window.top.location.reload();</script>';
        }
      else{
        echo'<script> alert("Errore reinserisci Gruppo") </script>';
        echo'<script>window.top.location.reload();</script>';
      }
}
?>
