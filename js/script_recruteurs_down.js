let button_recruteurs = document.getElementById("button_recruteurs");
let recruteurs = document.getElementById("recruteurs");
let icon3 = document.getElementById("icon3");


button_recruteurs.addEventListener("click", show_recruteurs);

function show_recruteurs() {
    recruteurs.style.maxHeight = "max-content";
    recruteurs.style.border = "1px dotted rgba(105, 105, 105, 0.3)";
    icon3.classList.remove('fa-plus');
    icon3.classList.add('fa-minus');
    button_recruteurs.removeEventListener("click", show_recruteurs);
    button_recruteurs.addEventListener("click", hide_recruteurs);
}

function hide_recruteurs() {
    recruteurs.style.maxHeight = "0px";
    recruteurs.style.border = "none";
    icon3.classList.remove('fa-minus');
    icon3.classList.add('fa-plus');
    button_recruteurs.removeEventListener("click", hide_recruteurs);
    button_recruteurs.addEventListener("click", show_recruteurs);
}

