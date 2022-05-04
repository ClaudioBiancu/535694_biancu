<?php
  session_start(); //apro la sessione
  include("../db_con.php"); // includo il file di connessione al database
  if(substr($_POST["SelRH"],-1,1)!="-"){
    $gruppo=$_POST["SelRH"]."+";
  }
  else{
  $gruppo=$_POST["SelRH"];
  }
  $query_rh = mysqli_query($con,"SELECT U.Nome,U.Cognome,U.UserName
                                 FROM Utente U INNER JOIN  Donatore D ON U.UserName=D.UserName
                                 WHERE GruppoSangue='$gruppo'");
$risposta="";
  while($temp = mysqli_fetch_object($query_rh)){
    $risposta=$risposta.$temp->Nome.",".$temp->Cognome.",".$temp->UserName.".";
  }


  echo $risposta;

?>
