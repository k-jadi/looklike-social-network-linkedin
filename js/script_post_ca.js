// Script IngSeries
let oef5 = document.getElementById('plus_posts_ca');
let modalContainer55 = document.querySelector('.fenetre_redaction_posts6');
let closeModal55 = document.querySelector('.fenetre_fermeture7');




oef5.addEventListener("click", openSlide55);
function openSlide55() {
    modalContainer55.style.height='100vh';
    modalContainer55.style.top='0vh';
    closeModal55.addEventListener("click", closeSlide55);
}
function closeSlide55() {
    modalContainer55.style.height='0';
    modalContainer55.style.top='100vh';
    
}
