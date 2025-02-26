// Script IngSeries
let fluidea = document.getElementById('fluidea');
let modalContainer2 = document.querySelector('.modalContainer2');
let closeModal2 = document.querySelector('.closeModal2');

let inidev = document.getElementById('inidev');
let modalContainer3 = document.querySelector('.modalContainer3');
let closeModal3 = document.querySelector('.closeModal3');

let cabinetpas = document.getElementById('cabinetpas');
let modalContainer4 = document.querySelector('.modalContainer4');
let closeModal4 = document.querySelector('.closeModal4');

let atlanticbureau = document.getElementById('atlanticbureau');
let modalContainer5 = document.querySelector('.modalContainer5');
let closeModal5 = document.querySelector('.closeModal5');


fluidea.addEventListener('click', () => {
    modalContainer2.classList.add('modalActive');
});

closeModal2.addEventListener ('click', () => {
    modalContainer2.classList.remove('modalActive');
});

inidev.addEventListener('click', () => {
    modalContainer3.classList.add('modalActive');
});

closeModal3.addEventListener ('click', () => {
    modalContainer3.classList.remove('modalActive');
});

cabinetpas.addEventListener('click', () => {
    modalContainer4.classList.add('modalActive');
});

closeModal4.addEventListener ('click', () => {
    modalContainer4.classList.remove('modalActive');
});

atlanticbureau.addEventListener('click', () => {
    modalContainer5.classList.add('modalActive');
});

closeModal5.addEventListener ('click', () => {
    modalContainer5.classList.remove('modalActive');
});