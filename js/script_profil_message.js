let md = document.getElementById('message_direct_profil');
let modalContainer39 = document.querySelector('.fenetre_redaction_message_direct');
let closeModal39 = document.querySelector('.fenetre_fermeture_message_direct');



md.addEventListener('click', () => {
    modalContainer39.classList.add('modalActive');
});

closeModal39.addEventListener ('click', () => {
    modalContainer39.classList.remove('modalActive');
});

