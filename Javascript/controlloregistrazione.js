
function Modulo() {
    // Variabili associate ai campi del modulo

    var password = document.modulo.password.value;
    var conferma = document.modulo.conferma.value;
    var anno = document.modulo.giorno.value;
    var mese = document.modulo.mese.value;
    var giorno = document.modulo.anno.value;
  


   if (password!='') {
    //Verifica l'uguaglianza tra i campi PASSWORD e CONFERMA PASSWORD
      if (password != conferma) {
          alert("La password confermata è diversa da quella scelta, controllare.");
          document.modulo.conferma.value = "";
          document.modulo.conferma.focus();
          return false;
      }
    }
    if (giorno=="-"|| (giorno == "undefined")){
      alert("Il campo giorno è obbligatorio.");
      document.modulo.giorno.focus();
      return false;
    }
    else if (mese==""|| (mese == "undefined")){
      alert("Il campo mese è obbligatorio.");
      document.modulo.mese.focus();
      return false;
    }
    else if (anno==""|| (anno == "undefined")){
      alert("Il campo anno è obbligatorio.");
      document.modulo.anno.focus();
      return false;
    }
    else{
      document.modulo.submit();
    }
}


function ControllaMese(){
  var mes= document.getElementById("mese");
  if (document.getElementById("giorno").value!='-') {
  while(mes.hasChildNodes()){
    mes.removeChild(mes.firstChild);
  }

  var anno=document.getElementById("anno");
  while(anno.hasChildNodes()){
    anno.removeChild(anno.firstChild);
  }
  if(document.getElementById('giorno').value=="31"){
    for (var i = 1; i <= 12; i++) {
      if((i%2!=0 && i/2<4 )|| (i/2>=4 && i%2==0)){
        var option = document.createElement("option");
        option.text = i;
        option.value = i;
        var select = document.getElementById("mese");
        select.appendChild(option);
      }
    }
  }
else{
    if(document.getElementById('giorno').value=="30"){
      for (var i = 1; i <= 12; i++) {
        if(i!=2){
          var option = document.createElement("option");
          option.text = i;
          option.value = i;
          var select = document.getElementById("mese");
          select.appendChild(option);
        }
      }
    }
    else {
      for (var i = 1; i <= 12; i++) {
          var option = document.createElement("option");
          option.text = i;
          option.value =  i;
          var select = document.getElementById("mese");
          select.appendChild(option);
        }
      }
    }
  document.getElementById('mese').disabled=false;
}
else {
  document.getElementById('anno').disabled=true;
  document.getElementById('mese').disabled=true;
  document.getElementById('mese').value="";
  document.getElementById('anno').value="";
}
}


function ControllaBisestile(){
  var currentTime = new Date();
  var mese=document.getElementById('mese').value;
  var giorno=document.getElementById('giorno').value;
  var ann= document.getElementById("anno");
  var month = currentTime.getMonth() + 1;
  var day = currentTime.getDate();
  var year = currentTime.getFullYear();
  while(ann.hasChildNodes()){
    ann.removeChild(ann.firstChild);
  }

  if (giorno==29 && mese==2) {
    for (var i = 1900; i <=year ; i++) {
          if((i==year && giorno<=day && mese<=month)|| i!=year){
            if((i % 4 == 0 && i % 100 != 0) || i % 400 == 0){
              var option = document.createElement("option");
              option.text = i;
              option.value =  i;
              var select = document.getElementById("anno");
              select.appendChild(option);
            }
          }
        }

  }
  else{
    for (var i = 1900; i <=year ; i++) {
        if((i==year && giorno<=day && mese<=month)|| i!=year){
          var option = document.createElement("option");
          option.text = i;
          option.value =  i;
          var select = document.getElementById("anno");
          select.appendChild(option);
      }

    }

  }
document.getElementById('anno').disabled=false;
}
