var lastScrollTop = 0;
var dimensione=100;
var dimensione2=150;

window.addEventListener("scroll", function(){
   var st = window.pageYOffset || document.documentElement.scrollTop; 
   var altezza=document.getElementById("divdonazione");
   if (st > lastScrollTop){
     if(dimensione<110&& dimensione2<160){
     var leftTotal = dimensione + 0.1 + "%";
     var leftTotal1= dimensione2 +1 + "%";
     altezza.style.backgroundSize=leftTotal + " " + leftTotal1;
     dimensione=dimensione+0.1;
     dimensione2=dimensione2+0.5;
   }
   } else {
     if(dimensione>100&& dimensione2>150){
     var leftTotal = dimensione - 0.1 + "%";
     var leftTotal1 =dimensione2 - 1 + "%";
     altezza.style.backgroundSize=leftTotal + " " + leftTotal1;
     dimensione=dimensione-0.1;
     dimensione2=dimensione2-0.5;
   }
   }
   lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}, false);
