<?php
session_start(); //apro la sessione
include("db_con.php"); // includo il file di connessione al database
$Anno=mysqli_real_escape_string($con,$_POST["anno"]);
$Mese=mysqli_real_escape_string($con,$_POST["mese"]);
$Giorno=mysqli_real_escape_string($con,$_POST["giorno"]);
$datadonazione=$Giorno."-".$Mese."-".$Anno;
$data=mysqli_real_escape_string($con,$datadonazione);

$myPost = array_values($_POST);
  for($i=3;$i<count($_POST);$i=$i+1){
  	if($myPost[$i]) {
      $User=$myPost[$i];

      $query1=mysqli_query($con,"INSERT INTO donazione (UserName,DataDonazione) VALUES ('".$User."','".$data."')");
      $querycontrollo=mysqli_query($con, "SELECT * FROM donatore WHERE UserName='".$User."');");
      if(!$querycontrollo)
        $query2=mysqli_query($con,"INSERT INTO donatore (UserName) VALUES ('".$User."')");
      $query3=mysqli_query($con,"UPDATE donatore SET NumeroDonazioniTot=NumeroDonazioniTot+1 WHERE UserName='".$User."'");
      $query4=mysqli_query($con, "UPDATE donatore SET GGProssimaDonazione=90  WHERE UserName='".$User."'");
    }
  }

  	header("location: ../amministratore2.php");

?>
