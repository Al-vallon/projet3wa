document.addEventListener("DOMContentLoaded", (event) =>{
  

  
  // hamburger variable
  const menu = document.querySelector(".menu");
  const menuItems = document.querySelectorAll(".menuItem");
  const hamburger= document.querySelector(".hamburger");
  const closeIcon= document.querySelector(".closeIcon");
  const menuIcon = document.querySelector(".menuIcon");
  
  
  // font size
  const sizeDefault = document.querySelector("#sizeDefault");
  const sizeUp = document.querySelector("#sizeUp");
  const sizeDown = document.querySelector("#sizeDown");
  
  // counter for redirection
  let count = 3;
  const queryCount = document.querySelector(".count");
  
  // put body in variable          
    const body = document.body;
  
 // DARK MODE
  const togglebtn = document.querySelector(".toogleBtn");
  const toogleDark = document.querySelector(".toggleDark");
  const toogleLight = document.querySelector(".toggleLight");
  
  
  
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
  

  /* FONT SIZE INCREASE/DEACREASE*/
  
  //get function onclick to change size 0 1 -1;
  sizeDefault.onclick = () => changeFontSize(0);
  sizeDown.onclick = () => changeFontSize(-1);
  sizeUp.onclick = () => changeFontSize(1);
  
  let counter = 0;
  
  function changeFontSize(val){
    if (document.body.style.fontSize == ""){
      document.body.style.fontSize = "1em";
    }
    
    if (val == 0) {
      document.body.style.fontSize = "1em";
    }
    
    if(counter++ <= 2){
      document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
      // counter++;
    }else if(counter-- <= 2){
      document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (val * 0.3) + "em";
      // counter--;
    }
  }
  
   /* 404 REDIRECTION*/
  
  
  function decrement() {
      count--;
      if(count == 0) {
          window.location = 'index.php';
      } else {
          // document.querySelector(".count").innerHTML = count;
          queryCount.innerHTML = count; 
          setTimeout(decrement, 3000);
      }
  }
  
  if(queryCount){
    setTimeout(decrement, 3000);
  }
  
  
  /* TOGGLE ACCESSIBILITY MOD*/
   // put toggleAcc class in variable
   let toggleAcc = document.querySelector(".toggleAcc");
   let acc = document.querySelector('.acc') ;
  
   // listen event click & function do the job
   toggleAcc.addEventListener('click', function(){
    
     if(acc.style.display === 'none'){ 
       acc.style.display = 'block'; 
       }else {
         acc.style.display = 'none'; 
       }
  });
  
  
     /* DARK MODE*/

// // put class changeTheme in variable
// const changeTheme = document.querySelector('changeTheme');
 
// // listen the click on body, function execute
// body.addEventListener('click', function(){
      
//     if(changeTheme.classList.contains('dark')){
//       changeTheme.classList.add('light');
//       changeTheme.classList.remove('dark');
      
       
//     } else if(changeTheme.classList.contains('light')){
//         changeTheme.classList.add('dark');
//     changeTheme.classList.remove('light');
//     }
//   });
//   const toggleBtn = document.getElementById("toggle-btn");
// const theme = document.querySelector("theme");
// let darkMode = localStorage.getItem("dark-mode");


// const enableDarkMode = () => {
//   theme.classList.add("dark-mode-theme");
//   toggleBtn.classList.remove("dark-mode-toggle");
//   localStorage.setItem("dark-mode", "enabled");
// };

// const disableDarkMode = () => {
//   theme.classList.remove("dark-mode-theme");
//   toggleBtn.classList.add("dark-mode-toggle");
//   localStorage.setItem("dark-mode", "disabled");
// };

// if (darkMode === "enabled") {
//   enableDarkMode(); // set state of darkMode on page load
// }

// toggleBtn.addEventListener("click", (e) => {
//   darkMode = localStorage.getItem("dark-mode"); // update darkMode when clicked
//   if (darkMode === "disabled") {
//     enableDarkMode();
//   } else {
//     disableDarkMode();
//   }
// });


    
  
  console.log('logged')
});