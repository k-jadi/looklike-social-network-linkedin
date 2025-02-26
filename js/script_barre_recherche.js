let barre_recherche = document.getElementById('recherche_membres_input');
let barre_recherche_phone = document.getElementById('recherche_membres_input_phone');
let container_recherche = document.getElementById('resultats_recherche_container');
let resultat_recherche = document.getElementById('resultats_recherche');
let form_recherche = document.getElementById('form_recherche');
let form_recherche2 = document.getElementById('form_recherche2');

barre_recherche.addEventListener('input', () => {
    if (barre_recherche.value == '') {
        container_recherche.style.visibility = 'hidden';
    }
    else {
        container_recherche.style.visibility ='visible';
    }
    let xhr = new XMLHttpRequest();
    let data = new FormData(form_recherche);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            let res = this.response;
            console.log(res);
            resultat_recherche.innerHTML = res.div_resultats;
        }
    }
    xhr.open("POST","controls/traitement_recherche.php", true);
    xhr.responseType = "json";
    xhr.send(data);
})




barre_recherche_phone.addEventListener('input', () => {
    if (barre_recherche_phone.value == '') {
        container_recherche.style.visibility = 'hidden';
    }
    else {
        container_recherche.style.visibility ='visible';
    }
    let xhr2 = new XMLHttpRequest();
    let data2 = new FormData(form_recherche2);
    xhr2.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            let res2 = this.response;
            console.log(res2);
            resultat_recherche.innerHTML = res2.div_resultats;
        }
    }
    xhr2.open("POST","controls/traitement_recherche.php", true);
    xhr2.responseType = "json";
    xhr2.send(data2);
})

