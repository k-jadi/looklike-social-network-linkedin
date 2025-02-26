let barre_recherche = document.getElementById('recherche_membres_input');
let resultat_recherche = document.getElementById('message_selection_destinataire');
let form_recherche = document.getElementById('form_recherche');

barre_recherche.addEventListener('input', () => {
    let xhr = new XMLHttpRequest();
    let data = new FormData(form_recherche);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            let res = this.response;
            console.log(res);
            resultat_recherche.innerHTML = res.div_resultats;
        }
    }
    xhr.open("POST","../controls/traitement_recherche_messagerie.php", true);
    xhr.responseType = "json";
    xhr.send(data);
})


