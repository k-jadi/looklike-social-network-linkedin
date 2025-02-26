<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
if(isset($_GET['id']) AND isset($_SESSION['id']) )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

   $req_user2 = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user2->execute(array($_SESSION['id']));
   $user_info2 = $req_user2->fetch();

   $inscrits = $bdd->query('SELECT * FROM coordonnees_membres');
   $nombre_inscrits = $inscrits->rowCount();
   
   include('controls/traitement_php_posts.php');

// script 001 : Compter le nombre de relations du profil affiché
   $query = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = :user_demandeur OR user_receveur = :user_receveur');
   $query->execute([
       "user_demandeur" => $get_id,
       "user_receveur" => $get_id

   ]);
   $compteur = $query->rowCount();
   $data = $query->fetchAll();

   $nombre_connectes = 0;

   if ($compteur !== 0){
       $compteur_provisoire2 = 0;
       for($j=0; $j < sizeof($data); $j++){
           if(($data[$j]['user_demandeur'] != $get_id OR $data[$j]['user_receveur'] != $get_id) AND $data[$j]['statut_demande'] == 0){
               $compteur_provisoire2++;
           }
       }
       $nombre_connectes = $compteur_provisoire2;
   }
// fin du script 001


?>


<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Ing.</title>
   <?PHP include('controls/inscrits_barres.php'); ?>
</head>
<body>



<!-- Header *********************************************************************************** -->

   <!-- Menu + profil caché à gauche à utiliser sur le phone viewer -->
   <div class="barre_lateral" id="barre_lateral">
      <?PHP include('slidelayer_phone_recherche.php'); ?>
   </div>

   <!-- Partie Header both desk & phone viewers -->
   <header id="header_hidden">
      <h1>Ing.</h1>
      <div>
         <div  style="display:flex;align-items:center;justify-content:left;background-color:#fff;width:95%;padding:0px 10px;border-radius:5px;">
            <i class="fa-solid fa-magnifying-glass" style="color: #000;font-size:1rem;width:13%;"></i>
            <form action="load_profiles.php?id=<?PHP echo $_SESSION['id']; ?>" method="POST" id="form_recherche" style="width: 85%;">
               <input type="search" placeholder="Recherche" name="recherche_membres_input" id="recherche_membres_input" style="width: 100%; height:30px;border-radius:5px;border:none;outline:none;padding:0px 5px;">
            </form>
         </div>
      </div>
      <div id="avatar">
         <?PHP
            if(!empty($user_info2['avatar']))
            {
                  ?>
                     <img src="membres/avatar/<?php echo $user_info2['avatar'];  ?>" id="avatar_default2">
                  <?PHP 
            }
         ?>
      </div>
      <ul>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-house"></i><span>Acceuil</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-user-group"></i><span>Réseau</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase"></i><span>Emploi</span></div></a></li>
         <?PHP 
               if ($user_info2['interlocuteur'] == ''){
         ?>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book"></i><span>Bibliothèque</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book-bookmark"></i><span>Pfe</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-store"></i><span>Ing Mall</span></div></a></li>
         <?PHP 
               }    
         ?>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="deconnexion.php"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-right-from-bracket"></i><span>Quitter</span></div></a></li>
      </ul>
      <div class="recherche_membres_input">
         <div  style="display:flex;align-items:center;justify-content:left;background-color:#fff;width:98%;padding:0px 10px;border-radius:5px;">
            <i class="fa-solid fa-magnifying-glass" style="color: #000;font-size:1rem;width:13%;"></i>
            <form action="load_profiles.php?id=<?PHP echo $_SESSION['id']; ?>" method="POST"  id="form_recherche2" style="width: 85%;">
               <input type="search" placeholder="Recherche" name="recherche_membres_input_phone" id="recherche_membres_input_phone" style="width: 100%; height:30px;border-radius:5px;border:none;outline:none;padding:0px 5px;">
            </form>
         </div>
         <!-- <div style="width: 15%;">
            <i class="fa-solid fa-message" style="margin-left:15px;color:white;font-size:1.5rem"></i>
         </div> -->
      </div>
   </header>



<!-- Fenêtre des résultats asynchrone de recherche *****************************************  -->
<div class="resultats_recherche_container" id="resultats_recherche_container">
   <div class="resultats_recherche" id="resultats_recherche">
      
   </div>
