// document.addEventListener("DOMContentLoaded", function(e){
//   console.log('logged')
  
  /*HAMBURGER MENU*/
  const menu = document.querySelector(".menu");
  const menuItems = document.querySelectorAll(".menuItem");
  const hamburger= document.querySelector(".hamburger");
  const closeIcon= document.querySelector(".closeIcon");
  const menuIcon = document.querySelector(".menuIcon");
  
  function toggleMenu() {
    if (menu.classList.contains("showMenu")) {
      menu.classList.remove("showMenu");
      closeIcon.style.display = "none";
      menuIcon.style.display = "block";
    } else {
      menu.classList.add("showMenu");
      closeIcon.style.display = "block";
      menuIcon.style.display = "none";
    }
  }
  
  hamburger.addEventListener("click", toggleMenu);
  
  
  /* 404 REDIRECTION*/
  
  let count = 3;
  
  function decrement() {
      count--;
      if(count == 0) {
          window.location = 'index.php';
      }
      else {
          document.getElementById("count").innerHTML=count;
          setTimeout(decrement, 3000);
      }
  }
  setTimeout(decrement, 3000);
  
  
  /* FONT SIZE INCREASE*/
  let counter = 0;
  
  function changeFontSize(val){
    if (document.body.style.fontSize == ""){
      document.body.style.fontSize = "1.0em";
    }
    
    if (val == 0) {
      document.body.style.fontSize = "1.0em";
    }
    
    if(counter++ <= 2){
      document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
      // counter++;
    }else if(counter-- <= 2){
      document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
      // counter--;
    }
    
  }
  
// });