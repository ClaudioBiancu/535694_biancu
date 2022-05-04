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
		<link rel="stylesheet" href="../Stili/IframeStyle/community.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="../Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="../Javascript/controlliprofilo.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
    <title>A chi posso donare</title>
	</head>
	<body >
    <div id="main">
      <h1 id="hincima"> Partecipa alla discussione</h1>
      <!--Div Post utenti-->
      <iframe id="desk" src="chat.php">

      </iframe>
      <!--Div Inserisci POST-->
      <div id="Scrivi">
        <form onsubmit="return false;" method='POST'>
          <b>Scrivi Post</b><br>
          <textarea id="testopost" name="testopost" cols="65" rows="5" maxlength="300" required></textarea><br>
          <input type="submit" onclick="AjaxManagerChat.preparaPost();" class="pulsante" value="Scrivi">
        </form>
      </div>
    </div>


	</body>
