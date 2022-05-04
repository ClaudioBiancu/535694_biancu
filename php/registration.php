<?php
session_start(); //apro la sessione
include("db_con.php"); // includo il file di connessione al database
if($_POST["nome"] != "" && $_POST["cognome"] != "" && $_POST["username"] != "" && $_POST["email"] != "" && $_POST["password"]!= "" && $_POST["anno"] != ""  &&
$_POST["mese"] != ""  && $_POST["giorno"] != "" && $_POST["sesso"] != "" && $_POST["provincia"] != "" && $_POST["citta"] != "" && $_POST["indirizzo"] != "" &&
$_POST["telefono"] != ""){  // se i parametri non sono vuoti
	$hash=md5( rand(0,1000) );
	//CONTROLLO PER LE SQL INJECTIONS
	$Nome=mysqli_real_escape_string($con,$_POST["nome"]);
	$Cognome=mysqli_real_escape_string($con,$_POST["cognome"]);
	$Username=mysqli_real_escape_string($con,$_POST["username"]);
	$Email=mysqli_real_escape_string($con,$_POST["email"]);
	$Password=mysqli_real_escape_string($con,$_POST["password"]);
	$Anno=mysqli_real_escape_string($con,$_POST["anno"]);
	$Mese=mysqli_real_escape_string($con,$_POST["mese"]);
	$Giorno=mysqli_real_escape_string($con,$_POST["giorno"]);
	$Nascita=$Giorno."-".$Mese."-".$Anno;
	$Sesso=mysqli_real_escape_string($con,$_POST["sesso"]);
	$Provincia=mysqli_real_escape_string($con,$_POST["provincia"]);
	$Citta=mysqli_real_escape_string($con,$_POST["citta"]);
	$Indirizzo=mysqli_real_escape_string($con,$_POST["indirizzo"]);
	$Telefono=mysqli_real_escape_string($con,$_POST["telefono"]);

	$query_registrazione = mysqli_query($con,"INSERT INTO utente (Nome, Cognome, username, Email, Password, DataNascita, Sesso, Provincia, Citta, Indirizzo, Hash, Telefono)
	VALUES ('".$Nome."','".$Cognome."','".$Username."','".$Email."','".$Password."','".$Nascita."','".$Sesso."','".$Provincia."','".$Citta."','".$Indirizzo."','".$hash."','".$Telefono."')") // scrivo sul DB questi valori
	or die ("query di registrazione non riuscita".mysqli_error()); // se la query fallisce mostrami questo errore
	}
	$queryimmaginedef=mysqli_query($con,"INSERT INTO immprofilo (Username) VALUES ('$Username')");
if(isset($query_registrazione)){ //se la reg è andata a buon fine
	$_SESSION["logged"]=true; //restituisci vero alla chiave logged in SESSION
	$_SESSION["username"]=$_POST["username"];
	$_SESSION["password"]=$_POST["password"];
	header("location: ../profilo2.php");
}
else{
	echo "non ti sei registrato con successo"; // altrimenti esce scritta a video questa stringa
}

?>
