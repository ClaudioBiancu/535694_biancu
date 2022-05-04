function cambiaframe(numero){
	if(numero<0 || numero>4)
		return ;
	else{
		switch(numero) {
		    case 0:
		        document.getElementById('iframe').src="./Iframe/informazioni.php";
		        break;
		    case 1:
		        document.getElementById('iframe').src="./Iframe/impostazioni.php";
		        break;
			case 2:
					document.getElementById('iframe').src="./Iframe/community.php";
					break;
			case 3:
				document.getElementById('iframe').src="./Iframe/possodonare.php";
				break;
			case 4:
				document.getElementById('iframe').src="./Iframe/aiuto.php";
			break;
		    default:
		        document.getElementById('iframe').src="./Iframe/informazioni.php";
		}
	}
	return ;
}

function cambiacolore(numero){
	if(numero<0 || numero>4)
		return ;
	else{
		var temp= document.getElementById('asideprofilo').childNodes;
		for(var i=0; i<10; i++){
			if((i%2)!=0){
			temp[i].style.color="#006bac";
			}
		}
		document.getElementById('a'+numero).style.color='#d9271b';
	}
}

function resizeIframe(obj) {

	obj.style.height = obj.contentWindow.document.body.scrollHeight + 50 +'px';
}

/*::::::::::::::::FUNZIONI PAGINA COMMUNITY:::::::::::::::::::::*/

function scorrimessaggi(){
	var elem = document.getElementById('bodychat');
  elem.scrollTop = elem.scrollHeight;
}



function AjaxManagerChat() {}

//Funzione per la gestione asincrona AJAX
AjaxManagerChat.performAjaxRequest =
	function(metodo, url, asincrona, dati, quale){

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
				if (quale==1){
					funzioneinserisci();
				}
				else{
					if (quale==2) {
						funzioneCanc(risposta);
					}
					else
					if(quale==0)
						funzioneRispo(risposta);
					else
					if(quale==5)
						rimuoviLike2(risposta);
			}
			}
		}

		/* Passo alla richiesta i valori del form in modo da generare l'output desiderato*/
		//dati == null serve GET
		//dati == "stringa" serve post
		xmlHttp.send(dati);
}


AjaxManagerChat.preparaLike =
function(user, time, codice, like){
	var url = "../php/like.php";
	var usernamepost = user;
	var tempost= time;
	var scelta=like;
	var cod=codice;
	if(usernamepost && tempost && scelta){
			var vars = "&usernamepost=" + usernamepost + "&codice=" + cod + "&tempost=" + tempost +"&scelta="+ scelta;
			AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 0);
	}
}

AjaxManagerChat.rimuoviLike =
function(user, time, codice, like){
	var url = "../php/unlike.php";
	var usernamepost = user;
	var tempost= time;
	var scelta=like;
	var cod=codice;
	if(usernamepost && tempost && scelta){
			var vars = "&usernamepost=" + usernamepost + "&codice=" + cod + "&tempost=" + tempost +"&scelta="+ scelta;
			AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 5);
	}
}

AjaxManagerChat.preparaPost=
function(){
	var url="../php/inseriscipost.php";
	var testopost=document.getElementById("testopost").value;
	var vars="&testopost=" + testopost;
	AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 1)
}

AjaxManagerChat.CancellaPost=
function(username,codice, tempo){
	var url="../php/cancellapost.php";
	var vars="&username=" + username + "&codice=" + codice + "&tempo=" + tempo;
	AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 2)
}

function funzioneCanc(risposta){
	alert("Post rimosso");
	var node= document.getElementById(risposta);
	node.remove();
}

AjaxManagerChat.SegnalaPost=
function(username, tempo){
	var url="../php/segnalapost.php";
	var vars="&username=" + username + "&tempo=" + tempo;
	AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 3)
}


