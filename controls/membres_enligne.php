<?PHP
    $temps_session = 180;
    $temps_actuel = date("U");
    $utilisateur_ip = $_SERVER['REMOTE_ADDR'];

    $req_ip_exist = $bdd->prepare('SELECT * from enligne WHERE user_ip = ?');
    $req_ip_exist->execute(array($utilisateur_ip));
    $ip_exist = $req_ip_exist->rowCount();

    if ($ip_exist == 0){
        $ajouter_ip = $bdd->prepare('INSERT INTO enligne(user_ip,temps) VALUES(?,?)');
        $ajouter_ip->execute(array($utilisateur_ip,$temps_actuel));

    }else{
        $update_ip = $bdd->prepare('UPDATE enligne SET temps=? WHERE user_ip=? ');
        $update_ip->execute(array($temps_actuel,$utilisateur_ip));

    }

    $supprimer_session = $temps_actuel - $temps_session;

    $del_ip = $bdd->prepare('DELETE FROM enligne WHERE temps < ?');
    $del_ip->execute(array($supprimer_session));

    $afficher_nombre_enligne = $bdd->query('SELECT * FROM enligne');
    $membres_enligne = $afficher_nombre_enligne->rowCount();

?>