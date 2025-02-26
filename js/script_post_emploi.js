// Script IngSeries
let oef3 = document.getElementById('plus_posts_emploi');
let modalContainer33 = document.querySelector('.fenetre_redaction_posts4');
let closeModal44 = document.querySelector('.fenetre_fermeture5');




oef3.addEventListener("click", openSlide33);
function openSlide33() {
    modalContainer33.style.height='100vh';
    modalContainer33.style.top='0vh';
    closeModal44.addEventListener("click", closeSlide33);
}
function closeSlide33() {
    modalContainer33.style.height='0';
    modalContainer33.style.top='100vh';
    
}
