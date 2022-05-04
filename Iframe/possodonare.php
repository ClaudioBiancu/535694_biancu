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
		<link rel="stylesheet" href="../Stili/IframeStyle/possodonare.css?" type="text/css" media="screen"> <!--css profilo -->
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
		<section id="sezionetabella">
			<form onsubmit="return false;">
				<h3>Seleziona il tuo gruppo sanguigno</h3>
				<select onchange="tabella();" id="gruppo" name="gruppo">
					<option>Seleziona</option>
					<option>0 Rh -</option>
					<option>0 Rh +</option>
					<option>A Rh -</option>
					<option>A Rh +</option>
					<option>B Rh -</option>
					<option>B Rh +</option>
					<option>AB Rh -</option>
					<option>AB Rh +</option>
				</select>
			</form>
			<table>
			    <tr><td colspan="9">Donatore</td></tr>
			    <tr>
			    	<td></td>
			    	<td class="tabdonatore" id="0RH-">0 RH -</td>
			    	<td class="tabdonatore" id="0RH+">0 RH +</td>
			    	<td class="tabdonatore" id="ARH-">A RH -</td>
			    	<td class="tabdonatore" id="ARH+">A RH +</td>
			    	<td class="tabdonatore" id="BRH-">B RH -</td>
			    	<td class="tabdonatore" id="BRH+">B RH +</td>
			    	<td class="tabdonatore" id="ABRH-">AB RH -</td>
			    	<td class="tabdonatore" id="ABRH+">AB RH +</td>
			    </tr>
			    <tr>
			    	<td class>0 RH -</td>
          <?php  for($i=0;$i<=7;$i++)
			    	echo'<td class="tabinterni" id="0'.$i.'"></td>';
          ?>
			    </tr>
			    <tr>
			    	<td>0 RH +</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="1'.$i.'"></td>';
            ?>
			    </tr>
			    <tr><td>A RH -</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="2'.$i.'"></td>';
            ?>
			    </tr>
			    <tr><td>A RH +</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="3'.$i.'"></td>';
            ?>
			    </tr>
			    <tr>
			    	<td>B RH -</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="4'.$i.'"></td>';
            ?>
			    </tr>
			    <tr><td>B RH +</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="5'.$i.'"></td>';
            ?>
			    </tr>
			    <tr><td>AB RH -</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="6'.$i.'"></td>';
            ?>
			    </tr>
			    <tr><td>AB RH +</td>
            <?php  for($i=0;$i<=7;$i++)
  			    	echo'<td class="tabinterni" id="7'.$i.'"></td>';
            ?>
			    </tr>
			</table>
		</section>
	</body>
