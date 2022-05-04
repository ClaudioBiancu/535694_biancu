<?php session_start();// come sempre prima cosa, aprire la sessione
  include("./php/db_con.php");// includere la connessione al database
 if($_SESSION["logged"] == false)
		header("location: home.php");
?>
<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css video principale-->
		<link rel="stylesheet" href="./Stili/profilo2.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="./Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="./Javascript/controlliprofilo.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
		<title>Profilo Personale</title>
	</head>
	<body onload="document.getElementById('a0').style.color='#d9271b'">
        <nav id="LogoAlto">
          <a id="Aimmagine" href="./home.php"> <img class="logoHome" src="./Immagini/logo2.png" alt="Il logo dell'Avis"></a>
        </nav>
        <div id="menu">
          <!-- Lista generale -->
          <ul>
            <!-- 1° Elemento	-->
						<li><a href="home.php" class="NavBut">  Home </a>
						</li>
            <!-- 2° Elemento: (Sottomenu) -->
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

            if(isset($_SESSION["logged"])){
							$query = mysqli_query($con,"SELECT * FROM admin WHERE username='".$_SESSION["username"]."'");
							if(mysqli_num_rows($query))
								echo '<li><a href="amministratore2.php" class="NavBut">Gestisci</a> </li> ';
						}
            ?>
            <!--::::::::::::::::::::::::::::::::FINE SCRIPT (CONTROLLO LOGOUT)::::::::::::::::::::::::::::::::::::::::-->

          </ul>
        </div>
			<div id="container">
				<section id="MainProfile">
					<?php echo '<h3 id="h3Benvenuto"> Benvenuto '; echo $_SESSION["username"]; echo'</h3>'; ?>
					<aside id="aside">


	<!--:::::::::::::::::::::::::::::::::::::::::::::::VERIFICA IMMAGINE PHP::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
							<?php
								//Cerco nel Database se esiste un immagine profilo caricata dall'utente.
								$select= mysqli_query($con,"SELECT U.NomeImmagine FROM immprofilo U WHERE U.username='".$_SESSION["username"]."'
																		 AND U.Data=(SELECT MAX(A1.Data)
																				 	 FROM immprofilo A1
																				 	 WHERE A1.username=U.username);" );
								$riga = mysqli_fetch_object($select);
								//Se l'utente non ha caricato nessuna immagine faccio un controllo sul sesso e imposto l'immagine di default 	corrispondente
								$sesso= mysqli_query($con,"SELECT * FROM Utente U WHERE U.UserName='".$_SESSION["username"]."';");
							    $query_sex = mysqli_fetch_object($sesso);
								if(!$riga|| !$riga->NomeImmagine){
								    /* NESSUN RISULTATO */
								    if(!$query_sex)
								    	echo 'errore';
								    else{
										$sex =$query_sex->Sesso;
								    }
									    if($sex == 'M'){
									    	echo '<img class="imm" alt="ImmagineProfilo" src="./Immagini/Upload/male.jpg" height="150" width="150">';
									    }
									    else{
									    	echo '<img class="imm" alt="ImmagineProfilo" src="./Immagini/Upload/female.jpg" height="150" width="150">';
								    	}
								    }
								 //Altrimenti vado a carica quella avente data di caricamento più recente.
								else{
								    /* RISULTATO OK  */
										$image =$riga->NomeImmagine;
										echo '<img class="imm" alt="ImmagineProfilo" src="./Immagini/Upload/'; echo $image; echo'" height="150" width="150" >';

								}
								echo '<h3 id="NomeCognome">'; echo $query_sex->Nome; echo' '; echo $query_sex->Cognome; echo'</h3>';
							?>
<!--:::::::::::::::::::::::::::::::::::::::::::::::::::::FINE IMMAGINEPHP::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
						<div id='asideprofilo'>
							<a id="a0" onclick="cambiaframe(0); cambiacolore(0);">Profilo</a>
							<a id="a2" onclick="cambiaframe(2); cambiacolore(2);">Community</a>
							<a id="a3" onclick="cambiaframe(3); cambiacolore(3);">A chi posso donare?</a>
							<a id="a1" onclick="cambiaframe(1); cambiacolore(1);">Impostazioni</a>
              <?php
                  $query = mysqli_query($con,"SELECT * FROM admin WHERE username='".$_SESSION["username"]."'");
     							if(!mysqli_num_rows($query))
     								echo'<a id="a4" onclick="cambiaframe(4); cambiacolore(4);">Hai un problema?</a>';
                  else{
                     echo'<a style="display: none" id="a4" onclick="cambiaframe(4); cambiacolore(4);">Hai un problema?</a>';
                  }

              ?>
						</div>

					</aside>
					<div id="main">
						<iframe id="iframe" src="./Iframe/informazioni.php" onload="resizeIframe(this)"></iframe>
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
