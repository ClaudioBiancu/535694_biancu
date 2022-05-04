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
		<link rel="stylesheet" href="../Stili/video2.css" type="text/css" media="screen"> <!-- css video principale-->
		<link rel="stylesheet" href="../Stili/IframeStyle/community.css" type="text/css" media="screen"> <!--css profilo -->
		<link rel="stylesheet" href="../Stili/print.css" type="text/css" media="print">  <!-- css -->
		<script  src="../Javascript/controlliprofilo.js"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Muli">
    <script>
      if (window.top == window.self)
      window.location.href = "../home.php";
    </script>
    <title>Chat</title>
  </head>
<body id="bodychat" onload="window.scroll(0, document.documentElement.scrollHeight);">
  <?php
  $query1=mysqli_query($con, "SELECT P.CodicePost, P.UserName, I.NomeImmagine, P.Testo, P.Tempo, P.MiPiace, P.Dislike, U.Sesso
                              FROM post P
                                INNER JOIN immprofilo I ON P.UserName=I.Username
                                INNER JOIN utente U ON I.UserName=U.UserName
                              WHERE I.Data=(SELECT MAX(A1.Data)
                                            FROM immprofilo A1
                                            WHERE A1.username=P.UserName)
                              ORDER BY P.Tempo ");
  while($estrai=mysqli_fetch_object($query1)){
    echo'<div class="postdesk"'; echo"id='"; echo $estrai->CodicePost; echo"'";
    if($estrai->UserName==$_SESSION['username']){
      echo 'style="float: right;"';
    /*$query2=mysqli_query($con,"SELECT MAX(P.Tempo) AS MaxTempo FROM Post P ");
    $estrai2=mysqli_fetch_object($query2);
    if($estrai->Tempo==$estrai2->MaxTempo)
      echo 'id="LastPost"';*/
    echo '>' ;
    echo'<div class="eliminasegnala" style="color:red; float:right;">';
    echo"<a onclick=\"AjaxManagerChat.CancellaPost('"; echo $estrai->UserName;echo"','"; echo $estrai->CodicePost; echo"','"; echo $estrai->Tempo; echo"')"; echo'" >Cancella </a>';
     echo '<img height="15" width="15" alt="CancellaPost" style="float:right; margin-left:0.5em;" src="../Immagini/cancella.png"'; echo" onclick=\"AjaxManagerChat.CancellaPost('"; echo $estrai->UserName; echo"','";echo $estrai->CodicePost; echo"','"; echo $estrai->Tempo; echo"')\"></div>";
    }
    else{
    echo '>';
    echo'<div class="eliminasegnala" style="color:red; float:right;">';
    echo"<a onclick=\"alert('Post Segnalato'); AjaxManagerChat.SegnalaPost('"; echo $estrai->UserName; echo"','"; echo $estrai->Tempo; echo"')"; echo'">Segnala</a>';
    echo '<img height="15" width="15" alt="SegnalaPost" style="float:right; margin-left:0.5em;" src="../Immagini/segnala.png"'; echo" onclick=\"alert('Post Segnalato'); AjaxManagerChat.SegnalaPost('"; echo $estrai->UserName; echo"','"; echo $estrai->Tempo; echo"')\"></div>";
    }
    if($estrai->NomeImmagine){
      $image=$estrai->NomeImmagine;
      echo '<img class="immdesk" alt="ImmagineProfilo" src="../Immagini/Upload/'; echo $image; echo'" height="40" width="40" >';
    }
    else{
      if($estrai->Sesso=="M"){
        echo '<img class="immdesk" alt="ImmagineProfilo" src="../Immagini/Upload/male.jpg'; echo'" height="40" width="40" >';
      }
      else {
        echo '<img class="immdesk" alt="ImmagineProfilo" src="../Immagini/Upload/female.jpg'; echo'" height="40" width="40" >';
      }
    }

    echo'<b>'; echo $estrai->UserName ; echo '</b><br>';
    echo'<p>'; echo $estrai->Testo; echo '</p><br>';
    $UN=$_SESSION["username"];
    $querylike=mysqli_query($con, "SELECT LikeDislike FROM postlike  WHERE UtenteLike='$UN' AND Autore='$estrai->UserName' AND TimeSt='$estrai->Tempo' AND UtenteLike='$UN'");
    $querylike1=mysqli_query($con, "SELECT LikeDislike FROM postlike  WHERE UtenteLike='$UN' AND Autore='$estrai->UserName' AND TimeSt='$estrai->Tempo' AND UtenteLike='$UN'");
    $querylike3=mysqli_query($con, "SELECT LikeDislike FROM postlike  WHERE UtenteLike='$UN' AND Autore='$estrai->UserName' AND TimeSt='$estrai->Tempo' AND UtenteLike='$UN'");

    if($Vedilike=mysqli_fetch_object($querylike)){
      echo'<div id="scelta'.$estrai->CodicePost.'" style="display:block">';
    }
    else {
        echo'<div id="scelta'.$estrai->CodicePost.'" style="display:none">';
    }
      echo"<img  alt=\"ImmagineLike\" onclick=\"\""; echo' class="likeclass" src="../Immagini/likegrey.png"  height="30" width="30"> <div class="numeri" id="'; echo $estrai->CodicePost; echo 'plus1'; echo'like'; echo'"> '; echo $estrai->MiPiace; echo" </div>";
      echo" <img  alt=\"ImmagineLike\" onclick=\"\""; echo' class="likeclass" src="../Immagini/dislikegrey.png"  height="30" width="30"> <div class="numeri" id="'; echo $estrai->CodicePost; echo 'plus1'; echo'dislike'; echo'"> '; echo $estrai->Dislike;echo'</div>';
      if($Vedilike2=mysqli_fetch_object($querylike3) && $Vedilike->LikeDislike==1){
        echo"<div id='"; echo $estrai->CodicePost."scelta'"; echo " onclick=\"AjaxManagerChat.rimuoviLike('";echo $estrai->UserName;echo"','";echo $estrai->Tempo;echo"','";echo $estrai->CodicePost;echo"','";echo"like'"; echo")\"";  echo'class="LikeRed">Ti piace</div></div>';
      }
      else {
        echo "<div id='"; echo $estrai->CodicePost."scelta'"; echo " onclick=\"AjaxManagerChat.rimuoviLike('";echo $estrai->UserName;echo"','";echo $estrai->Tempo;echo"','";echo $estrai->CodicePost;echo"','";echo"dislike'"; echo")\"";  echo'class="LikeRed">Non ti piace</div></div>';
      }

      if($Vedilike1=mysqli_fetch_object($querylike1)){
        echo'<div id="scelta2'.$estrai->CodicePost.'"style="display:none">';
      }
      else {
          echo'<div id="scelta2'.$estrai->CodicePost.'" style="display:block">';
      }
      echo" <img  alt=\"ImmagineLike\" onclick=\"AjaxManagerChat.preparaLike('";echo $estrai->UserName;echo"','";echo $estrai->Tempo;echo"','";echo $estrai->CodicePost;echo"','";echo"like'"; echo")\""; echo' class="likeclass" src="../Immagini/like.png"  height="30" width="30"> <div class="numeri" id="'; echo $estrai->CodicePost;echo 'plus';
      echo'like'; echo'"> '; echo $estrai->MiPiace; echo" </div>";
      echo" <img  alt=\"ImmagineLike\" onclick=\"AjaxManagerChat.preparaLike('";echo $estrai->UserName;echo"','";echo $estrai->Tempo;echo"','";echo $estrai->CodicePost;echo"','";echo"dislike'"; echo")\""; echo' class="likeclass" src="../Immagini/dislike.png"  height="30" width="30"> <div class="numeri" id="'; echo $estrai->CodicePost; echo 'plus';
       echo'dislike'; echo'"> '; echo $estrai->Dislike;echo'</div></div>';

    echo'<em>'; echo $estrai->Tempo; echo '</em>';
    echo'</div>';
  }
  ?>
</body>
