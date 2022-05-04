
function AppareLogin(){
  if (document.getElementById("AppareLogin").style.visibility=="visible") {
    document.getElementById("AppareLogin").style.visibility="hidden";
  }
  document.getElementById("AppareLogin").style.visibility="visible";
  return;
}


function ChiudiLogin(){
  document.getElementById("AppareLogin").style.visibility="hidden";
  return;
  }

////////////////////SLIDESHOW//////////////////////
  var slideIndex = 0;
  var time=6000;
  var block=0;

 // Pulsante Navigazione
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    block=1;
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      slides[i].style.opacity='1';
    }
    slides[slideIndex-1].style.display = "block";


  }

  function firstSlide(){
    slideIndex++;
    setTimeout("automaticSlides()", time);

  }

  function automaticSlides() {
    if(block==0){
      var slides = document.getElementsByClassName("mySlides");
        if (slideIndex >= slides.length) {
          slideIndex = 0
        }
        if ( slideIndex < 1) {
          var torna=slides.length-1;
          fade(slides[torna],slideIndex, slides) ;
        }
        else{
          fade(slides[slideIndex-1], slideIndex, slides);
        }

        slideIndex=slideIndex+1;
        setTimeout("automaticSlides()", time);
      }

  }

  function fade(element, slideIndex,slides) {
    var op = 1;  // opacità iniziale
    var timer = setInterval(function () {
        if (op < 0.1){
            clearInterval(timer);
            element.style.display = 'none';
            unfade(slides[slideIndex]);

        }
        element.style.opacity = op;
        op -= op * 0.1;
    }, 50);
}

function unfade(element) {
    var op = 0.1;  // opacità iniziale
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op > 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        op += op * 0.1;
    }, 30);
}

function AppareContatti(numero){
  var node=document.getElementById("titolocontatto");
  var node1=document.getElementById("Appendi");
  switch (numero) {
    case 0:
      node.textContent="Indirizzo:";
      node1.textContent="Via Roma 100, Siniscola NU 08029";
      break;
    case 1:
      node.textContent="Telefono:";
      node1.textContent="0784878787";
      break;
    case 2:
      node.textContent="Cellulare:";
      node1.textContent="333/3333333";           
      break;
    default:

  }
  document.getElementById("AppareContatti").style.display="block";
}

function chiudicontatto(){
  document.getElementById("AppareContatti").style.display="none";
}