function funzioneRispo(risposta){
	 var array1=risposta.split(";");
	 var stringa=array1[5]+"plus"+array1[3];
	 var stringa1=array1[5]+"plus1"+array1[3];
	 var stringa2=array1[5];
	 document.getElementById(stringa).textContent=array1[4];
	 document.getElementById(stringa1).textContent=array1[4];
	 var node = document.getElementById(stringa2+"scelta");
	 if(array1[3]=="like"){
	    var scelta="Ti piace";
		 node.setAttribute("onclick","AjaxManagerChat.rimuoviLike('"+array1[0]+"','"+array1[2]+"','"+ stringa2 + "','like')");
	 }
	 else{
	 	  var scelta="Non ti piace";
			node.setAttribute("onclick","AjaxManagerChat.rimuoviLike('"+array1[0]+"','"+array1[2]+"','"+ stringa2 + "','dislike')");
		}       // Create a text node
	 node.textContent=scelta;
	 document.getElementById("scelta2"+stringa2).style.display="none";
	 document.getElementById("scelta"+stringa2).style.display="block";
}

function funzioneinserisci(){
	var elem=document.getElementById("desk");
	elem.src=elem.src;
	document.getElementById("testopost").value="";
}

function rimuoviLike2(risposta){
	var array1=risposta.split(";");
	var stringa=array1[5]+"plus"+array1[3];
	var stringa1=array1[5]+"plus1"+array1[3];
	document.getElementById(stringa).textContent=array1[4];
	document.getElementById(stringa1).textContent=array1[4];
	var stringa2=array1[5];
	document.getElementById("scelta"+stringa2).style.display="none";
	document.getElementById("scelta2"+stringa2).style.display="block";

}

/*::::::::::::::::FINE FUNZIONI PAGINA COMMUNITY:::::::::::::::::::::*/

/*:::::::::FUNZIONI PAGINA IMPOSTAZIONI::::::::::::::::*/

/*Funzioni cambia immagine*/
function controlloupload(){

	if(document.getElementById('fileupload').value =="") {
		alert("Non hai selezionato nessun immagine");
		return false;
	}
	else{
		document.moduloimm.action = "../php/upload.php";
        document.moduloimm.submit();
        alert("Immagine modificata correttamente");

	}

}


function attivabottone(){
	if(document.getElementById('fileupload').value !="") {
 		document.getElementById('fileuploadsubmit').disabled=false;
	}
}
/*Fine funzioni cambia immagine*/

/*Funzioni cambio password*/
function cambiapassword(){
	var VecchiaPass=document.getElementById('VecchiaPass').value;
	var NuovaPass=document.getElementById("NuovaPass").value;
	var ConfermaPass=document.getElementById("ConfermaPass").value;

	if(VecchiaPass=="" || VecchiaPass == undefined || NuovaPass=="" || NuovaPass == undefined || ConfermaPass =="" || ConfermaPass== undefined){
		document.getElementById("spanrispostapassword").textContent="Compila tutti i campi";
		return;
	}
	else{
		if(NuovaPass != ConfermaPass){
			document.getElementById("spanrispostapassword").textContent="La nuova password è diversa dalla conferma";
			return;
		}
		else{
			document.formpassword.action = "../php/cambiapassword.php";
        	document.formpassword.submit();
        }
	}

}

function puliscispan(){
	var span=document.getElementById("spanrispostapassword").textContent;
	if(span!="")
		document.getElementById("spanrispostapassword").textContent="";
}
/*Fine funzioni cambio password*/

/*Funzioni elimina profilo2*/
function elimina(){
	mes=document.getElementById('sezioneElimina');
	while(mes.hasChildNodes()){
		mes.removeChild(mes.firstChild);
	}
}


/*Fine funzione elimina profilo*/



/*::::::::::::::::FINE FUNZIONI PAGINA IMPOSTAZIONI:::::::::::::::::::::::::*/

