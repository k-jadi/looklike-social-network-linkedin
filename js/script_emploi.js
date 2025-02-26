// Script IngSeries
let oe = document.getElementById('redaction_off_emploi');
let ac = document.getElementById('affichage_cvtheque');
let modalContainer = document.querySelector('.fenetre_redaction_off_emploi');
let modalContainer2 = document.querySelector('.fenetre_redaction_off_emploi2');
let closeModal = document.querySelector('.fenetre_fermeture');
let closeModal2 = document.querySelector('.fenetre_fermeture3');



oe.addEventListener('click', () => {
    modalContainer.classList.add('modalActive');
});

closeModal.addEventListener ('click', () => {
    modalContainer.classList.remove('modalActive');
});

ac.addEventListener('click', () => {
    modalContainer2.classList.add('modalActive');
});

closeModal2.addEventListener ('click', () => {
    modalContainer2.classList.remove('modalActive');
});

