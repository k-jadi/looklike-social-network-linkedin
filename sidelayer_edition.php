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
    <p class="source">&#x1F477; <?PHP echo 'Ingénieur '.$user_info['ecole'].', promo '.$user_info['promotion']; ?><br></p>
    <p class="source"><?PHP echo 'Diplômé en génie : '.$user_info['genie']?><br></p>
    <?PHP 
               }    
    ?>
    <p class="source"><?PHP echo '&#9993; : '.$user_info['email']; ?><br></p>
    <p class="source"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP echo $user_info['phone']; ?></p>
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
</div>
