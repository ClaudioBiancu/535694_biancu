function AjaxManager() {}

//Funzione per la gestione asincrona AJAX
AjaxManager.performAjaxRequest =
	function(metodo, url, asincrona, dati){

		var xmlHttp = null; //Inizializzo l'oggetto xmlHttp
		// qui valutiamo la tipologia di browser utilizzato per selezionare la tipologia di oggetto da creare.
		// Se sono in un browser Mozilla/Safari, utilizzo l'oggetto XMLHttpRequest per lo scambio di dati tra browser e server.
		if (window.XMLHttpRequest) {
			xmlHttp = new XMLHttpRequest();
		}

		// Se sono in un Browser di Microsoft (IE), utilizzo Microsoft.XMLHTTP
		//che rappresenta la classe di riferimento per questo browser
		else if (window.ActiveXObject) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		if (xmlHttp === null)
		{
			window.alert("Il tuo browser non supporta AJAX!");
			return;
		}


		//Apro il canale di connessione per regolare il tipo di richiesta.
		//Passo come parametri il tipo di richiesta, url e se è o meno un operazione asincrona.
		xmlHttp.open(metodo, url, asincrona);
		//setto l'header dell'oggetto
		xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.onreadystatechange = function (){

			/*Gli stai di una richiesta possono essere 5
				* 0 - UNINITIALIZED
				* 1 - LOADING
				* 2 - LOADED
				* 3 - INTERACTIVE
				* 4 - COMPLETE*/
			if (xmlHttp.readyState == 4){ //Se lo stato è completo

				var risposta = xmlHttp.responseText;
				//Aggiorno la pagina con la risposta ritornata dalla precendete richiesta dal web server.
				//Quando la richiesta è terminata il responso della richiesta è disponibie come responseText.
				funzioneRisposta(risposta);
			}
		}

		/* Passo alla richiesta i valori del form in modo da generare l'output desiderato*/
		//dati == null serve GET
		//dati == "stringa" serve post
		xmlHttp.send(dati);
}


AjaxManager.preparaUsername =
	function(numero){
		if(numero==1){
			var url = "./php/checkusername.php";
		}
		else{
			var url = "../php/checkusername.php"
		}
		var un = document.getElementById("username").value;
		if(un){
			var vars = "&username=" + un;
			if (numero==2) {
				document.getElementById("register").disabled = false;
			}
			AjaxManager.performAjaxRequest("POST", url, true, vars);
		}
		else{
		document.getElementById("spanrispostausername").textContent="";
		if (document.getElementById("spanrispostausername").textContent==' ')
			document.getElementById("register").disabled = false;
		if (numero==2) {
			document.getElementById("register").disabled = true;
			}
		}
	}

AjaxManager.preparaEmail =
function(){

	var url = "./php/checkemail.php";
	var un = document.getElementById("email").value;
	if(un){
			var vars = "&email=" + un;
			AjaxManager.performAjaxRequest("POST", url, true, vars);
		}
		else{
		document.getElementById("spanrispostaemail").textContent="";
		if (document.getElementById("spanrispostaemail").textContent==' ')
			document.getElementById("register").disabled = false;
		}
}

AjaxManager.preparaLogin =
function(){

	var url = "./php/checklogin.php";
	var username = document.getElementById("usernameloginindex").value;
	var password = document.getElementById("passloginindex").value;

	if(username && password){
			var vars = "&username=" + username + "&password=" + password;
			AjaxManager.performAjaxRequest("POST", url, true, vars);
	}
}


function funzioneRisposta(risposta){
	if (risposta!="") {
				if(risposta[0]=='U'){
						document.getElementById("spanrispostausername").textContent=risposta;
						document.getElementById("register").disabled = true;
				}
				else{
					if(risposta[0]=='E'){
						document.getElementById("spanrispostaemail").textContent=risposta;
						document.getElementById("register").disabled = true;
					}
					else{
						if(risposta[0]=='R'){
							document.getElementById("spanrispostalogin").textContent=risposta;
						}
						else{
							location.href = './profilo2.php';
						}
        				}
					}
				}
	}

function cambia(span){
	if(span=="spanrispostausername"){
		if(document.getElementById("spanrispostausername").textContent!="") {
			document.getElementById("spanrispostausername").textContent="";
			if (!document.getElementById("spanrispostaemail") ||  document.getElementById("spanrispostaemail").textContent=="" )
			document.getElementById('register').disabled=false;
		}
	}
	if (span=="spanrispostaemail") {
		if(document.getElementById("spanrispostaemail").textContent!="") {
			document.getElementById("spanrispostaemail").textContent="";
			if (document.getElementById("spanrispostausername").textContent=="")
				document.getElementById('register').disabled=false;
		}

	}
}
