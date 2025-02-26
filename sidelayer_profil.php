<?PHP 
// script 001 : Compter le nombre de relations du $_SESSION['id']
   $query2 = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = :user_demandeur OR user_receveur = :user_receveur');
   $query2->execute([
       "user_demandeur" => $_SESSION['id'],
       "user_receveur" => $_SESSION['id']

   ]);
   $compteur2 = $query2->rowCount();
   $data2 = $query2->fetchAll();
   $nombre_connectes2 = 0;
   if ($compteur2 !== 0){
       $compteur_provisoire3 = 0;
       for($k=0; $k < sizeof($data2); $k++){
           if(($data2[$k]['user_demandeur'] == $_SESSION['id'] OR $data2[$k]['user_receveur'] == $_SESSION['id']) AND $data2[$k]['statut_demande'] == 0){
               $compteur_provisoire3++;
           }
       }
       $nombre_connectes2 = $compteur_provisoire3;
   }
   // fin du script 001

?>


<div class="sideLayer" style="position: sticky;top:100px; border-radius:5px;background-color:rgba(105, 105, 105, 0.06)">
            <h3 class="titre1"><?PHP echo ' '.$user_info2['prenom'].' '.$user_info2['nom']; ?></h3>
            <?PHP
                if(!empty($user_info2['avatar']))
                {
                    ?>
                        <img src="membres/avatar/<?php echo $user_info2['avatar'];  ?>" id="avatar_default">
                    <?PHP 
                }
            ?>
            <p class="source" style="background-color:rgba(105, 105, 105, 0.09)">Mon profil</p>
            <?PHP 
                if ($user_info2['interlocuteur'] == ''){
            ?>
            <p class="source"><?PHP echo 'Ingénieur '.$user_info2['ecole'].', promo '.$user_info2['promotion']; ?><br></p>
            <p class="source"><?PHP echo 'Diplômé en génie : '; if($user_info2['genie'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['genie']; }?><br></p>
            <?PHP
                }
            ?>
            <p class="source"><i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i> : <?PHP echo $user_info2['email']; ?><br></p>
            <p class="source"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP if($user_info2['phone'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['phone']; } ?><br></p>
            <?PHP 
                if ($user_info2['interlocuteur'] == ''){
            ?>
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
                if(!empty($user_info['pfe']))
                {
                    ?>
                        <a href="membres/pfe/<?php echo $user_info2['pfe'];  ?>" target=_blank id="avatar_default2">Voir</a>
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
            <p class="source" style="text-align:center;"><?PHP echo 'Nombre de relations : '; echo $nombre_connectes2 ; ?><br></p>
            <div style="width:100%; height:60px; display:flex;align-items:center;justify-content:center;gap:15px;">
                <p class="boutton_voir_monprofil">
                    <a href="profil.php?id=<?PHP echo $_SESSION['id']?>">Voir mon profil</a>     
                </p>
                <p class="boutton_editer_monprofil">
                    <a href="edition_profil.php?id=<?PHP echo $_SESSION['id']?>">Editer mon profil</a>     
                </p>
            </div>
        </div>
