// Script IngSeries
let oe = document.getElementById('creer_post');
let oef = document.getElementById('plus_posts');
let modalContainer = document.querySelector('.fenetre_redaction_posts');
let modalContainer2 = document.querySelector('.fenetre_redaction_posts2');
let closeModal = document.querySelector('.fenetre_fermeture');
let closeModal3 = document.querySelector('.fenetre_fermeture3');



oe.addEventListener('click', () => {
    modalContainer.classList.add('modalActive');
});


oef.addEventListener("click", openSlide2);
function openSlide2() {
    modalContainer2.style.height='100vh';
    modalContainer2.style.top='0vh';
    closeModal3.addEventListener("click", closeSlide2);
}
function closeSlide2() {
    modalContainer2.style.height='0';
    modalContainer2.style.top='100vh';
    
}

closeModal.addEventListener ('click', () => {
    modalContainer.classList.remove('modalActive');
});

