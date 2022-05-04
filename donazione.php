<?php
session_start();// come sempre prima cosa, aprire la sessione
include("./php/db_con.php"); // includere la connessione al database
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css -->
		<link rel="stylesheet" href="./Stili/donazione.css" type="text/css" media="screen"> <!-- css registrazione-->
		<link rel="stylesheet" href="./Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="./Javascript/ajaxManager.js"></script>
    <script src="./Javascript/controlliHome.js"></script>
    <script src="./Javascript/controllidonazione.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<title>Donazione</title>
	</head>
	<body>
      <nav id="LogoAlto">
        <a id="Aimmagine" href="./home.php"> <img class="logoHome" src="./Immagini/logo2.png" alt="Il logo dell'Avis"></a>
      </nav>
      <div id="AppareLogin">
        <div id="chiudi">
          <a onclick="ChiudiLogin()"> Chiudi </a>
        </div>

        <form onsubmit="return false;">
        <h3>Login</h3>
        <strong>UserName</strong> <br>
        <input type="text" name="username" id="usernameloginindex" autocomplete="off" required>
        <br><br>
        <strong>Password</strong> <br>
        <input type="password" name="password" id="passloginindex" required><br>
        <!--Span su cui appaiono gli avvisi di errore-->
        <span class="spanrisposta" id="spanrispostalogin"></span>
         <br>
        <button class="pulsante" onclick="AjaxManager.preparaLogin();" > Accedi </button> <br> <!-- Bottone Login-->

        <br>
        <h4>Vuoi diventare un donatore anche tu? </h4>
        <!--BottoneRegistrati-->
        <button class="pulsante" onclick="document.location.href='registrazione.php';" >Registrati </button>
        </form>
      </div>
          <div id="menu">
            <!-- Lista generale -->
            <ul>
              <!-- 1.5 Elemento -->
              <?php
  							if(isset($_SESSION["logged"])){
  								echo '<li ><a href="profilo2.php">'; echo $_SESSION["username"]; echo' </a></li>' ;
  							}
  							else{
  								echo	'<!-- 1° Elemento	-->
  									<li ><a class="NavBut" onclick="AppareLogin();" id="navlogin">Login</a
  									</li>';
  							}
  							?>
              <!-- 2° Elemento -->
              <li>
                <a href="">Donazione</a>
              </li>

              <!-- 4° Elemento -->
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

          <div id="divdonazione">
            <div>
              <em >La Donazione</em>
            </div>
          </div>
					<div id="SecondoDiv">
						<div>
							PROSSIMA DONAZIONE
							<br><br>
							<em>Abbiamo bisogno del tuo aiuto.</em> <br><br>
								<?php
								$query_registrazione = mysqli_query($con,"SELECT A.Testo, A.Data
																	FROM infodon A
																	WHERE A.Data=(SELECT MAX(A1.Data)
																				FROM infodon A1);") ;
									if( !$query_registrazione ){
										/* NESSUN RISULTATO */
										echo 'Al momento non sono presenti donazioni';
								}
								else{
										/* RISULTATO OK  */
									while ($riga = mysqli_fetch_object($query_registrazione)) {
										echo $riga->Testo;

									}
								}
								?>

						</div>
					</div>
					<div class="divdona">
						<img id="primaimmdon" alt="primaimmagine" src="./Immagini/primadonazione.png">
						<h3>Requisiti richiesti</h3>
						<p>
					 <em>	Età</em><br>
						18-60 anni (per candidarsi a diventare donatori).
						Chiunque desideri donare per la prima volta dopo i 60 anni può essere accettato a discrezione del medico responsabile della selezione. La donazione di sangue intero da parte di donatori periodici di età superiore ai 65 anni può essere consentita fino al compimento del 70° anno previa valutazione clinica dei principali fattori di rischio età correlati.
						<br><br><em>Peso</em><br>
						Non inferiore ai 50 kg.
						<br><br><em>Stato di salute</em><br>
						Buono.
						<br><br><em>Stile di vita</em><br>
						Nessun comportamento a rischio che possa compromettere la nostra salute e/o quella di chi riceve il nostro sangue.<br>

					<br><br>	L’idoneità alla donazione viene stabilita mediante un colloquio personale e riservato,
					 una valutazione clinica da parte di un medico e dopo aver effettuato gli esami di laboratorio
					  (prima donazione differita) previsti per garantire la sicurezza del donatore e del ricevente.
						<br>L’elenco completo dei requisiti fisici del donatore è contenuto nell’allegato IV del Decreto del Ministero della Salute del 2 novembre 2015 recante “Disposizioni relative ai requisiti di qualità e sicurezza del sangue e degli emocomponenti”.
						</p>
					</div>
					<div id="bordonero" class="divdona">
						<h3>Principali criteri
								di sospensione
								dalla donazione</h3>

					<p><em>4 mesi:</em><br> dopo piercing, tatuaggi, rapporti sessuali a rischio non reiterati (occasionali, promiscui), interventi chirurgici maggiori, agopuntura, endoscopie (es. gastroscopia, colonscopia).
					<br><br><em>6-12 mesi:</em><br> dopo il rientro da viaggi in zone dove esiste il rischio di contrarre malattie infettive tropicali.
					<br><br><em>6 mesi:</em><br> dopo il parto.
					<br><br><em>Periodi differenti:</em><br> per vaccinazioni, patologie infettive, assunzione di medicine.
					<br><br><em>Esclusione permanente:</em><br> positività per test HIV, epatite B e C, malattie croniche.<br><br>
					L’elenco completo dei criteri di sospensione è contenuto nell’allegato III del Decreto del Ministero della Salute del 2 novembre 2015 recante “Disposizioni relative ai requisiti di qualità e sicurezza del sangue e degli emocomponenti”.</p>
					</div>
					<div id="bordonero2" class="divdona">
						<img id="secondaimmdon" alt="secondaimmagine" src="./Immagini/secondadonazione.png">
						<h3>Valutazione clinica<br>
						e firma del modulo
						di accettazione</h3>
						<p>
							Chi desidera diventare donatore di sangue può prendere contatto con la sede AVIS più vicina.
							Prima di ogni donazione, il donatore (o aspirante tale) è tenuto a compilare un questionario finalizzato a
							conoscere il suo stato di salute (presente e passato) e il suo stile di vita.
							<br>Il successivo colloquio e la visita con un medico aiuteranno ad approfondire le risposte alle domande contenute nel questionario.
						</p>
					</div>
					<div class="divdona">
					<h3>	Il prelievo</h3>

					<p>Il mattino del prelievo è preferibile aver fatto una colazione leggera a base di frutta fresca o spremute,
						tè o caffè poco zuccherati, pane non condito o altri carboidrati semplici.</p>
					</div>
					<div class="divdona">
						<h3>Esami e controlli</h3>

					<p><em>Al fine di garantire elevati livelli di qualità e sicurezza del sangue e per tutelare la salute sia del
					donatore, sia dei pazienti, ad ogni donazione il sangue prelevato viene sottoposto ai seguenti esami:</em><br>

					<br>Esame emocromocitometrico completo.</em><br><br>
					<em>Esami per la qualificazione biologica del sangue e degli emocomponenti di seguito elencati:</em><br><br>
					– HBsAg (antigene di superficie del virus dell’epatite virale B);<br>
					– Anticorpi anti-HCV (anticorpo contro il virus dell’epatite virale C);<br>
					– Test sierologico per la ricerca combinata di anticorpo anti HIV (anticorpo contro il virus
					dell’AIDS) 1-2 e antigene HIV 1-2;<br>
					– Anticorpi anti-Treponema Pallidum (TP) con metodo immunometrico (contro la sifilide);<br>
					– HBV/HCV/HIV 1 NAT (test per rilevare la presenza dei virus de lle epatiti virali B, C e dell’AIDS).<br><br>
					<em>In occasione della prima donazione vengono inoltre eseguiti i seguenti esami per la determinazione
					dei gruppi sanguigni:</em><br><br>

					Fenotipo ABO mediante test diretto e indiretto.
					Fenotipo Rh completo.
					Determinazione dell’antigene Kell e, in caso di positività dello stesso, ricerca dell’antigene Cellano.
					Ricerca degli anticorpi irregolari anti-eritrocitari.<br><br>
					<em>Il donatore periodico è sottoposto, con cadenza almeno annuale, anche ai seguenti controlli ematochimici:</em><br><br> Glicemia,
					creatininemia, alanin-amino-transferasi, colesterolemia totale e HDL, trigliceridemia, protidemia totale, ferritinemia.</p>
					<img id="terzaimmdon" alt="terzaimmagine" src="./Immagini/terzodonazione.png">
					</div>




        </div>
        <div class="push">
  			</div>
  		</div>
  		<footer>
				<em>Corso di Progettazione Web - Claudio Biancu <a href="documentazione.html">Documentazione</a></em>
  			<strong>Powered by MrWhiteMtd</strong>
  		</footer>
    </body>
