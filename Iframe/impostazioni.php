
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
		<link rel="stylesheet" href="../Stili/print.css" type="text/css" media="print">  <!-- css -->
		<link rel="stylesheet" href="../Stili/IframeStyle/impostazioni.css" type="text/css" media="screen"> <!--css profilo -->
		<script  src="../Javascript/controlliprofilo.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<script  src="../Javascript/ajaxManager.js"></script>
		<title>ImpostazioniProfilo</title>
    <script>
      if (window.top == window.self)
      window.location.href = "../home.php";
    </script>
	</head>
	<body>
		<h3 id="hincima">In questa sezione puoi modificare alcune proprietà del tuo profilo</h3>
		<section class="sectionimpostazioni">
		<!-- Form per caricamento immagine del profilo-->
			<form id="moduloimm" name= "moduloimm" method="post" enctype="multipart/form-data">
				<h3 > Seleziona una nuova foto profilo </h3>
				<div class="image-upload">
				    <label for="fileupload">
				        <img alt="camera" id="camera" src="../Immagini/camera.ico"/>
				    </label>
				    <input type="file" id="fileupload" onchange="attivabottone();" name="fileupload" />

				</div>
				<input class="pulsante" type="submit" id="fileuploadsubmit" name="fileuploadsubmit" onClick="controlloupload();" value="Carica" disabled />
			</form>
		</section>
		<section class="sectionimpostazioni">
			<h3 class="titolo"> Modifica Username </h3>
			<h3> Username attuale : <em><?php echo $_SESSION["username"];?> </em> </h3>
			<form action="../php/cambiausername.php" method="post">
				<h3> Inserisci qui il nuovo Username </h3>
				<input type="text" id="username" name="username" autocomplete="off" onkeyup="cambia('spanrispostausername'); AjaxManager.preparaUsername(2);"><br>
				 <span class="spanrisposta" id="spanrispostausername"></span><br>
				<input class="pulsante" type="submit" id="register" name="register" value="Cambia" disabled>
			</form>
		</section>
		<section class="sectionimpostazioni">
			<h3 class="titolo"> Modifica Password </h3>
			<form name="formpassword" method="post" onsubmit="return false;">
				<h3> Password Attuale: <input onkeyup="puliscispan();" type="Password" name="VecchiaPass" id="VecchiaPass"> </h3>
				<h3> Nuova Password:  <input onkeyup="puliscispan();" type="Password" name="NuovaPass" id="NuovaPass"> </h3>
				<h3> Conferma Password: <input onkeyup="puliscispan();" type="Password" name="ConfermaPass" id="ConfermaPass"> </h3>
				<span class="spanrisposta" id="spanrispostapassword"></span><br>
				<input class="pulsante "type="submit"  onclick="cambiapassword();" value="Cambia">
			</form>
		</section>
    <section class="sectionimpostazioni">
			<h3 class="titolo"> Modifica Gruppo Sanguigno </h3>
      <form method="post" action="../php/gruppoSangue.php">
          <b>Inserisci un nuovo Gruppo Sanguigno:  </b>
            <select id="Gruppo" name="Gruppo">
              <option value="0 Rh-">0 Rh-</option>
              <option value="0 Rh+">0 Rh+</option>
              <option value="A Rh-">A Rh-</option>
              <option value="A Rh+">A Rh+</option>
              <option value="B Rh-">B Rh-</option>
              <option value="B Rh+">B Rh+</option>
              <option value="AB Rh-">AB Rh-</option>
              <option value="AB Rh+">AB Rh+</option>
            </select><br><br>
            <input type="submit" id="InviaGruppo" class="pulsante" value="Cambia">
        </form>
		</section>

    <section class="sectionimpostazioni" id="sezioneElimina">
			<h3 class="titolo"> Elimina Profilo </h3>
      <b>Vuoi eliminare il tuo profilo?</b><br><br>
      <form id="moduloeliminazione" name=" moduloeliminazione" onsubmit="return false" action="../php/eliminaprofilo.php">
      <button id="pulsanteelimina"
      <?php /*DISATTIVO PULSANTE ELIMINA SE L'UTENTE IN SESSIONE È AMMINISTRATORE*/
        $username=$_SESSION['username'];
        $controlloAdmin= mysqli_query($con,"SELECT * FROM admin U WHERE U.username='$username';");
        if($riga = mysqli_fetch_object($controlloAdmin)){
          echo 'disabled  ';
        }
      ?>
       onclick="if (confirm('Sei sicuro di voler eliminare il profilo?')) {
        moduloeliminazione.submit();
      } else {
          // non fare niente
      };"class="pulsante"> Elimina </button>
  </form>
		</section>
	</body>
</html>
