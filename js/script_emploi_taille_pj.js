function pjmessage(){
    let size = document.getElementById('piece_jointe_offre_emploi').files[0].size;
    let type = document.getElementById('piece_jointe_offre_emploi').files[0].type;
    let pjerror = document.getElementById('texte_erreure_pj');
    if (type !== "application/pdf"){
       pjerror.innerHTML = "Erreure : Seulement le format PDF est accépté.";
    }else if (size > 10485760) {
       pjerror.innerHTML = "Erreure : Taille max accéptée est de 10 Mo !";
    }
    else {
       pjerror.innerHTML = " ";
    }
    }