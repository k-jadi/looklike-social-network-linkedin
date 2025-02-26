<div style="width: 75%;background-color: #fff;height:100vh; overflow-y:scroll; padding-top: 20px;position:relative;">
    
    <span id="fermeture_barre_lateral"><i class="fa-solid fa-x" style="font-size: 1.5rem; color:orangered"></i></span>
    <?PHP
        if(!empty($user_info['avatar']))
        {
            ?>
                <img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default">
            <?PHP 
        }
    ?>
    <p style="font-family: Arial, Helvetica, sans-serif;font-size:0.8rem;margin-bottom:15px;"><?PHP echo ' '.$user_info['prenom'].' '.$user_info['nom']; ?></p>
    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Mon profil</p>
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
                    <a href="membres/cv/<?php echo $user_info['cv'];  ?>" target=_blank>Voir</a>
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
                    <a href="membres/pfe/<?php echo $user_info['pfe'];  ?>" target=_blank>Voir</a>
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
    <div class="loading_edition" style="border-bottom: 1px dotted rgba(105, 105, 105, 0.2);">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>

    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Mes Documents</p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3);"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;">Bibliothèque</a></p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3); margin-bottom:25px;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;">Pfe</a></p>

    <p class="source" style="background-color:rgba(105, 105, 105, 0.05)">Autres</p>
    <p class="source" style="color: rgba(105, 105, 105, 0.3);">Ing Mall</p>

</div>
