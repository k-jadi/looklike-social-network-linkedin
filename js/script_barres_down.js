let button_barres = document.getElementById("button_barres");
let barres = document.getElementById("barres");
let icon2 = document.getElementById("icon2");


button_barres.addEventListener("click", show_barres);

function show_barres() {
    barres.style.maxHeight = "max-content";
    barres.style.border = "1px dotted rgba(105, 105, 105, 0.3)";
    icon2.classList.remove('fa-plus');
    icon2.classList.add('fa-minus');
    button_barres.removeEventListener("click", show_barres);
    button_barres.addEventListener("click", hide_barres);
}

function hide_barres() {
    barres.style.maxHeight = "0px";
    barres.style.border = "none";
    icon2.classList.remove('fa-minus');
    icon2.classList.add('fa-plus');
    button_barres.removeEventListener("click", hide_barres);
    button_barres.addEventListener("click", show_barres);
}

