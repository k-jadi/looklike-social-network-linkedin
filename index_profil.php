<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=u282907555_kjadi_membres','u282907555_kjadi_membres','Maroc-2023@2024');

// Création des variables utilisateur, inscrits et en ligne ***************************************
if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

   $inscrits = $bdd->query('SELECT * FROM coordonnees_membres');
   $nombre_inscrits = $inscrits->rowCount();
   
   include('controls/membres_enligne.php');
   include('controls/traitement_php_posts.php');

   

?>

<!-- Affichage de la page entière ***************************************************************** -->
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
         <?PHP include('slidelayer_phone.php'); ?>
      </div>

      <!-- section messagerie cachée à droite à utiliser sur le phone viewer -->
      <div id="barre_section_messagerie">
         <div style="background-color:#000;width:100%;height:65px;display:flex;align-items:center;justify-content:left;border-bottom: 1px dotted rgba(105, 105, 105, 0.7);">
            <div style="height:65px;border-right: 1px dotted #fff;width:15%;display:flex;align-items:center;justify-content:center;">
               <i class="fa-solid fa-arrow-left" id="sortie_messagerie_phone" style="font-size: 1.5rem;color:#fff"></i> 
            </div>
            <div style="height:65px;border-right: 1px dotted #fff;width:70%;display:flex;align-items:center;justify-content:center;">
               <p style="text-align:center;font-family: Arial, Helvetica, sans-serif;font-size:1.4rem;color:#fff;font-weight:bold">Messagerie</p> 
            </div>
            <div style="height:65px;width: 15%;display:flex;align-items:center;justify-content:center;" id="ecrire_message_phone">
               <i class="fa-solid fa-pen-to-square" style="font-size:1.3rem;color:#fff;"></i>
            </div>
         </div>
         <iframe src="controls/corps_messagerie_phone.php?id=<?PHP echo $_SESSION['id']; ?>" id="iframe_messagerie_phone"></iframe>
      </div>
      <!-- section messagerie redaction cachée à droite à utiliser sur le phone viewer -->
      <div id="barre_section_messagerie_redaction">
         <div style="background-color:#000;width:100%;height:65px;display:flex;align-items:center;justify-content:left;border-bottom: 1px dotted rgba(105, 105, 105, 0.7);">
            <div style="height:65px;border-right: 1px dotted #fff;width:15%;display:flex;align-items:center;justify-content:center;">
               <i id="sortie_messagerie_redaction_phone" class="fa-solid fa-arrow-left" style="font-size: 1.5rem;color:#fff"></i>
            </div>
            <div style="height:65px;width:85%;display:flex;align-items:center;justify-content:center;">
               <p style="text-align:center;font-family: Arial, Helvetica, sans-serif;font-size:1.4rem;color:#fff;font-weight:bold">Nouveau message</p> 
            </div>
         </div>
         <iframe src="controls/nouveau_message_phone.php?id=<?PHP echo $_SESSION['id']; ?>" id="iframe_messagerie_phone_redaction"></iframe>
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
               if(!empty($user_info['avatar']))
               {
                     ?>
                        <img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default2">
                     <?PHP 
               }
            ?>
         </div>
         <ul>
            <li style="display:flex;align-items:center;justify-content:center;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-house" style="color:rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);;">Acceuil</span></div></a></li>
            <li style="display:flex;align-items:center;justify-content:center;">
               <a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>">
                  <div id="icone_reseau" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;">
                     <?PHP  
                        $compteur_notifications_relations = $bdd->prepare('SELECT * FROM notifications_relations WHERE id_destinataire_relations = ?');
                        $compteur_notifications_relations->execute(array($_SESSION['id']));
                        $compteur_notifications_relations = $compteur_notifications_relations->rowCount();
                        if ($compteur_notifications_relations != 0){
                     ?>
                        <div id="notification_relations" style="position:absolute;top:13%;right:31.5%;width:17px;height:17px;display:flex;align-items:center;justify-content:center;background-color:red;border-radius:50%;">
                           <p style="color: #fff; font-size:0.8rem; text-align:center;">
                              <?PHP echo $compteur_notifications_relations; ?>
                           </p>
                        </div>
                     <?PHP 
                        }
                     ?>
                     <i class="fa-solid fa-user-group"></i>
                     <span>Réseau</span>
                  </div>
               </a>
            </li>
            <li style="display:flex;align-items:center;justify-content:center;"><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase"></i><span>Emploi</span></div></a></li>
            <?PHP 
               if ($user_info['interlocuteur'] == ''){
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
            <div  style="display:flex;align-items:center;justify-content:left;background-color:#fff;width:83%;padding:0px 10px;border-radius:5px;">
               <i class="fa-solid fa-magnifying-glass" style="color: #000;font-size:1rem;width:13%;"></i>
               <form action="load_profiles.php?id=<?PHP echo $_SESSION['id']; ?>" method="POST"  id="form_recherche2" style="width: 85%;">
                  <input type="search" placeholder="Recherche" name="recherche_membres_input_phone" id="recherche_membres_input_phone" style="width: 100%; height:30px;border-radius:5px;border:none;outline:none;padding:0px 5px;">
               </form>
            </div>
            <div style="width: 15%;display:flex;align-items:center;justify-content:center;" id="icone_messagerie_phone">
               <i class="fa-solid fa-comment-dots" style="margin-left:15px;color:white;font-size:1.4rem"></i>
               <?PHP  
               $compteur_notifications = $bdd->prepare('SELECT * FROM notifications_messages_entete WHERE id_destinataire_notification = ?');
               $compteur_notifications->execute(array($_SESSION['id']));
               $compteur_notifications = $compteur_notifications->rowCount();
               if ($compteur_notifications != 0){
            ?>
               <div id="notification_message_entete_phone" style="position:absolute;top:11px;right:2%;width:18px;height:18px;display:flex;align-items:center;justify-content:center;background-color:red;border-radius:50%;">
                  <p style="color: #fff; font-size:0.7rem; text-align:center;">
                     <?PHP echo $compteur_notifications; ?>
                  </p>
               </div>
            <?PHP 
               }
            ?>
            </div>
            
         </div>
      </header>



   <!-- Fenêtre des résultats asynchrone de recherche *****************************************  -->
   <div class="resultats_recherche_container" id="resultats_recherche_container">
      <div class="resultats_recherche" id="resultats_recherche">
         
      </div>
   </div>


   <!-- Barre horizontale de séparation vide fixe ********************************************** -->
      <div class="barreVide"></div>




   <!-- Menu flottant hors flux DOM pour l'administartion ************************************** -->
      <?PHP if ($_SESSION['id'] == 23){ ?>
         <div style="padding:5px;position: absolute; top: 25vhpx; right:0px; background-color: rgba(105,105,105,0.5);z-index:53; ">
            <span style="color:#fff;font-size:0.8rem;">En ligne : <?php echo $membres_enligne; ?></span><br>
            <?PHP
            $membres_preinscrits = $bdd->query('SELECT * FROM coordonnees_membres WHERE confirmation=0');
            $membres_enattente = $membres_preinscrits->rowCount();
            ?>
            <span style="color:#fff;font-size:0.8rem;">En attente : <a href="membres_gestion.php?id=<?PHP echo $_SESSION['id']; ?>" style="color:#fff;"><?php echo $membres_enattente; ?></a></span><br>
            <span style="color:#fff;font-size:0.8rem;"><a href="base_membres.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;color:#fff;">Les membres</a></span>
         </div>
      <?PHP
      }
      ?>

   <!-- Menu flottant hors flux DOM pour section entete messagerie ************************************** -->
         <div id="section_messagerie_pc">
            <?PHP  
               $compteur_notifications = $bdd->prepare('SELECT * FROM notifications_messages_entete WHERE id_destinataire_notification = ?');
               $compteur_notifications->execute(array($_SESSION['id']));
               $compteur_notifications = $compteur_notifications->rowCount();
               if ($compteur_notifications != 0){
            ?>
               <div id="notification_message_entete" style="position:absolute;top:27%;right:49%;width:20px;height:20px;display:flex;align-items:center;justify-content:center;background-color:red;border-radius:50%;">
                  <p style="color: #fff; font-size:0.8rem; text-align:center;">
                     <?PHP echo $compteur_notifications; ?>
                  </p>
               </div>
            <?PHP 
               }
            ?>
            <p style="width:50%;text-align:left;color:#fff;font-size:0.8rem;padding-left:10px;"><img src="membres/avatar/<?PHP echo $user_info['avatar'] ?>" style="vertical-align:middle; width:35px; height: 35px;border-radius:50%;margin-right:10px;" >Messagerie</p>
            <div style="width:50%;color:#fff;font-size:0.8rem;text-align:right;display:flex;align-items:center;justify-content:right;">
               <div class="messagerie_icon"  id="ecrire_message" >
                  <i class="fa-solid fa-pen-to-square" style="font-size:0.8rem;color:#fff;"></i>
               </div>
               <div class="messagerie_icon"  id="cheveron_up">
                  <i class="fa-solid fa-chevron-up" style="font-size:0.8rem;color:#fff;" id="chevron"></i>
               </div>
            </div>
         </div>

   <!-- Menu flottant hors flux DOM pour section corps messagerie ************************************** -->
            <div id="section_corps_messagerie_pc">
               <iframe src="controls/corps_messagerie_pc.php?id=<?PHP echo $_SESSION['id']; ?>" id="iframe_messagerie"></iframe>
            </div>

   <!-- Menu flottant hors flux DOM pour section ecrire un message ************************************** -->
         <div id="section_ecrire_message_pc">
            <div style="display: flex;align-items:center;justify-content:center;background-color:#000;height:50px;width:100%;border-top-left-radius:5px;border-top-right-radius: 5px;">
               <p style="width:50%;text-align:left;color:#fff;font-size:0.8rem;padding-left:10px;">Nouveau Message</p>
               <div style="width:50%;color:#fff;font-size:0.8rem;text-align:right;display:flex;align-items:center;justify-content:right;padding-right:10px;">
                  <div class="messagerie_icon"  id="fermer_ecrire_message" >
                     <i class="fa-solid fa-xmark" style="font-size:1rem;color:#fff;"></i>
                  </div>
               </div>
            </div>
            <iframe src="controls/nouveau_message_pc.php?id=<?PHP echo $_SESSION['id']; ?>" id="iframe_nouveau_message"></iframe>
         </div>




   <!-- fenêtre ouvrante pour redaction des posts pour desk viewer ******************************************* -->
   <div class="fenetre_redaction_posts">
      <div class="sous_fenetre_redaction_posts">
         <p>Bonjour <?PHP echo $user_info['prenom'] ?>,<br><br></p>
         <!-- Formulaire pour les posts -->
         <form action="" method="post" enctype="multipart/form-data" id="form_posts_pc">
            <textarea  name="texte_posts" required  id="texte_posts" placeholder="De quoi souhaitez-vous discuter ?" rows="14" style="width:100%;padding: 10px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;margin-bottom:25px;resize:none;"></textarea>
            <div style="display:flex;justify-content:right;">
               <p style="overflow:hidden; border: 1px dotted gray;border-radius:5px; position:relative; width:150px;height:150px;display:flex; align-items:center;justify-content:center;background-image:url('imgindex/visualisez_limage_ici.png');background-repeat: no-repeat;" id="image_wrapper">
                  <span id="fermerphoto" style="cursor:pointer;position: absolute; display:flex; align-items:center;justify-content:center; top:5px; right:5px;padding:2px;width:29px;height:29px;border-radius:50%;background-color:rgba(105, 105, 105, 0.7);color:#fff;">X</span>
               </p>
            </div>
            <div style="text-align:center;">
               <input type="submit" value="Poster" id="button" name="submit_posts" style="position:absolute;bottom:5vh;right:15px;background-color:beige;width:100px">
            </div> 
         </form>
         <div>
            <label>
               <input type="file" style="display:none;"  name="piece_jointe_posts" id="piece_join_posts" accept=".jpg, .png, .gif, .jpeg">
               <p style="text-align:left;">
                  <i class="fa fa-picture-o" aria-hidden="true" style="cursor:pointer;position:absolute;bottom:13vh;left:15px;font-size: 2rem;"></i>
                  <hr style="position:absolute;bottom:12vh;left:15px;width:95%; border: 1px dotted rgba(105, 105, 105, 0.3);">
               </p>
            </label>
         </div>
         <!-- Fin du Formulaire pour les posts -->
         <span class="fenetre_fermeture"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>




   <!-- fenêtre ouvrante pour redaction des posts pour phone viewer ****************************************** -->
   <div class="fenetre_redaction_posts2">
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
         <span class="fenetre_fermeture3"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>



      
   <!-- Main page ***************************************************************************************** -->
      <div class="wraper" style="position: relative;">
         <!--  SIDE LAYER GAUCHE -->
         <?php include('sidelayer.php') ?>
         <!--  SIDE LAYER MILIEU -->
         <div class="container">
            <?php include('ing_journal.php') ?>
         </div>
         <!--  SIDE LAYER DROITE -->
         <?php include('sidelayer_lacommunaute.php') ?>
      </div>


   <!-- Le footer for both desk & phone viewers ************************************************************ -->
      <footer id="footer_index">
         <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
      </footer>

      <div id="footer_post">
      <div  id="plus_posts" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-plus" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Post</span></div>
         <!-- <p><i class="fa-solid fa-plus" style="font-size: 1.5rem;" id="plus_posts"></i></p> -->
         <div style="height:100%;width:20%;padding:0px;border-top:2px solid black;position: absolute; right : 80%;display:flex;align-items:center;justify-content:center;">
            <a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-house-chimney" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Acceuil</span></div></a>
         </div>
         <div style="height:100%;width:20%;padding:0px;position: absolute; right : 60%;display:flex;align-items:center;justify-content:center;">
            <a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;">
               <div id="icone_reseau_phone" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;">
                  <?PHP  
                     if ($compteur_notifications_relations != 0){
                  ?>
                     <div id="notification_relations_phone" style="position:absolute;top:10%;right:20%;width:17px;height:17px;display:flex;align-items:center;justify-content:center;background-color:red;border-radius:50%;">
                        <p style="color: #fff; font-size:0.8rem; text-align:center;">
                           <?PHP echo $compteur_notifications_relations; ?>
                        </p>
                     </div>
                  <?PHP 
                     }
                  ?>
                  <i class="fa-solid fa-user-group" style="font-size: 1rem;"></i>
                  <span style="font-size: 0.7rem;">Mon réseau</span>
               </div>
            </a>
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
      <script src="js/script_entreprises_down.js"></script>
      <?PHP include('controls/creation_scripts_js_textarea_boutton_commentaires.php'); ?>
      <?PHP include('controls/creation_scripts_js_asychrone_traitement_commentaires.php'); ?>
      <?PHP include('controls/creation_scripts_js_asychrone_traitement_jaime.php'); ?>
      <?PHP include('controls/creation_scripts_js_supprimer_notifications_messages.php'); ?>
      <?PHP include('controls/creation_scripts_js_supprimer_notifications_relations.php'); ?>
      <script src="js/script_footer_scroll_hidden.js"></script>
      <script src="js/script_header_scroll_hidden.js"></script>
      <script src="js/script_resize_image_posts_phone.js"></script>
      <script src="js/script_resize_image_posts.js"></script>
      <script src="js/script_barre_lateral.js"></script>
      <script src="js/script_barre_recherche.js"></script>
      <script src="js/script_supprimer_post.js"></script>
      <script src="https://unpkg.com/@webcreate/infinite-ajax-scroll@^3/dist/infinite-ajax-scroll.min.js"></script>
      <script>
         let ias = new InfiniteAjaxScroll('.fil_posts', {
         item: '.post_style',
         next: '.suivant',
         pagination: '#pagination',
         spinner: document.getElementById('spinner1'),
         });
      </script>


      
</body>
</html>
<?PHP 
}
else
{
   header('Location: index.php');
}
?>