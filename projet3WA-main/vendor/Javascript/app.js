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


/* 404 redirection*/

let count = 3;

function decrement() {
    count--;
    if(count == 0) {
        window.location = 'index.php';
    }
    else {
        document.getElementById("count").innerHTML = count;
        setTimeout(decrement, 2000);
    }
}
setTimeout(decrement, 2000);