<?php session_start();// come sempre prima cosa, aprire la sessione
 include("./php/db_con.php"); // includere la connessione al database// includere la connessione al database
	if($_SESSION["logged"] == false) {
		header("location: home.php");
	}
	$query2 = mysqli_query($con,"SELECT * FROM admin WHERE username='".$_SESSION["username"]."'");
	if(mysqli_num_rows($query2) == 0){
		die(header("location: home.php"));
	}

?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css video principale-->
		<link rel="stylesheet" href="./Stili/amministratore.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="./Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="./Javascript/amministratore/controlli.js"></script>
    <script  src="./Javascript/controlloregistrazione.js"></script>
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<title>Profilo Admin</title>
	</head>
	<body>
    <nav id="LogoAlto">
      <a id="Aimmagine" href="./home.php"> <img class="logoHome" src="./Immagini/logo2.png" alt="Il logo dell'Avis"></a>
    </nav>
				<div id="menu">
					<!-- Lista generale -->
					<ul>
						<!-- 1° Elemento	-->
						<li><a href="home.php" class="NavBut">  Home </a>
						</li>
            <!-- 1.5 Elemento -->
						<?php
						if(isset($_SESSION["logged"])){
							echo '<li ><a class="NavBut" href="profilo2.php"> Profilo </a>' ;
						}
						?>
            <!-- 2° Elemento -->
            <li>
              <a href="donazione.php">Donazione</a>
            </li>

            <!-- 3° Elemento -->
            <li><a href="home.php#MainContact">Contatti</a></li>


            <!--:::::::::::::::::::::::::::::::::::::::::SECONDO Script PHP:::::::::::::::::::::::::::::::::::::::::::-->
                  <!--Se l'Utente è loggato apparirà nella barra anche il pulsante di LOGOUT-->
            <?php
            if(isset($_SESSION["logged"]))
            echo '<li><a id="alogout" href="./php/logout.php" class="NavBut">Logout</a></li>';

            ?>
            <!--::::::::::::::::::::::::::::::::FINE SCRIPT (CONTROLLO LOGOUT)::::::::::::::::::::::::::::::::::::::::-->

          </ul>
				</div>
			</nav>
			<div id="container">
        <h2>Pagina di amministrazione</h2>
			<div id="MainProfile">
        <section id="sectiontool">
          <h3> Seleziona lo strumento che vuoi utilizzare</h3>
          <ul id="ultool">
            <li class="pulsantetool" id="pulsantetool1" onclick="MostraTool(1)">
              Inserisci Nuovi Avvisi<br>
              <em>"Permette di inserire un nuovo avviso o una nuova donazione sulla HomePage" </em>
            </li>
            <li class="pulsantetool" id="pulsantetool2" onclick="MostraTool(2)">
              Registra Nuova Donazione<br>
              <em>"Permette di registrare una donazione: la sua data e le persone che vi hanno preso parte"</em>
            </li>
            <li class="pulsantetool" id="pulsantetool3" onclick="MostraTool(3)">
              Ricerca Per Gruppo Sanguigno<br>
              <em>"Permette di effettuare una rapida ricerca degli utenti aventi un determinato gruppo sanguigno"</em>
            </li>
            <li class="pulsantetool" id="pulsantetool4" onclick="MostraTool(4)">
              Gestione Segnalazioni Post<br>
              <em>"Permette di gestire le segnalazioni ai post degli utenti della community"</em>
            </li>
            <li class="pulsantetool" id="pulsantetool5" onclick="MostraTool(5)">
              Richieste d'aiuto Utenti<br>
              <em>"Permette di rispondere ai messaggi di aiuto degli utenti"</em>
            </li>
          </ul>
        </section>


        <section id="tool1" class="sezioniAmm" >
					<form method="post" name="moduloavviso" onsubmit="return false">
						<h3>Inserimento nuovo avviso nella sezione Home</h3>
						<textarea id="textarea" name="textarea" cols="65" rows="12" maxlength="300" required></textarea><br>
						<button class="pulsante" onclick="AjaxAmministratore.controlloavviso();"> Inserisci Avviso </button>
					</form>
          <form id="modulodonazione"  method="post" onsubmit="return false">
            	<h3>Inserimento informazioni relative alla prossima Donazione</h3>
              <textarea id="textarea1" name="textarea1" cols="65" rows="12" maxlength="300" required></textarea><br>
  						<button class="pulsante" onclick="AjaxAmministratore.controllonuovadonazione();"> Inserisci Informazioni </button>
          </form>
				</section>

        <section id="tool2" class="sezioniAmm">
          <h3>Registrazione nuova donazione </h3><br>
          Inserisci la data della donazione: <br><br>
          <form method="post" action="./php/donazione.php">
            <select onchange="ControllaMese();" id="giorno" name="giorno">
              <?php
              for ($i = 0; $i <= 31; $i++) {
                if($i==0){
                  echo '<option value="-"> - </option>';
                }
                else{
                  echo '<option value="'; echo $i; echo '">'; echo $i; echo'</option>';
                }
                }
              ?>
            </select>
            <select onchange="ControllaBisestile();" id="mese" name="mese" disabled> </select>
            <select id="anno" name="anno" onchange="document.getElementById('buttonDonazione').disabled=false;" disabled> </select><br> <br>
            Seleziona i profili che hanno donato in questo giorno:<br>
            <ul id="listaDonatori">
            <?php
            $var=4;
            $select= mysqli_query($con,"SELECT U.UserName,U.Nome, U.Cognome FROM Utente U ORDER BY U.Nome;");
            while($riga = mysqli_fetch_object($select)){
              echo '<li><input name="box';echo $var; echo'" id="box';echo $var; echo'" type="checkbox" value="'; echo $riga->UserName;echo' ">';
              echo'<label for="box';echo $var; echo'">'; echo  $riga->Nome; echo' '; echo  $riga->Cognome; echo '     ('; echo  $riga->UserName; echo')'; echo'</label>';
              echo '</li>';
              $var=$var+1;
            }
            ?>
          </ul><br><br>
          <button id="buttonDonazione"class="pulsante" onclick="alert('Registrazione inserita correttamente');" disabled> Registra Donazione </button>
          </form>
        </section>
        <section id="tool3" class="sezioniAmm">
          <h3>Ricerca per gruppo sanguigno </h3><br><br>
            <form method="post" onsubmit="return false;">
                  <select id="SelRH" name="SelRH" name="Gruppo">
                    <option value="0 Rh-">0 Rh-</option>
                    <option value="0 Rh">0 Rh+</option>
                    <option value="A Rh-">A Rh-</option>
                    <option value="A Rh">A Rh+</option>
                    <option value="B Rh-">B Rh-</option>
                    <option value="B Rh">B Rh+</option>
                    <option value="AB Rh-">AB Rh-</option>
                    <option value="AB Rh">AB Rh+</option>
                  </select><br><br>
                  <input type="submit" id="InviaGruppo" onclick="AjaxAmministratore.controllorh();" class="pulsante" value="Cerca">
              </form>
            <div id="listagruppi">
              <ul id="ullistagruppi" >
              </ul>
            </div>
        </section>
        <section id="tool4"class="sezioniAmm">
        <h3> Segnalazioni degli Utenti </h3><br><br>
        <ul id="listaSegnalazioni">
        <?php
            $select= mysqli_query($con,"SELECT S.UserName, S.Tempo, S.Numero, P.Testo, P.CodicePost FROM Segnalazioni S INNER JOIN Post P ON S.UserName=P.UserName WHERE S.Tempo=P.Tempo ORDER BY Numero ;");
            $select1= mysqli_query($con,"SELECT S.UserName, S.Tempo, S.Numero, P.Testo, P.CodicePost FROM Segnalazioni S INNER JOIN Post P ON S.UserName=P.UserName WHERE S.Tempo=P.Tempo ORDER BY Numero ;");
            $var=0;
            if(!($riga=mysqli_fetch_object($select1))){
              echo'<li style="color:red">Al momento non sono presenti segnalazioni </li>';
            }
            while($riga = mysqli_fetch_object($select)){
              $stringa_corta = substr($riga->Tempo,0,10);
              echo '<li id="'; echo $riga->CodicePost ;
               echo '" onclick="DivTesto(\''; echo $riga->UserName."','".$riga->Tempo."','".$riga->Numero."','".$riga->CodicePost."','".$riga->Testo.'\')"';
               echo' class="segnalazione">';
               echo '  Post di:'; echo $riga->UserName; echo'  del: '; echo $stringa_corta; echo' </li>';
            }
        ?>
      </ul>
        <div onblur="ChiudiSegn(0)" id="AppareSegnalazione">
          <div id="chiudisegn">
						<a onclick="ChiudiSegn(0)"> Chiudi </a>
					</div><br>
          <h4 id="TitoloSegnalazione">.</h4>
          <h3 style="color:red"> Testo del Post:</h3>
          <div id="TestoSegnalazione">
          </div><br>

          <input id="MantieniPul" type="submit" onclick="" class="pulsante" value="Mantieni">
          <input id="EliminaPul" type="submit" onclick="" class="pulsante" value="Elimina">
        </div>

        </section>
        <section id="tool5" class="sezioniAmm">
            <h3> Messaggi degli Utenti </h3><br><br>
            <ul id="listaMessaggi">
              <?php
                $select1=mysqli_query($con, "SELECT S.UserName, S.Tempo, S.Testo, S.Codice FROM messaggioutente S WHERE Revisione=0");
                $select2=mysqli_query($con, "SELECT S.UserName, S.Tempo, S.Testo, S.Codice FROM messaggioutente S WHERE Revisione=0");
                if(!($riga0=mysqli_fetch_object($select1))){
                  echo'<li style="color:red">Al momento non sono presenti messaggi </li>';
                }
                while($riga1 = mysqli_fetch_object($select2)){
                  $stringa_corta1 = substr($riga1->Tempo,0,10);
                  echo '<li id="'; echo $riga1->Codice."mess";
                   $Testoprova=mysqli_real_escape_string($con,$riga1->Testo);
                   echo '" onclick="var prova=\''.$Testoprova.'\' ; DivAiuto(\''; echo $riga1->UserName."','".$riga1->Codice."','".$riga1->Tempo.'\',prova)"';
                   echo' class="segnalazione">';
                   echo '  Messaggio di: '; echo $riga1->UserName; echo'  del: '; echo $stringa_corta1; echo' </li>';
                 }
               ?>
            </ul>
               <div onblur="ChiudiSegn(1)" id="AppareMessaggio">
                 <div id="chiudisegn1">
       						<a onclick="ChiudiSegn(1)"> Chiudi </a>
       					</div><br>
                 <h4 id="TitoloMessaggio">.</h4>
                 <h3 style="color:red"> Testo del Messaggio:</h3>
                 <div id="TestoUtente">
                 </div><br>
                 <h3 style="color:red"> Inserisci la Risposta:</h3>
                 <textarea onkeyup="" id="TestoRisposta" cols="100" rows="8"></textarea>

                 <br><input id="InviaRisposta" disabled type="submit" onclick="" class="pulsante" value="Rispondi">

               </div>

        </section>
			</div>


			<div class="push">
			</div>
		</div>
		<footer>
      <em>Corso di Progettazione Web - Claudio Biancu <a href="documentazione.html">Documentazione</a></em>
			<strong>Powered by MrWhiteMtd</strong>
		</footer>
  </body>
