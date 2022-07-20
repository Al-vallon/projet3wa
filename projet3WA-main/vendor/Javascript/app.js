document.addEventListener("DOMContentLoaded", (event) =>{
  

  
  // hamburger variable
  const menu = document.querySelector(".menu");
  // const menuItems = document.querySelectorAll(".menuItem");
  const hamburger= document.querySelector(".hamburger");
  const closeIcon= document.querySelector(".closeIcon");
  const menuIcon = document.querySelector(".menuIcon");
  
  
  // font size
  let counter = 0;
  const sizeDefault = document.querySelector("#sizeDefault");
  const sizeUp = document.querySelector("#sizeUp");
  const sizeDown = document.querySelector("#sizeDown");
  
  // counter for redirection
  let count = 4;
  const queryCount = document.querySelector(".count");

  
  /*HAMBURGER MENU*/
  function toggleMenu() {
    if(menu.classList.contains("showMenu")) {
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
  
  function decrement() {
      count--;
      if(count == 0) {
          window.location = 'index.php';
      } else {
          queryCount.innerHTML = count; 
          setTimeout(decrement, 1000);
      }
  }
  
  if(queryCount){
    setTimeout(decrement(), 4000);
  }
  
  
  /* TOGGLE ACCESSIBILITY MOD*/
  
   // put toggleAcc class in variable
   let toggleAcc = document.querySelector(".toggleAcc");
   let acc = document.getElementById('acc') ;
  
   // listen event click & function do the job
   toggleAcc.addEventListener('click', function(){
    
    if(acc.style.display == 'block'){ 
      acc.style.display = 'none'; 
      }else {
        acc.style.display = 'block'; 
      }
    
      
  });
  
  
  /* FONT SIZE INCREASE/DEACREASE*/

  
  //get function onclick to change size 0 1 -1;
  sizeDefault.onclick = () => changeFontSize(0);
  sizeDown.onclick = () => changeFontSize(-1);
  sizeUp.onclick = () => changeFontSize(1);
  
  
  function changeFontSize(val){
    if (document.body.style.fontSize == ""){
      document.body.style.fontSize = "1em";
    }
    if (val === 0) {
      document.body.style.fontSize = "1em";
      counter = 0
    } else if(val === -1){
      if(counter > -3){
        counter--
        document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
      }
    } else if(val === 1){
      console.log(counter);
      if(counter < 3){
        counter++
        document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
    
      }
    }

  }
  
  // function changeFontSize(val){
  //   if (document.body.style.fontSize == ""){
  //     document.body.style.fontSize = "1em";
  //   }
  //   if (val === 0) {
  //     document.body.style.fontSize = "1em";
  //     counter = 0
  //   } else if(val === -1){
  //     if(counter > -3){
  //       counter--
  //       localStorage.getItem(document.body.style.fontSize) = localStorage.getItem(parseFloat(document.body.style.fontSize) + (val * 0.3) + "em");
  //     }
  //   } else if(val === 1){
  //     console.log(counter);
  //     if(counter < 3){
  //       counter++
  //       document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
    
  //     }
  //   }

  // }
  
  
  
  
     /* DARK MODE*/

  var darkMode = false;
  
  // if localstorage save theme (=body) as dark but in default is ligth
  if(localStorage.getItem('theme') === 'dark'){
  	darkMode = true;
  } else if(localStorage.getItem('theme') === 'light'){
  	darkMode = false;
  }

  if (darkMode) {
  	document.body.classList.toggle('dark');
  }
  
  document.getElementById('theme-toggle').addEventListener('click', () => {
  	document.body.classList.toggle('dark');
    localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
	});
  
  console.log('logged');
});