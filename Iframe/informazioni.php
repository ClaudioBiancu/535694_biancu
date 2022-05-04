<?php session_start();// come sempre prima cosa, aprire la sessione
  include("../php/db_con.php");// includere la connessione al database
?>
<?php if($_SESSION["logged"] == false)
		header("location: ../home.php");
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.jpg" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="../Stili/video2.css" type="text/css" media="screen"> <!-- css video principale-->
		<link rel="stylesheet" href="../Stili/IframeStyle/informazioni.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="../Stili/print.css" type="text/css" media="print">  <!-- css -->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
  	<title>InformazioniProfilo</title>
    <script>
      if (window.top == window.self)
      window.location.href = "../home.php";
    </script>
	</head>
	<body>
    <div id="libretto">
      <h1> Libretto Donatore </h1>
      <ul id="firstul">
          	<?php
              //Cerco nel Database i dati dell'Utente
              $select= mysqli_query($con,"SELECT * FROM Utente U WHERE U.username='".$_SESSION["username"]."'");
              $riga = mysqli_fetch_object($select);
              echo '<li><em>Nome: </em>  '; echo $riga->Nome; echo "</li>";
              echo '<li><em>Cognome: </em>  '; echo $riga->Cognome; echo "</li>";
              echo '<li><em>Data di Nascita: </em>  '; echo $riga->DataNascita; echo "</li>";
              $select1= mysqli_query($con,"SELECT * FROM donatore D WHERE D.username='".$_SESSION["username"]."'");
              $riga1 = mysqli_fetch_object($select1);
              if($riga1 && $riga1->GruppoSangue){
                echo '<li> Il tuo gruppo sanguigno: <em>'; echo $riga1->GruppoSangue; echo "</em></li>";
                if ($riga1->GGProssimaDonazione==0) {
                  echo '<li>Puoi donare alla prossima raccolta di sangue, ti faremo sapere appena possibile!</li></ul></div>';
                }
                else{
                  echo '<li> Mancano ancora <em>'; echo $riga1->GGProssimaDonazione; echo "</em> giorni prima che tu possa donare</li></ul></div>";
                }
                echo'<div id="DivDonazioni"> <h1> Le tue Donazioni</h1><br>';
                echo ' Hai donato <em>'; echo $riga1->NumeroDonazioniTot; echo "</em> volte<br><br>";
                echo'<ul  id="listaDonazioni">';
                $listadonazioni1=mysqli_query($con,"SELECT COUNT(*) AS Numerodonaz FROM donazione WHERE UserName='".$_SESSION["username"]."' ");
                $estraidonazione1 = mysqli_fetch_object($listadonazioni1);
                $listadonazioni=mysqli_query($con,"SELECT * FROM donazione WHERE UserName='".$_SESSION["username"]."' ORDER BY ABS(DataDonazione) DESC");
                $temp=$estraidonazione1->Numerodonaz;
                while($estraidonazione = mysqli_fetch_object($listadonazioni)){
                  echo '<li class="donazionis">';echo $temp; echo ") &nbsp&nbsp  "; echo $estraidonazione->DataDonazione;echo'</li> ';
                  $temp=$temp-1;
                }

                  echo'  </div>';
              }
              else{
                echo '<form method="post" action="../php/gruppoSangue.php">
                    <b>Inserisci il tuo Gruppo Sanguigno :</b>
                      <select id="Gruppo" name="Gruppo">
                        <option value="0 Rh-">0 Rh-</option>
                        <option value="0 Rh+">0 Rh+</option>
                        <option value="A Rh-">A Rh-</option>
                        <option value="A Rh+">A Rh+</option>
                        <option value="B Rh-">B Rh-</option>
                        <option value="B Rh+">B Rh+</option>
                        <option value="AB Rh-">AB Rh-</option>
                        <option value="AB Rh+">AB Rh+</option>
                      </select>
                      <input type="submit" id="InviaGruppo" class="pulsante" value="Invia">
                  </form>
                  </ul>
              </div>';
                }
    	     ?>

	</body>
