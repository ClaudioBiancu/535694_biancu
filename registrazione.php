<?php
 session_start();// come sempre prima cosa, aprire la sessione
 include("./php/db_con.php"); // includere la connessione al database// includere la connessione al database
 unset($_SESSION["logged"]);
 session_destroy();
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
		<meta name = "author" content = "Claudio Biancu">
		<meta name = "keywords" content = "Avis, donazione, sangue, aiuto">
		<link rel="icon" href = "./Immagini/icona.png" sizes="32x32" type="image/png">
		<link rel="stylesheet" href="./Stili/video2.css" type="text/css" media="screen"> <!-- css -->
		<link rel="stylesheet" href="./Stili/registrazione.css" type="text/css" media="screen"> <!-- css registrazione-->
		<link rel="stylesheet" href="./Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="./Javascript/ajaxManager.js"></script>
    <script src="./Javascript/controlliHome.js"></script>
		<script  src="./Javascript/controlloregistrazione.js"></script>
		<title>Registrazione</title>
	</head>
	<body>
		<div id="container">
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
              <a  href="donazione.php">Donazione</a>

            </li>

            <!-- 3° Elemento -->
            <li><a href="home.php#MainContact">Contatti</a></li>


            <!--:::::::::::::::::::::::::::::::::::::::::SECONDO Script PHP:::::::::::::::::::::::::::::::::::::::::::-->
                  <!--Se l'Utente è loggato apparirà nella barra anche il pulsante di LOGOUT-->
            <?php
            if(isset($_SESSION["logged"]))
            echo '<li><a id="alogout" href="./php/logout.php" class="NavBut">Logout</a></li>'
            ?>
            <!--::::::::::::::::::::::::::::::::FINE SCRIPT (CONTROLLO LOGOUT)::::::::::::::::::::::::::::::::::::::::-->

          </ul>
        </div>
			<form name="modulo" action = "./php/registration.php" method="post" onsubmit="event.preventDefault(); Modulo()">
			<div class="navreg" id="sezioneregistrazione1">
			    <b>Nome</b><br><input required type="text" name="nome"><br><br>
			    <b>Cognome</b><br><input required type="text" name="cognome"><br><br>
			    <b>Username</b><br><input required type="text" id="username" name="username" autocomplete="off" onkeyup="cambia('spanrispostausername'); AjaxManager.preparaUsername(1);"><br>
			    <span class="spanrisposta" id="spanrispostausername"></span><br>
			    <b>Password</b><br><input required pattern='[a-zA-z0-9.]{1,16}' title='La password deve essere lunga almeno 16 caratteri' type="password" name="password"><br><br>
			    <b>Conferma password</b><br><input required type="password" name="conferma"><br><br>
			    <b>Data di nascita </b><br>
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
          <select id="anno" name="anno" disabled> </select>
			</div>
			<div class="navreg" id="sezioneregistrazione2">
						    <b>Sesso</b>
						      <input type="radio" name="sesso" value="M" checked>M
						      <input type="radio" name="sesso" value="F">F
						  	 <br><br>
						    <b>Provincia</b> <br>
						      <select id="provincia" name="provincia">
									<option value="ag">Agrigento</option>
									<option value="al">Alessandria</option>
									<option value="an">Ancona</option>
									<option value="ao">Aosta</option>
									<option value="ar">Arezzo</option>
									<option value="ap">Ascoli Piceno</option>
									<option value="at">Asti</option>
									<option value="av">Avellino</option>
									<option value="ba">Bari</option>
									<option value="bt">Barletta-Andria-Trani</option>
									<option value="bl">Belluno</option>
									<option value="bn">Benevento</option>
									<option value="bg">Bergamo</option>
									<option value="bi">Biella</option>
									<option value="bo">Bologna</option>
									<option value="bz">Bolzano</option>
									<option value="bs">Brescia</option>
									<option value="br">Brindisi</option>
									<option value="ca">Cagliari</option>
									<option value="cl">Caltanissetta</option>
									<option value="cb">Campobasso</option>
									<option value="ci">Carbonia-iglesias</option>
									<option value="ce">Caserta</option>
									<option value="ct">Catania</option>
									<option value="cz">Catanzaro</option>
									<option value="ch">Chieti</option>
									<option value="co">Como</option>
									<option value="cs">Cosenza</option>
									<option value="cr">Cremona</option>
									<option value="kr">Crotone</option>
									<option value="cn">Cuneo</option>
									<option value="en">Enna</option>
									<option value="fm">Fermo</option>
									<option value="fe">Ferrara</option>
									<option value="fi">Firenze</option>
									<option value="fg">Foggia</option>
									<option value="fc">Forl&igrave;-Cesena</option>
									<option value="fr">Frosinone</option>
									<option value="ge">Genova</option>
									<option value="go">Gorizia</option>
									<option value="gr">Grosseto</option>
									<option value="im">Imperia</option>
									<option value="is">Isernia</option>
									<option value="sp">La spezia</option>
									<option value="aq">L'aquila</option>
									<option value="lt">Latina</option>
									<option value="le">Lecce</option>
									<option value="lc">Lecco</option>
									<option value="li">Livorno</option>
									<option value="lo">Lodi</option>
									<option value="lu">Lucca</option>
									<option value="mc">Macerata</option>
									<option value="mn">Mantova</option>
									<option value="ms">Massa-Carrara</option>
									<option value="mt">Matera</option>
									<option value="vs">Medio Campidano</option>
									<option value="me">Messina</option>
									<option value="mi">Milano</option>
									<option value="mo">Modena</option>
									<option value="mb">Monza e della Brianza</option>
									<option value="na">Napoli</option>
									<option value="no">Novara</option>
									<option value="nu">Nuoro</option>
									<option value="og">Ogliastra</option>
									<option value="ot">Olbia-Tempio</option>
									<option value="or">Oristano</option>
									<option value="pd">Padova</option>
									<option value="pa">Palermo</option>
									<option value="pr">Parma</option>
									<option value="pv">Pavia</option>
									<option value="pg">Perugia</option>
									<option value="pu">Pesaro e Urbino</option>
									<option value="pe">Pescara</option>
									<option value="pc">Piacenza</option>
									<option value="pi">Pisa</option>
									<option value="pt">Pistoia</option>
									<option value="pn">Pordenone</option>
									<option value="pz">Potenza</option>
									<option value="po">Prato</option>
									<option value="rg">Ragusa</option>
									<option value="ra">Ravenna</option>
									<option value="rc">Reggio di Calabria</option>
									<option value="re">Reggio nell'Emilia</option>
									<option value="ri">Rieti</option>
									<option value="rn">Rimini</option>
									<option value="rm">Roma</option>
									<option value="ro">Rovigo</option>
									<option value="sa">Salerno</option>
									<option value="ss">Sassari</option>
									<option value="sv">Savona</option>
									<option value="si">Siena</option>
									<option value="sr">Siracusa</option>
									<option value="so">Sondrio</option>
									<option value="ta">Taranto</option>
									<option value="te">Teramo</option>
									<option value="tr">Terni</option>
									<option value="to">Torino</option>
									<option value="tp">Trapani</option>
									<option value="tn">Trento</option>
									<option value="tv">Treviso</option>
									<option value="ts">Trieste</option>
									<option value="ud">Udine</option>
									<option value="va">Varese</option>
									<option value="ve">Venezia</option>
									<option value="vb">Verbano-Cusio-Ossola</option>
									<option value="vc">Vercelli</option>
									<option value="vr">Verona</option>
									<option value="vv">Vibo valentia</option>
									<option value="vi">Vicenza</option>
									<option value="vt">Viterbo</option>
								</select><br><br>
						    <b>Citta</b><br><input required type="text" name="citta"><br><br>

						   <b>Indirizzo</b><br><input required type="text" name="indirizzo"><br><br>

						    <b>Telefono</b><br><input required type="text" pattern="[0-9]{1,10}" title='Il numero di Telefono deve contenere al massimo 10 numeri' name="telefono"><br><br>

						   <b>Email</b><br><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" autocomplete="off" id="email" name="email" onkeyup="cambia('spanrispostaemail');AjaxManager.preparaEmail(this.value)"><br>
						   <span class="spanrisposta" id="spanrispostaemail"></span><br>
						   <input id="register" class="pulsante" type="submit" value="Invia">
             </div>

						</form>


	</div>
  <div class="push">
  </div>
		<footer>
      <em>Corso di Progettazione Web - Claudio Biancu <a href="documentazione.html">Documentazione</a></em>
			<strong>Powered by MrWhiteMtd</strong>
		</footer>
	</body>

	</html>
