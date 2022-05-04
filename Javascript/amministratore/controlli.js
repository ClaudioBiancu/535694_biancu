function AjaxAmministratore() {}

AjaxAmministratore.performAjaxRequest =
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
				if(url=="./php/amministratore/trovaRH.php")
				{
					var risposta = xmlHttp.responseText;
					//Aggiorno la pagina con la risposta ritornata dalla precendete richiesta dal web server.
					//Quando la richiesta è terminata il responso della richiesta è disponibie come responseText.
					funzioneStringaRH(risposta);
				}
			else
				if(url=="./php/cancellapost.php"){
					var risposta = xmlHttp.responseText;
					rimuovisegnalazione(risposta);
				}
				else{
					if(url=="./php/amministratore/inseriscirisposta.php"){
						var risposta = xmlHttp.responseText;
						rimuovimessaggio(risposta);
					}
					else{
					var risposta = xmlHttp.responseText;
					//Aggiorno la pagina con la risposta ritornata dalla precendete richiesta dal web server.
					//Quando la richiesta è terminata il responso della richiesta è disponibie come responseText.
					funzioneRisposta(risposta);
				}
				}
			}
		}

		/* Passo alla richiesta i valori del form in modo da generare l'output desiderato*/
		//dati == null serve GET
		//dati == "stringa" serve post
		xmlHttp.send(dati);
}


AjaxAmministratore.controlloavviso =
function(){
	var textarea= document.getElementById('textarea').value;

	if ((textarea == "") || (textarea == "undefined")) {
        alert("L'area avvisi non può rimanere vuota, devi inserire del testo");
        document.moduloavviso.textarea.focus();
        return false;
    }
    else {
    	var massimo= 300;
    	if (document.moduloavviso.textarea.value.length > massimo) {
    	alert("L'area avvisi può contenere fino a 300 caratteri, hai superato il limite");
        document.moduloavviso.textarea.focus();
        return false;
    	}
	    else {
	    	var url = "./php/amministratore/avvisoadmin.php";
	    	var vars = "&textarea=" + textarea;
				document.getElementById("textarea").value="";
			AjaxAmministratore.performAjaxRequest("POST", url, true, vars);

	    }
    }
}


function funzioneRisposta(risposta){
	if (risposta!="") {
			alert(risposta);
		}
}

AjaxAmministratore.controllonuovadonazione =
function(){
	var textarea= document.getElementById('textarea1').value;

	if ((textarea == "") || (textarea == "undefined")) {
        alert("L'area informazioni non può rimanere vuota, devi inserire del testo");
        document.moduloavviso.textarea.focus();
        return false;
    }
    else {
    	var massimo= 300;
    	if (document.moduloavviso.textarea.value.length > massimo) {
    	alert("L'area informazioni può contenere fino a 300 caratteri, hai superato il limite");
        document.moduloavviso.textarea.focus();
        return false;
    	}
	    else {
	    	var url = "./php/amministratore/infodonadmin.php";
	    	var vars = "&textarea=" + textarea;
				document.getElementById("textarea1").value="";
			AjaxAmministratore.performAjaxRequest("POST", url, true, vars);

	    }
    }
}

function funzioneRisposta1(risposta){
	if (risposta!="") {
		if(risposta[0]=='A'){
			alert(risposta);
		}
		else{
			alert("Risposta");
		}
	}
}


AjaxAmministratore.controllorh =
function(){
	var SelRH= document.getElementById("SelRH").value;
	    	var url = "./php/amministratore/trovaRH.php";
	    	var vars = "&SelRH=" + SelRH;
			AjaxAmministratore.performAjaxRequest("POST", url, true, vars);

	    }


 function funzioneStringaRH(risposta){
	 mes=document.getElementById('ullistagruppi');
	 while(mes.hasChildNodes()){
     mes.removeChild(mes.firstChild);
   }
	 document.getElementById("listagruppi").style.visibility="visible";
	 if(risposta){
	 var array=risposta.split(".");
	 for( var i=0; i<array.length-1;i=i+1){
		 array[i]=array[i].split(",")
	 }
	 for (var i = 0; i < array.length -1; i++) {
	var stringa=array[i][0] + " " + array[i][1] + "\t\t\t("+ array[i][2]+")";
		 var node = document.createElement("LI");
		                // Create a <li> node
		 var textnode = document.createTextNode(stringa);         // Create a text node
		 node.appendChild(textnode);                              // Append the text to <li>
		 document.getElementById("ullistagruppi").appendChild(node);     // Append <li> to <ul> with id="myList"
	 }
 }
 else{
	 var node = document.createElement("LI");
									// Create a <li> node
	 var textnode = document.createTextNode(risposta);         // Create a text node
	 node.appendChild(textnode);                              // Append the text to <li>
	 document.getElementById("ullistagruppi").appendChild(node);     // Append <li> to <ul> with id="myList"
 }
 }