/*::::::::::::::::::::FUNZIONI PAGINA POSSODONARE:::::::::::::::::::*/
function tabella(){
	var gruppo= document.getElementById('gruppo').value;
	var x = document.getElementsByClassName("tabinterni");
	var y = document.getElementsByClassName("tabdonatore");
	for (var i = 0; i < 64; i++) {
		x[i].textContent='';
	}
	for (var j = 0; j < 8; j++) {
	 	y[j].style.color="#006bac";
	}

	switch (gruppo){
		case '0 Rh -':
			document.getElementById('0RH-').style.color="#d9271b";
			document.getElementById('00').textContent='OK';
			document.getElementById('10').textContent='OK';
			document.getElementById('20').textContent='OK';
			document.getElementById('30').textContent='OK';
			document.getElementById('40').textContent='OK';
			document.getElementById('50').textContent='OK';
			document.getElementById('60').textContent='OK';
			document.getElementById('70').textContent='OK';
			break;
		case '0 Rh +':
			document.getElementById('0RH+').style.color="#d9271b";
			document.getElementById('11').textContent='OK';
			document.getElementById('31').textContent='OK';
			document.getElementById('51').textContent='OK';
			document.getElementById('71').textContent='OK';
			break;
		case 'A Rh -':
			document.getElementById('ARH-').style.color="#d9271b";
			document.getElementById('22').textContent='OK';
			document.getElementById('32').textContent='OK';
			document.getElementById('62').textContent='OK';
			document.getElementById('72').textContent='OK';
			break;
		case 'A Rh +':
			document.getElementById('ARH+').style.color="#d9271b";
			document.getElementById('33').textContent='OK';
			document.getElementById('73').textContent='OK';
			break;
		case 'B Rh -':
			document.getElementById('BRH-').style.color="#d9271b";
			document.getElementById('44').textContent='OK';
			document.getElementById('54').textContent='OK';
			document.getElementById('64').textContent='OK';
			document.getElementById('74').textContent='OK';
			break;
		case 'B Rh +':
			document.getElementById('BRH+').style.color="#d9271b";
			document.getElementById('55').textContent='OK';
			document.getElementById('75').textContent='OK';
			break;
		case 'AB Rh -':
			document.getElementById('ABRH-').style.color="#d9271b";
			document.getElementById('66').textContent='OK';
			document.getElementById('76').textContent='OK';
			break;
		case 'AB Rh +':
			document.getElementById('ABRH+').style.color="#d9271b";
			document.getElementById('77').textContent='OK';
			break;
		default:
			break;
	}
}
/*FINE FUNZIONI PAGINA POSSODONARE*/

/*::::::::::::::::::::FUNZIONI PAGINA AIUTO:::::::::::::::::::*/

function messaggio(){
	alert("Messaggio inviato correttamente");
	document.getElementById("formmessaggio").submit();
	document.getElementById("messaggioaiuto").value="";

}


function ApriMessaggio(Username,Tempo,Codice,Testo, TestoRisp){
	var url="../php/segnaletto.php";
	var vars="&username=" + Username + "&tempo=" + Tempo;
	AjaxManagerChat.performAjaxRequest("POST", url, true, vars, 4);

	document.getElementById("TitoloSegnalazione").textContent="Messaggio del: "+Tempo;
	document.getElementById("TestoSegnalazione").textContent=Testo;
	if(!TestoRisp){
		document.getElementById("TestoMessaggio").textContent="Non hai ancora ricevuto risposta";
	}
	else{
		document.getElementById("TestoMessaggio").textContent=TestoRisp;
	}
	document.getElementById("AppareSegnalazione").style.display="block";

	document.getElementById(Codice+"img").src="../Immagini/messaggioletto.png";
		document.getElementById(Codice+"em").setAttribute("class","cambiaclasse");
	document.getElementById(Codice+"em").style="font-size: 10pt; font-weight: lighter ; color:inherit;";
	document.getElementById(Codice+'stato').textContent="Messaggio Letto";
}

function ChiudiSegn(){
	document.getElementById("AppareSegnalazione").style.display="none";
}

function AttivaAiuto(){
	var text=document.getElementById("messaggioaiuto");
	var pulsante=document.getElementById("pulsanteaiuto");
	if(text.value!=""){
		pulsante.disabled=false;
	}
	else{
		pulsante.disabled=true;
	}
}
/*::::::::::::::::::::FINE FUNZIONI PAGINA AIUTO:::::::::::::::::::*/
