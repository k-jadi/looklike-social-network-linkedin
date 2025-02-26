<?PHP 
// script 001 : Compter le nombre de relations du $_SESSION['id']
   $query = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = :user_demandeur OR user_receveur = :user_receveur');
   $query->execute([
       "user_demandeur" => $_SESSION['id'],
       "user_receveur" => $_SESSION['id']

   ]);
   $compteur = $query->rowCount();
   $data = $query->fetchAll();
   $nombre_connectes = 0;
   if ($compteur !== 0){
       $compteur_provisoire2 = 0;
       for($j=0; $j < sizeof($data); $j++){
           if(($data[$j]['user_demandeur'] == $_SESSION['id'] OR $data[$j]['user_receveur'] == $_SESSION['id']) AND $data[$j]['statut_demande'] == 0){
               $compteur_provisoire2++;
           }
       }
       $nombre_connectes = $compteur_provisoire2;
   }
   // fin du script 001

?>

<div class="sideLayer" style="position: sticky;top:100px; border-radius:5px;background-color:rgba(105, 105, 105, 0.06)">
    <h3 class="titre1"><?PHP echo ' '.$user_info['prenom'].' '.$user_info['nom']; ?></h3>
    <?PHP
        if(!empty($user_info['avatar']))
        {
            ?>
                <img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default">
            <?PHP 
        }
    ?>
    <p class="source" style="background-color:rgba(105, 105, 105, 0.09)">Mon profil</p>
    <?PHP 
        if ($user_info['interlocuteur'] == ''){
    ?>
    <p class="source"><?PHP echo 'Ingénieur '.$user_info['ecole'].', promo '.$user_info['promotion']; ?><br></p>
    <p class="source"><?PHP echo 'Diplômé en génie : '; if($user_info['genie'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info['genie']; }?><br></p>
    <?PHP 
        }    
    ?>
    <p class="source"><i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i> : <?PHP echo $user_info['email']; ?><br></p>
    <p class="source"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP if($user_info['phone'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info['phone']; } ?><br></p>
    <?PHP 
        if ($user_info['interlocuteur'] == ''){
    ?>
    <p class="source"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  Mon CV : 
        <?PHP
            if(!empty($user_info['cv']))
            {
                ?>
                    <a href="membres/cv/<?php echo $user_info['cv'];  ?>" target=_blank id="avatar_default2">Voir</a>
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
            if(!empty($user_info['pfe']))
            {
                ?>
                    <a href="membres/pfe/<?php echo $user_info['pfe'];  ?>" target=_blank id="avatar_default2">Voir</a>
                <?PHP 
            }
            else
            {
                echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';
            }
        ?>
    </p>
    <?PHP 
        }    
    ?>
    <p class="source" style="text-align:center;"><?PHP echo 'Nombre de relations : '; echo $nombre_connectes ; ?><br></p>
    <div style="width:100%; height:60px; display:flex;align-items:center;justify-content:center;gap:15px;">
        <p class="boutton_voir_monprofil">
            <a href="profil.php?id=<?PHP echo $_SESSION['id']?>">Voir mon profil</a>     
        </p>
        <p class="boutton_editer_monprofil">
            <a href="edition_profil.php?id=<?PHP echo $_SESSION['id']?>">Editer mon profil</a>     
        </p>
    </div>
</div>
