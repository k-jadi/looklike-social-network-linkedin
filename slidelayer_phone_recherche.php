<?PHP 
// script 001 : Compter le nombre de relations du $_SESSION['id']
   $query3 = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = :user_demandeur OR user_receveur = :user_receveur');
   $query3->execute([
       "user_demandeur" => $_SESSION['id'],
       "user_receveur" => $_SESSION['id']

   ]);
   $compteur3 = $query3->rowCount();
   $data3 = $query3->fetchAll();
   $nombre_connectes3 = 0;
   if ($compteur3 !== 0){
       $compteur_provisoire4 = 0;
       for($l=0; $l < sizeof($data3); $l++){
           if(($data3[$l]['user_demandeur'] == $_SESSION['id'] OR $data3[$l]['user_receveur'] == $_SESSION['id']) AND $data3[$l]['statut_demande'] == 0){
               $compteur_provisoire4++;
           }
       }
       $nombre_connectes3 = $compteur_provisoire4;
   }
   // fin du script 001

?>


<div style="width: 75%;background-color: #fff;height:100vh; overflow-y:scroll; padding-top: 20px;position:relative;">
    
    <span id="fermeture_barre_lateral"><i class="fa-solid fa-x" style="font-size: 1.5rem; color:orangered"></i></span>
    <?PHP
        if(!empty($user_info2['avatar']))
        {
            ?>
                <img src="membres/avatar/<?php echo $user_info2['avatar'];  ?>" id="avatar_default">
            <?PHP 
        }
    ?>
    <p style="font-family: Arial, Helvetica, sans-serif;font-size:0.8rem;margin-bottom:15px;"><?PHP echo ' '.$user_info2['prenom'].' '.$user_info2['nom']; ?></p>
    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Mon profil</p>
    <p class="source"><?PHP echo 'Ingénieur '.$user_info2['ecole'].', promo '.$user_info2['promotion']; ?><br></p>
    <p class="source"><?PHP echo 'Diplômé en génie : '; if($user_info2['genie'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['genie']; }?><br></p>
    <p class="source"><i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i> : <?PHP echo $user_info2['email']; ?><br></p>
    <p class="source"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP if($user_info2['phone'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['phone']; } ?><br></p>
    <p class="source"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  Mon CV : 
        <?PHP
            if(!empty($user_info2['cv']))
            {
                ?>
                    <a href="membres/cv/<?php echo $user_info2['cv'];  ?>" target=_blank>Voir</a>
                <?PHP 
            }
            else
            {
                echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';
            }
        ?>
    </p>
    <p class="source"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  Mon PFE : 
        <?PHP
            if(!empty($user_info2['pfe']))
            {
                ?>
                    <a href="membres/pfe/<?php echo $user_info2['pfe'];  ?>" target=_blank>Voir</a>
                <?PHP
            }
            else
            {
                echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';
            }
        ?>
    </p>
    <p class="source" style="text-align:center;"><?PHP echo 'Nombre de relations : '; echo $nombre_connectes3 ; ?><br></p>
    <div style="width:100%; height:60px; display:flex;align-items:center;justify-content:center;gap:15px;">
        <p class="boutton_voir_monprofil">
            <a href="profil.php?id=<?PHP echo $_SESSION['id']?>">Voir mon profil</a>     
        </p>
        <p class="boutton_editer_monprofil">
            <a href="edition_profil.php?id=<?PHP echo $_SESSION['id']?>">Editer mon profil</a>     
        </p>
    </div>

    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Mes Docs</p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3);"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;">Bibliothèque</a></p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3); margin-bottom:25px;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;">Pfe</a></p>

    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Autres</p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3);"><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;">Ing Mall</a></p>

</div>
