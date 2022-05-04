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
		<link rel="stylesheet" href="../Stili/IframeStyle/aiuto.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="../Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="../Javascript/controlliprofilo.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
    <script>
      if (window.top == window.self)
      window.location.href = "../home.php";
    </script>
    <title>A chi posso donare</title>
	</head>
	<body>
		<section class="sectionaiuto">
      <h3>Vogliamo che la tua esperienza sul sito sia la migliore possibile.<br><br>
      <em> Qui puoi inviarci un messaggio, ti aiuteremo il prima possibile.</em></h3><br><br>
      <form id="formmessaggio" onsubmit="return false" method="post" action="../php/messaggioutente.php">
      <textarea onkeyup="AttivaAiuto();" onclick="this.value=''" maxlength="300" name=" messaggioaiuto" id="messaggioaiuto" rows="10" cols="80" required>Scrivi qui il tuo messaggio...
      </textarea><br>
      <input id="pulsanteaiuto" disabled type="submit" onclick="messaggio();" value="Invia" class="pulsante">
    </form><br>
    <h3>I tuoi messaggi</h3>
    <?php
    $stampa1=mysqli_query($con, "SELECT COUNT(*) AS Numero FROM messaggioutente WHERE UserName= '".$_SESSION["username"]."' AND Revisione=0");
    if($riga0=mysqli_fetch_object($stampa1)){ echo'<h3>Hai <em>'.$riga0->Numero.'</em> messaggi in attesa di risposta</h3>';
    }
    ?>
      <ul>
        <?php
        $stampa=mysqli_query($con, "SELECT * FROM messaggioutente WHERE UserName= '".$_SESSION["username"]."' AND Revisione = '1' ORDER BY Codice DESC");
        $stampa1=mysqli_query($con, "SELECT * FROM messaggioutente WHERE UserName= '".$_SESSION["username"]."' AND Revisione = '1' ORDER BY Codice DESC");
        if(!($riga1=mysqli_fetch_object($stampa))){
          echo'<li style="color:red">Al momento non sono presenti messaggi </li>';
        }
        while($riga=mysqli_fetch_object($stampa1)){
          $Testoprova=mysqli_real_escape_string($con,$riga->Testo);
          $Testoprova1=mysqli_real_escape_string($con,$riga->TestoRisposta);

          echo'<li id="'. $riga->Codice .'" onclick="ApriMessaggio(\''.$riga->UserName."','".$riga->Tempo."','".$riga->Codice."','".$Testoprova."','".$Testoprova1.'\')">';
          if($riga->Letto){
            echo'<img alt="messaggioletto" id="'. $riga->Codice .'img" src="../Immagini/messaggioletto.png" height="30" width="30">Messaggio del:  '. $riga->Tempo .'<div id="'.$riga->Codice."stato".'"style="float:right; margin-right:1em;">Messaggio Letto</div></li>';
          }
          else{
            echo'<img alt="messaggiononletto" id="'. $riga->Codice .'img" src="../Immagini/messaggiononletto.png" height="30" width="30"><em id="'.$riga->Codice."em".'">Messaggio del:  '. $riga->Tempo .'<div id="'.$riga->Codice."stato".'" style="float:right;margin-right:1em;">Messaggio da Leggere</div></em></li>';
          }
        }
        ?>
      </ul>
      <div onblur="ChiudiSegn()" id="AppareSegnalazione">
        <div id="chiudisegn">
          <a onclick="ChiudiSegn()"> Chiudi </a>
        </div><br>
        <h4 id="TitoloSegnalazione"></h4>
        <h3 style="color:red"> Testo Messaggio:</h3>
        <div class="testoaiuto" id="TestoSegnalazione">
        </div><br>
        <h3 style="color:red"> Testo Risposta:</h3>
        <div class="testoaiuto" id="TestoMessaggio">
        </div><br>
        <div id="TestoRisposta">
        </div>
      </div>
    </section>

	</body>
