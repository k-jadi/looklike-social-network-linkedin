// Script IngSeries
let oef3 = document.getElementById('plus_posts_profil');
let modalContainer33 = document.querySelector('.fenetre_redaction_posts5');
let closeModal44 = document.querySelector('.fenetre_fermeture7');




oef3.addEventListener("click", openSlide35);
function openSlide35() {
    modalContainer33.style.height='100vh';
    modalContainer33.style.top='0vh';
    closeModal44.addEventListener("click", closeSlide35);
}
function closeSlide35() {
    modalContainer33.style.height='0';
    modalContainer33.style.top='100vh';
    
}