AjaxAmministratore.controllosegnalazione =
function(UserName, Tempo, Codice, Numero){
				var url = "./php/cancellapost.php";
				var vars = "&username=" + UserName+ "&codice=" + Codice +"&tempo="+Tempo;
			if(Numero==1)
			AjaxAmministratore.performAjaxRequest("POST", url, true, vars);
			else{
				document.getElementById(Codice).remove();
				document.getElementById("AppareSegnalazione").style.display="none";
			}

}

function rimuovisegnalazione(risposta){
		var node= document.getElementById(risposta);
		node.remove();
		document.getElementById("AppareSegnalazione").style.display="none";
}







 /*FUNZIONI TOOL*/
function MostraTool(numero){

	for(var i=1;i<=5;i++){
		 var node=document.getElementById("tool"+i);
		 node.style.display="none";
		 var node1=document.getElementById("pulsantetool"+i);
		 node1.style.backgroundColor="white";
		 node1.style.color="#006bac";
	}
	var node2=	document.getElementById("pulsantetool"+numero);
	node2.style.backgroundColor="#006bac";
	node2.style.color="white";
	document.getElementById("tool"+numero).style.display="block";
}
 /*FINE FUNZIONI TOOL*/

 function DivTesto(Username,Tempo,Numero,Codice,Testo){
	 document.getElementById("TitoloSegnalazione").textContent="Post di "+Username+" del: "+Tempo+".  Numero di Segnalazioni: "+Numero;
	 document.getElementById("TestoSegnalazione").textContent=Testo;
	 document.getElementById("AppareSegnalazione").style.display="block";
	 document.getElementById("MantieniPul").setAttribute('onclick',"AjaxAmministratore.controllosegnalazione('"+Username+"','"+Tempo+"','"+Codice+"',0)");
	 document.getElementById("EliminaPul").setAttribute('onclick',"AjaxAmministratore.controllosegnalazione('"+Username+"','"+Tempo+"','"+Codice+"',1)");

 }

 function ChiudiSegn(num){
	if(num==0)
	 document.getElementById("AppareSegnalazione").style.display="none";
	else
	 document.getElementById("AppareMessaggio").style.display="none";
 }

 function DivAiuto(Username,Codice,Tempo,Testo){
	 document.getElementById("TitoloMessaggio").textContent="Messaggio di "+Username+" del: "+Tempo;
	 document.getElementById("TestoUtente").textContent=Testo;
	 document.getElementById("AppareMessaggio").style.display="block";
	 document.getElementById("TestoRisposta").setAttribute('onkeyup',"attivainvio('"+Username+"','"+Codice+"','"+Tempo+"')");
 }

 function attivainvio(Username,Codice,Tempo){
	 var Risposta=document.getElementById("TestoRisposta").value;
	 if(Risposta!=""){
	 	document.getElementById("InviaRisposta").setAttribute('onclick',"AjaxAmministratore.controllomessaggio('"+Username+"','"+Tempo+"','"+Codice+"','"+Risposta+"')");
	 	document.getElementById("InviaRisposta").disabled=false;
	}
	 else
	 	document.getElementById("InviaRisposta").disabled=true;
 }

 AjaxAmministratore.controllomessaggio =
 function(UserName, Tempo, Codice, Risposta){
 				var url = "./php/amministratore/inseriscirisposta.php";
 				var vars = "&username=" + UserName +"&tempo="+Tempo+"&codice="+Codice+"&risposta="+Risposta;
 			AjaxAmministratore.performAjaxRequest("POST", url, true, vars);
 }


 function rimuovimessaggio(risposta){
	 alert("Risposta inserita correttamente");

 		var node= document.getElementById(risposta+"mess");
 		node.remove();
 		document.getElementById("AppareMessaggio").style.display="none";
		document.getElementById("TestoRisposta").value="";
 }
