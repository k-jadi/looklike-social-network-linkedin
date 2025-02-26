let button_entreprises = document.getElementById("button_entreprises");
let entreprises = document.getElementById("entreprises");
let icon4 = document.getElementById("icon4");


button_entreprises.addEventListener("click", show_entreprises);

function show_entreprises() {
    entreprises.style.maxHeight = "max-content";
    entreprises.style.border = "1px dotted rgba(105, 105, 105, 0.3)";
    icon4.classList.remove('fa-plus');
    icon4.classList.add('fa-minus');
    button_entreprises.removeEventListener("click", show_entreprises);
    button_entreprises.addEventListener("click", hide_entreprises);
}

function hide_entreprises() {
    entreprises.style.maxHeight = "0px";
    entreprises.style.border = "none";
    icon4.classList.remove('fa-minus');
    icon4.classList.add('fa-plus');
    button_entreprises.removeEventListener("click", hide_entreprises);
    button_entreprises.addEventListener("click", show_entreprises);
}