</div>


<!-- Barre horizontale de séparation vide fixe ********************************************** -->
   <div class="barreVide"></div>




<!-- fenêtre ouvrante pour redaction des posts pour phone viewer ****************************************** -->
<div class="fenetre_redaction_posts5">
   <div class="sous_fenetre_redaction_posts">
      <p>Bonjour <?PHP echo $user_info['prenom'] ?>,<br><br></p>
      <!-- Formulaire pour les posts phone -->
      <form action="" method="post" enctype="multipart/form-data" id="form_posts_pc2">
         <textarea  name="texte_posts2" required  id="texte_posts2" placeholder="De quoi souhaitez-vous discuter ?" rows="14" style="width:100%;padding: 10px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;margin-bottom:25px;resize:none;"></textarea>
         <div style="display:flex;justify-content:right;">
            <p style="border: 1px dotted gray;border-radius:5px; position:relative;display:flex; align-items:center;justify-content:center; width:120px;height:120px;text-align:center;background-image:url('imgindex/visualisez_limage_ici2.png');background-repeat: no-repeat;" id="image_wrapper2">
               <span id="fermerphoto2"  style="display:flex; align-items:center;justify-content:center;cursor:pointer;position: absolute; top:5px; right:10px;border-radius:50%;background-color:rgba(105, 105, 105, 0.7);width:20px;height:20px;"><i class="fa-solid fa-x" style="font-size: 0.8rem; color:#fff"></i></span>
            </p>
         </div>
         <div style="text-align:center;">
            <input type="submit" value="Poster" id="button2" name="submit_posts2" style="position:absolute;bottom:9vh;right:15px;background-color:beige;width:100px">
         </div>
      </form>
      <div>
         <label>
            <input type="file" style="display:none;" name="piece_jointe_posts2" id="piece_join_posts2" accept=".jpg, .png, .gif, .jpeg">
            <p style="text-align:left;">
               <i class="fa fa-picture-o" aria-hidden="true" style="cursor:pointer;position:absolute;bottom:18vh;left:15px;font-size: 2rem;"></i>
               <hr style="position:absolute;bottom:15vh;left:20px;width:95%; border: 1px dotted rgba(105, 105, 105, 0.3);">
            </p>
         </label>
      </div>
      <!-- Fin Formulaire pour les posts phone -->
      <span class="fenetre_fermeture7"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
   </div>
</div>

   <!-- fenêtre ouvrante pour redaction de message direct -->
   <div class="fenetre_redaction_message_direct">
      <div class="sous_fenetre_redaction_message_direct">
         <?PHP  
            $photo_affichee = $bdd->prepare('SELECT prenom, nom, avatar FROM coordonnees_membres WHERE id=?');
            $photo_affichee->execute(array($get_id));
            $photo_affichee_finale = $photo_affichee->fetch();
            include('controls/redaction_profil_message_direct.php');
         ?>
      </div>
   </div>


   
