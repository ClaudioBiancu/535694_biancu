<?php
session_start(); //apro la sessione
include("db_con.php"); // includo il file di connessione al database

	if(isset($_POST['fileuploadsubmit'])) {
	 	$fileupload = $_FILES['fileupload']['name'];
	 	$fileuploadTMP = $_FILES['fileupload']['tmp_name'];
	 	define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/Progetto/Immagini/Upload/');
		move_uploaded_file($fileuploadTMP, DOCROOT.$fileupload);
		$sql = mysqli_query($con,"INSERT INTO immprofilo (NomeImmagine, Username) VALUES ( '$fileupload','".$_SESSION["username"]."')")
		  or die ("query di registrazione non riuscita".mysqli_error()); // se la query fallisce mostrami questo errore
		if ($sql) {
			echo'<script>window.top.location.reload();</script>';
		}
}
?>