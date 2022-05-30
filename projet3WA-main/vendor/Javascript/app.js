document.addEventListener('DOMContentLoaded', function(){

    let toggle = document.querySelector ('.toggle');
    let body = document.querySelector('body');
    
    toggle.addEventListener('click', function (){
        body.classList.toggle('open');
    })
});
