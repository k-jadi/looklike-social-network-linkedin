// Script IngSeries
let oef2 = document.getElementById('plus_posts_m');
let modalContainer22 = document.querySelector('.fenetre_redaction_posts3');
let closeModal33 = document.querySelector('.fenetre_fermeture4');




oef2.addEventListener("click", openSlide22);
function openSlide22() {
    modalContainer22.style.height='100vh';
    modalContainer22.style.top='0vh';
    closeModal33.addEventListener("click", closeSlide22);
}
function closeSlide22() {
    modalContainer22.style.height='0';
    modalContainer22.style.top='100vh';
    
}
