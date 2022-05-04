 <?php
session_start();// come sempre prima cosa, aprire la sessione
include("./php/db_con.php"); // includere la connessione al database
if(isset($_SESSION["logged"])){
	header("location: home.php");
}
?><!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css -->
		<link rel="stylesheet" href="./Stili/index.css" type="text/css" media="screen"> <!-- css index -->
		<link rel="stylesheet" href="./Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script src="./Javascript/ajaxManager.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<title>AVIS Siniscola</title>
	</head>
	<body>
    <a id="Aimmagine" href="./home.php"> <img class="logoHome" src="./Immagini/logo2.png" alt="Il logo dell'Avis"></a>
		<div id= "index2" class="navindex">
			<form onsubmit="return false;">
			<h3>Login</h3>
			<strong>UserName</strong> <br>
			<input type="text" name="username" id="usernameloginindex" required>
			<br><br>
			<strong>Password</strong> <br>
			<input type="password" name="password" id="passloginindex" required><br><span class="spanrisposta" id="spanrispostalogin"></span>
			 <br>
			<button class="pulsante" onclick="AjaxManager.preparaLogin();" > Accedi </button> <br> <!-- Bottone Login-->
			<br>
			<h4>Vuoi diventare un donatore anche tu? </h4>
			<!--BottoneRegistrati-->
			<button class="pulsante" onclick="document.location.href='registrazione.php';" >Registrati </button>
			</form>
		</div>
		<div id="index1" class="navindex">
      <article>
      <h3>Benvenuto</h3>

				 <p>Stai per entrare nel sito<br> dell'<em>Avis Comunale di Siniscola</em>.<br>
           Qui potrai metterti in gioco.
           <br><br>Essere Donatori Volontari,<br> è una <em>Necessità</em>,<br> è un <em>Diritto</em>,
            <br> è un’<em>Occasione</em> <br>per contare.</p>
			</article><br>
			 <!--<h4> Vai alla HOME </h4> -->
			<button class="pulsante" onclick="document.location.href='home.php';" > Vai alla Homepage</button>
		</div>
    <footer>
      <em>Corso di Progettazione Web - Claudio Biancu <a href="documentazione.html">Documentazione</a></em>
      <strong>Powered by MrWhiteMtd</strong>
    </footer>
	</body>
