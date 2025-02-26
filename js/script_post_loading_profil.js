// Script IngSeries
let oef3 = document.getElementById('plus_posts_load_profil');
let modalContainer33 = document.querySelector('.fenetre_redaction_posts6');
let closeModal44 = document.querySelector('.fenetre_fermeture11');




oef3.addEventListener("click", openSlide36);
function openSlide36() {
    modalContainer33.style.height='100vh';
    modalContainer33.style.top='0vh';
    closeModal44.addEventListener("click", closeSlide36);
}
function closeSlide36() {
    modalContainer33.style.height='0';
    modalContainer33.style.top='100vh';
    
}
