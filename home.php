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
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css condiviso  -->
		<link rel="stylesheet" href="./Stili/home2.css" type="text/css" media="screen">
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<script src="./Javascript/ajaxManager.js"></script>
		<script  src="./Javascript/controlliHome.js"></script>
		<title>AVIS Siniscola</title>
	</head>
	<body onload="firstSlide();">
	<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*BARRA DI NAVIGAZIONE*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
		<div id="barra">
				<nav id="LogoAlto">
					<a id="Aimmagine" href="./home.php"> <img class="logoHome" src="./Immagini/logo2.png" alt="Il logo dell'Avis"></a>
				</nav>
				<div id="AppareLogin">
					<div id="chiudi">
						<a onclick="ChiudiLogin()"> Chiudi </a>
					</div>

					<form onsubmit="return false;">
					<h3 style="color:red">Login</h3>
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
							<!-- :::::::::::::::::::::::::::::::::::::::::::::PRIMO Script PHP ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
							Se l'utente è loggato apparirà sulla barra home il suo username, l'elemtento è comunque un <a> e indirizza al suo profilo
							altrimenti apparirà un al suo posto ci sarà un login (form) che apparirà al passaggio del mouse-->
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
							<!--::::::::::::::::::::::::::::::::::::FINE SCRIPT (CONTROLLO LOGIN):::::::::::::::::::::::::::::::::::::-->
							<!-- 2° Elemento: (Sottomenu) -->
							<li>
								<a href="donazione.php">Donazione</a>

							</li>
							<!-- 3° Elemento -->

							<!-- 4° Elemento -->
							<li><a href="#QuintoDiv">Contatti</a></li>

							<!--:::::::::::::::::::::::::::::::::::::::::SECONDO Script PHP:::::::::::::::::::::::::::::::::::::::::::-->
										<!--Se l'Utente è loggato apparirà nella barra anche il pulsante di LOGOUT-->
							<?php
							if(isset($_SESSION["logged"]))
							echo '<li><a id="alogout" href="./php/logout.php" class="NavBut">Logout</a></li>'
							?>
							<!--::::::::::::::::::::::::::::::::FINE SCRIPT (CONTROLLO LOGOUT)::::::::::::::::::::::::::::::::::::::::-->

						</ul>
					</div>
				</div>
	<!--::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::FINE NAVBAR:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
				<main>

						<!-- Slider Immagini -->
							<div class="slideshow-container">


							  <div class="mySlides" id="ImmagineDefault">

									<div>
									<div>	<img height="300" width="600" src="./Immagini/community.png" alt="community"><br></div>
										<em>Partecipa alla nostra community. Registrati subito!</em><br><br>
										<button onclick="window.location.href='registrazione.php'" class="pulsante">Vai</button>
									</div>
							  </div>



							  <div class="mySlides" id="ThirdImg">
									<div>
									<div>	<img height="300" width="600" src="./Immagini/nazionale4.png" alt="community"><br></div>
										<em>Visita il sito Nazionale, scopri gli eventi che abbiamo in programma per quest'anno.</em><br><br>
										<button onclick="window.open('https://www.avis.it','_blank' )" class="pulsante">Vai</button>
									</div>

							  </div>

								<div class="mySlides" id="FourthImg">
									<div>
									<div>	<img height="300" width="800" src="./Immagini/percdonatori.png" alt="community"><br></div>
										<em>Scopri di più sulla donazione. Abbiamo bisogno di te!</em><br><br>
										<button onclick="window.location.href='donazione.php'" class="pulsante">Vai</button>
									</div>
							  </div>



							  <!-- Bottoni Avanti e Indietro -->
							  <a class="prev" onclick="plusSlides(-1)">&#9665;</a>
							  <a class="next" onclick="plusSlides(1)">&#9655;</a>
							</div>
					</div>
					<div id="SecondoDiv">
						<div id="SecondoDiv1">
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
							<br><br><button onclick="window.location.href = 'donazione.php'; "id="pulsanteprossimadonazione">Scopri di più</button>
						</div>
					</div>
					<div id="TerzoDiv">
						<div id="BoxAvvisi">
							<h3 id="h3avvisi">Avvisi per i donatori</h3>

							<!--:::::::::::::::::::::::::::::::::::::::::TERZO Script PHP::::::::::::::::::::::::::::::::::::::::::::::::::-->
																<!-- :::::!!!IMPORTANTE!!!:::::::-->
											<!--Vado a cercare nel DB l'avviso aggiunto di recente e lo stampo sullo Home-->
							<?php
							$query_registrazione = mysqli_query($con,"SELECT A.Testo, A.Data
																FROM avvisi A
																WHERE A.Data=(SELECT MAX(A1.Data)
																			FROM avvisi A1);") ;
								if( !$query_registrazione ){
									/* NESSUN RISULTATO */
									echo 'Al momento non sono presenti avvisi';
							}
							else{
									/* RISULTATO OK  */
								while ($riga = mysqli_fetch_object($query_registrazione)) {
									echo $riga->Testo;

								}
							}
							?>
							<!--:::::::::::::::::::::::::::::::::FINE SCRIPT (Aggiornare Avviso Home):::::::::::::::::::::::::::::::::::::::-->

						</div>
					</div>
					<div id="QuartoDiv">
							<h3> Seguici Sui Social</h3>
								<div><img height="250" width="250" src="./Immagini/facebook.png" alt="Facebook"><br><button onclick="location.href='https://www.facebook.com/groups/62954624591/';" class="pulsanteSocial">Seguici</button></li></div>
								<div><img height="250" width="250" src="./Immagini/instagram.png" alt="Instagram"><br><button onclick="location.href='https://www.instagram.com/';" class="pulsanteSocial">Seguici</button></li></div>
								<div><img height="250" width="250" src="./Immagini/twitter.png" alt="Twitter"><br><button onclick="location.href='https://www.twitter.com';" class="pulsanteSocial">Seguici</button></li></div>
					</div>
					<div id="QuintoDiv">
						<div id="MainContact">
							<h3>Contattaci</h3>
							<img id="immaginecontatti" src="./Immagini/sfondocontatti1.jpg" alt="Contatti" usemap="#imgmap2018211182521">
							<map id="imgmap2018211182521" name="imgmap2018211182521">
								<area href="#MainContact" onclick="AppareContatti(0)" shape="poly" alt=""  coords="103,155,194,148,203,227,108,229"   />
								<area href="#MainContact" onclick="AppareContatti(1)" shape="poly" alt=""  coords="294,113,290,145,278,150,277,153,277,161,288,193,291,206,299,200,305,197,312,202,327,229,318,236,298,238,291,234,281,216,274,207,268,192,263,175,260,154,258,133,258,122,270,112,277,107,289,108"   />
								<area  shape="poly" alt="avissiniscola@gmail.com"  coords="454,231,475,193,475,170,469,156,460,145,448,142,420,140,391,157,382,175,378,197,375,206,378,207,395,229,405,237,430,241,456,231,456,231" href="mailto:avissiniscola@gmail.com"  />
								<area href="#MainContact"  onclick="AppareContatti(2)" shape="poly" alt=""  coords="533,109,570,104,573,92,581,92,584,106,590,111,595,121,595,162,595,223,572,225,536,224,535,212,533,174,532,118,529,106"  />
								<area shape="poly" alt=""  coords="698,133,669,146,660,157,658,177,665,191,673,206,679,211,683,231,692,249,706,225,715,203,729,200,737,181,736,161,725,143,708,134,692,133" href="https://www.google.it/maps/place/08029+Siniscola+NU/@40.5745103,9.6926426,15.25z/data=!4m5!3m4!1s0x12dec2ee1cb92f93:0xa67480579b091ca4!8m2!3d40.5304555!4d9.7009754?hl=it" target="_blank" /></map>
								<div id="AppareContatti">
									<a id="pulcontatti" onclick="chiudicontatto()"> Chiudi </a>
									<h3 id="titolocontatto">Titolo Contatto</h3>
									<div id="Appendi">
										Contatto
									</div>
								</div>
						</div>
					</div>

				</main>
				<footer>
					<em>Corso di Progettazione Web - Claudio Biancu <a href="documentazione.html">Documentazione</a></em>
					<strong>Powered by MrWhiteMtd</strong>
				</footer>


</body>
