<?php
  session_start(); //apro la sessione
  include("db_con.php"); // includo il file di connessione al database
  $_SESSION["username"]=$_POST["username"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION username
  $_SESSION["password"]=$_POST["password"]; // con questo associo il parametro username che mi è stato passato dal form alla variabile SESSION password
    $result = mysqli_query($con,"SELECT * FROM utente WHERE UserName = '".$_POST["username"]."' AND Password = '".$_POST["password"]."'");
   if(mysqli_num_rows($result) == 0){
        unset($_SESSION["logged"]);
        session_destroy();
        echo "Ricontrolla Username o Password";
        return;
      }
    else{
      $_SESSION["logged"] = true;  // Nella variabile SESSION associo TRUE al valore logged
      header("location: ../profilo2.php"); //Rimando al profilo
      return;
    }
  mysqli_close($con);
?>