<!-- Main page ***************************************************************************************** -->
   <div class="wraper" style="position: relative;">
        <!--  SIDE LAYER GAUCHE -->
         <?PHP include('sidelayer_profil.php'); ?>

      <!--  SIDE LAYER MILIEU -->
      <div class="container">
        <h3 class="titre1"><?PHP echo ' '.$user_info['prenom'].' '.$user_info['nom']; ?></h3>
        <?PHP
            if(!empty($user_info['avatar']))
            {
                ?>
                    <p style="text-align:center;" ><img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default5"></p>
                <?PHP 
            }
        ?>
        <p class="source" style="background-color:rgba(105, 105, 105, 0.09);text-align:center;">Mon profil</p>
        <?PHP 
                if ($user_info['interlocuteur'] == '' AND $user_info['promotion'] != 0 ){
         ?>
        <p class="source" style="text-align:center;"><?PHP echo 'Ingénieur '.$user_info['ecole'].', promo '.$user_info['promotion']; ?><br></p>
        <p class="source" style="text-align:center;"><?PHP echo 'Diplômé en génie : '; if($user_info['genie'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info['genie']; }?><br></p>
        <?PHP 
                }
         ?>
        <p class="source" style="text-align:center;"><i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i> : <?PHP echo $user_info['email']; ?><br></p>
        <p class="source" style="text-align:center;"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP if($user_info['phone'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info['phone']; } ?><br></p>
        <?PHP 
                if ($user_info['interlocuteur'] == '' AND $user_info['promotion'] != 0  ){
         ?>
        <p class="source" style="text-align:center;"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  CV : 
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
        <p class="source" style="text-align:center;"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  PFE : 
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
        <?PHP 
                if (($user_info2['interlocuteur'] == ''  AND $user_info['interlocuteur'] != '' ) OR ($user_info2['interlocuteur'] != ''  AND $user_info['interlocuteur'] != '' )){
         ?>
            <p class="source" style="background-color:rgba(105, 105, 105, 0.09);text-align:center; margin-top:15px;">Ma fiche recruteur</p>
            <p class="source_mes_experiences">
               <?PHP
                  if($user_info2['informations_recruteur'] != '')
                  {
                     echo $user_info2['informations_recruteur'];
                  }
                  else
                  {
                     echo '<span style="color:rgba(241, 29, 29, 0.7); font-size:0.8rem;">Non renseigné</span>';
                  }
               ?>
            </p>
         <?PHP 
                }
         ?>
        <?PHP 
                if ($user_info['interlocuteur'] == '' AND $user_info['promotion'] != 0  ){
         ?>
        <p class="source" style="text-align:center;background-color:rgba(105, 105, 105, 0.09);margin-top:20px;">Mon nombre d'années d'experience<br></p>
        <p class="source_competences">
            <?PHP
               $annees_experience = intval(date("Y")) - $user_info['promotion'];

               echo '<span style="display:inline-block;color:#fff; font-size:2.5rem;text-align:center;line-height:60px;width:60px;height:60px;background-color:rgba(105, 105, 105, 0.5);border-radius:50%;">'.$annees_experience.'</span>';
            ?>
        </p>
        <p class="source" style="text-align:center;background-color:rgba(105, 105, 105, 0.09);margin-top:20px;">Mes domaines d'expertise<br></p>
        <p class="source_competences">
            <?PHP
                  if($user_info['competences'] != '')
                  {
                     echo $user_info['competences'];
                  }
                  else
                  {
                     echo '<span style="color:rgba(241, 29, 29, 0.7); font-size:0.8rem;">Non renseigné</span>';
                  }
            ?>
        </p>
        <p class="source" style="text-align:center;background-color:rgba(105, 105, 105, 0.09);margin-top:20px;">Mes expériences PRO<br></p>
        <p class="source_mes_experiences">
            <?PHP
                  if($user_info['mes_experiences'] != '')
                  {
                     echo nl2br($user_info['mes_experiences']);
                  }
                  else
                  {
                     echo '<span style="color:rgba(241, 29, 29, 0.7); font-size:0.8rem;">Non renseigné</span>';
                  }
            ?>
        </p>
        <p class="source" style="text-align:center;background-color:rgba(105, 105, 105, 0.09);margin-top:20px;">Mes réalisations PRO<br></p>
        <p class="source_mes_experiences">
            <?PHP
                  if($user_info['mes_realisations'] != '')
                  {
                     echo nl2br($user_info['mes_realisations']);
                  }
                  else
                  {
                     echo '<span style="color:rgba(241, 29, 29, 0.7); font-size:0.8rem;">Non renseigné</span>';
                  }
            ?>
        </p>
        <?PHP 
                }
        ?>
        <?PHP 

         $verifcation_req_1 = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = ? AND user_receveur = ?');
         $verifcation_req_1->execute(array($_SESSION['id'],$get_id));
         $compteur_1 = $verifcation_req_1->rowCount();
         $verification_1 = $verifcation_req_1->fetch();

         $verifcation_req_2 = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = ? AND user_receveur = ?');
         $verifcation_req_2->execute(array($get_id,$_SESSION['id']));
         $compteur_2 = $verifcation_req_2->rowCount();
         $verification_2 = $verifcation_req_2->fetch();
         if ($user_info['id'] != $user_info2['id']){
            ?>
            <p class="source" style="text-align:center;background-color:rgba(105, 105, 105, 0.09);margin-top:20px;">Me contacter<br></p>
            <div style="width:100%; height:90px;border: 1px dotted rgba(105, 105, 105, 0.2); display:flex;align-items:center;justify-content:center;gap:15px;">
            <?PHP
            if($compteur_1 == 0 AND $compteur_2 == 0) {
               echo '
                  <p style="text-align:center;margin:25px 0px;">
                        <a href="controls/se_connecter.php?id='.$_SESSION['id'].'&id_relation='.$get_id.'" style="text-decoration:none;"><button style="background-color:rgba(46, 15, 158, 0.4);color:#fff;cursor:pointer;width:125px; border: 1px dotted rgba(105, 105, 105, 0.2);padding:5px;border-radius:5px;">+ Se connecter</button></a>
                  </p>
               ';
            } else if (($compteur_1 !== 0 AND $verification_1['statut_demande'] == 1) OR ($compteur_2 !== 0 AND $verification_2['statut_demande'] == 1)) {
               echo '
                  <p style="text-align:center;margin:25px 0px;">
                     <button style="background-color:rgba(235, 131, 131, 0.2);width:125px; border: 1px dotted rgba(105, 105, 105, 0.2);padding:5px;border-radius:5px;">! En attente</button>
                  </p>
               ';
            } else if (($compteur_1 !== 0 AND $verification_1['statut_demande'] == 0) OR ($compteur_2 !== 0 AND $verification_2['statut_demande'] == 0) ) {
               echo '
                  <p style="text-align:center;margin:25px 0px;">
                     <button style="background-color:rgba(45, 202, 45, 0.4);width:125px; border: 1px dotted rgba(105, 105, 105, 0.2);padding:5px;border-radius:5px;">Connecté !</button>
                  </p>
               ';
            }
            ?>
            <p id="message_direct_profil" style="text-align:center;margin:25px 0px;">
               <button  style="background-color:rgba(46, 15, 158, 0.4);color:#fff;cursor:pointer;width:125px; border: 1px dotted rgba(105, 105, 105, 0.2);padding:5px;border-radius:5px;">Message</button>
            </p>
            </div>
            <?PHP
         }
         ?>
    </div>
      <!--  SIDE LAYER DROITE -->
      <?php include('sidelayer_lacommunaute.php') ?>
   </div>

   <br><br><br><br><br><br><br><br><br><br>

<!-- Le footer for both desk & phone viewers ************************************************************ -->
   <footer id="footer_index">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

   <div id="footer_post">
      <div  id="plus_posts_profil" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-plus" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Post</span></div>
         <!-- <p><i class="fa-solid fa-plus" style="font-size: 1.5rem;" id="plus_posts"></i></p> -->
         <div style="height:100%;width:20%;padding:0px;position: absolute; right : 80%;display:flex;align-items:center;justify-content:center;">
            <a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-house-chimney" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Acceuil</span></div></a>
         </div>
         <div style="height:100%;width:20%;padding:0px;position: absolute; right : 60%;display:flex;align-items:center;justify-content:center;">
               <a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-user-group" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Mon réseau</span></div></a>
         </div>
         <div style="height:100%;width:20%;padding:0px;position: absolute; right : 20%;display:flex;align-items:center;justify-content:center;">
            <a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-briefcase" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Emploi</span></div></a>
         </div>
         <div style="height:100%;width:20%;padding:0px;position: absolute; right : 0%;display:flex;align-items:center;justify-content:center;">
            <a href="deconnexion.php" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-right-from-bracket" style="font-size:1rem;"></i><span style="font-size: 0.7rem;">Quitter</span></div></a>
         </div>
      </div>
   

<!-- Les scripts JS ************************************************************************************ -->
   <script src="js/script_post.js"></script>
   <script src="js/script_comments.js"></script>
   <script src="js/script_barres_down.js"></script>
   <script src="js/script_recruteurs_down.js"></script>
   <?PHP include('controls/creation_scripts_js_textarea_boutton_commentaires.php'); ?>
   <?PHP include('controls/creation_scripts_js_asychrone_traitement_commentaires.php'); ?>
   <script src="js/script_footer_scroll_hidden.js"></script>
   <script src="js/script_header_scroll_hidden.js"></script>
   <script src="js/script_resize_image_posts_phone.js"></script>
   <script src="js/script_resize_image_posts.js"></script>
   <script src="js/script_barre_lateral.js"></script>
   <script src="js/script_barre_recherche.js"></script>
   <script src="js/script_post_profil.js"></script>
   <script src="js/script_profil_message.js"></script>
   
   


   
</body>
</html>
<?PHP 
}
else
{
   header('Location: index.php');
}
?>