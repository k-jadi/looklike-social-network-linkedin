<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

include('controls/membres_enligne.php');

$inscrits = $bdd->query('SELECT * FROM coordonnees_membres');
$nombre_inscrits = $inscrits->rowCount();

if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();
   $user_email = $user_info['email'];

   if (isset($_POST['submit_offre_emploi'])) {
      if (!empty($_POST['titre_annonce_emploi'] AND !empty($_POST['texte_annonce_emploi']))) 
      {
         if (isset($_FILES['piece_jointe_offre_emploi']) AND !empty($_FILES['piece_jointe_offre_emploi']['name']))
         {
            $taillemax = 10485760;
            $extenionsvalides = array('pdf');
            if ($_FILES['piece_jointe_offre_emploi']['size'] <= $taillemax)
            {
               $extenionupload = strtolower(substr(strrchr($_FILES['piece_jointe_offre_emploi']['name'],'.'),1));
               if(in_array($extenionupload,$extenionsvalides))
               {
                  $chemin = "membres/annonces/".$_FILES['piece_jointe_offre_emploi']['name'];
                  $resultat = move_uploaded_file($_FILES['piece_jointe_offre_emploi']['tmp_name'],$chemin);
                  if($resultat)
                  {
                     $titre_annonce_emploi = htmlspecialchars($_POST['titre_annonce_emploi']);
                     $texte_annonce_emploi = htmlspecialchars($_POST['texte_annonce_emploi']);
                     $stock_annonce = $bdd->prepare('INSERT INTO annonces_emploi(id_annonceur,titre_annonce,texte_annonce,nom_pj,date_time_offre) VALUES(?,?,?,?,NOW())');
                     $stock_annonce->execute(array($_SESSION['id'],$titre_annonce_emploi,$texte_annonce_emploi,$_FILES['piece_jointe_offre_emploi']['name']));
                     // Envoi email à l'annonceur
                     $header="From: Ingénieurs du Maroc <admin@ingenieursdumaroc.com>";
                     $message1 = 'Bonjour '.$user_info['prenom'].' | Votre annonce est bien reçue | Une alerte de mise en ligne sera envoyée aux membres | Merci pour votre collaboration | Admin.';
                     mail($user_email, "Vous avez annoncez une offre d'emploi", $message1, $header);
                     // Fin Envoi email à l'annonceur
                     header("Location:emploi.php?id=".$_SESSION['id']);
                  }   
               }
            }
         }
         else
         {
            $titre_annonce_emploi = htmlspecialchars($_POST['titre_annonce_emploi']);
            $texte_annonce_emploi = htmlspecialchars($_POST['texte_annonce_emploi']);
            $stock_annonce = $bdd->prepare('INSERT INTO annonces_emploi(id_annonceur,titre_annonce,texte_annonce,date_time_offre) VALUES(?,?,?,NOW())');
            $stock_annonce->execute(array($_SESSION['id'],$titre_annonce_emploi,$texte_annonce_emploi));
            // Envoi email à l'annonceur
            $header="From: Ingénieurs du Maroc <admin@ingenieursdumaroc.com>";
            $message1 = 'Bonjour '.$user_info['prenom'].' | Votre annonce est bien reçue | Une alerte de mise en ligne sera envoyée aux membres | Merci pour votre collaboration | Admin.';
            mail($user_email, "Vous avez annoncez une offre d'emploi", $message1, $header);
            // Fin Envoi email à l'annonceur
            header("Location:emploi.php?id=".$_SESSION['id']);
         }          

      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Ing.</title>
</head>
<body>
<!-- Header ********************************************************************************************* -->

   <!-- Menu + profil caché à gauche à utiliser sur le phone viewer -->
   <div class="barre_lateral" id="barre_lateral">
      <?PHP include('slidelayer_phone.php'); ?>
   </div>

   <!-- Partie Header both desk & phone viewers -->
   <header id="header_hidden">
      <h1>Ing.</h1>
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
      <ul id="header_emploi">
         <li style="display:flex;align-items:center;justify-content:center;"><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-house"></i><span>Acceuil</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-user-group"></i><span>Réseau</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase" style="color: rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);">Emploi</span></div></a></li>
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
      <div class="loading_edition_white" style="border-bottom: 1px dotted rgba(105, 105, 105, 0.2);">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div> 
   </header>




<!-- Barre horizontale de séparation vide fixe ********************************************** -->
   <div class="barreVide"></div>




   <!-- fenêtre ouvrante pour redaction des posts pour portable -->
   <div class="fenetre_redaction_posts4">
      <div class="sous_fenetre_redaction_posts">
         <p>Bonjour <?PHP echo $user_info['prenom'] ?>,<br><br></p>
         <!-- Formulaire pour les posts phone -->
         <form action="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" method="post" enctype="multipart/form-data" id="form_posts_pc2">
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
         <span class="fenetre_fermeture5"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>

   <!-- fenêtre ouvrante pour redaction de l offre d emploi -->
   <div class="fenetre_redaction_off_emploi">
      <div class="sous_fenetre_redaction_off_emploi">
         <p>Bonjour <?PHP echo $user_info['prenom'] ?>,<br> Merci de rédiger une annonce d'emploi :<br><br></p>
			<form action="" method="post" enctype="multipart/form-data">

            <label for="titre_annonce_emploi" style="background-color:beige;padding:5px;border-radius:5px">Titre de l'annonce :</label>
            <input type="text"  name="titre_annonce_emploi" required id="titre_annonce_emploi" size="98" style="padding: 5px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px"><br><br>

            <label for="texte_annonce_emploi" style="background-color:beige;padding:5px;border-radius:5px;margin-bottom:5px;">Texte de l'annonce :</label><br>
            <textarea  name="texte_annonce_emploi" required  id="texte_annonce_emploi" rows="14" style="padding: 10px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;margin-bottom:25px"></textarea><br>

            <div id="erreure_area">
               <div>
                  <label for="piece_jointe_offre_emploi" style="background-color:beige;padding:5px;border-radius:5px;margin-right:10px"> PJ (PDF, Max 10Mo) : </label>
                  <input type="file" name="piece_jointe_offre_emploi" id="piece_jointe_offre_emploi" accept=".pdf" oninput="pjmessage()">
               </div>
               <div>
                  <p style="font-size:0.9rem; color:orangered;" id="texte_erreure_pj"></p>
               </div>
            </div>

            <div style="text-align:center;">
               <input type="submit" value="Publier" id="button" name="submit_offre_emploi" style="background-color:beige;width:150px">
            </div>

			</form>
         <span class="fenetre_fermeture"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>

   <!-- fenêtre ouvrante pour l'affichage de la cvtheque -->
   <div class="fenetre_redaction_off_emploi2">
      <div class="sous_fenetre_redaction_off_emploi2">
      <p style="text-align:center;padding:10px;background-color:orangered;color:white;border-radius:10px; margin-bottom:10px; width:90%">
         <?PHP 
            $nbre_inscrit_cv = $bdd->query('SELECT * FROM coordonnees_membres WHERE cv!=""');
            $count_nbre_cv = $nbre_inscrit_cv->rowCount();
         ?>
         Nombre de CV dans la base :  <?PHP echo $count_nbre_cv;  ?><br>
         La CVTHEQUE sera active quand le nombre de CV dépassera le chiffre 100
      </p>
      <?PHP
         if ($user_info['cv'] == ""){?>
            <p style="text-align:center;padding:10px;background-color:orangered;color:white;border-radius:10px;width:90%">
            Bonjour <?PHP echo $user_info['prenom'] ?>, Apparemment, vous n'avez pas uploader votre CV  :<br>
            Nous vous invitons à le faire sur la page : <a style="color:white;" href="edition_profil.php?id=<?PHP echo $_SESSION['id']; ?>">edition_profil</a>
            </p>
         <?PHP
         }
      ?>
         <span class="fenetre_fermeture3"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>

   <!-- NEW WRAPPER ************************************************************ -->
   <div class="basDePage">
      <p>"Espace Emploi"</p>
      <p>Déposer votre offre d'emploi / Trouver votre futur Job ... </p>
   </div>

   <!-- NEW WRAPPER ************************************************************ -->
   <div class="section_boutton_offre_emploi">
      <div class="demi_section_boutton_offre_emploi">
         <p class="bouttons_offre_emploi" id="redaction_off_emploi">Rédiger une annonce</p>
      </div>
      <div class="demi_section_boutton_offre_emploi">
         <p class="bouttons_offre_emploi" id="affichage_cvtheque">Consulter la CVThèque</p>
      </div>
   </div>

   <!-- NEW WRAPPER : Affichage des annonces d emploi ************************************************************ -->
   <div class="annonces_emploi">
      <?PHP  
         $annonce_affichage = $bdd->query('SELECT * FROM annonces_emploi ORDER BY date_time_offre DESC');
         while ($liste_annonces = $annonce_affichage->fetch()) {
         $annonce_auteur = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id = ?');
         $annonce_auteur->execute(array($liste_annonces['id_annonceur']));
         $lauteur = $annonce_auteur->fetch();
         ?>
         <div style="position:relative; width:100%">
            <?PHP 
               if($lauteur['id'] == $_SESSION['id']){
            ?>
               <div onclick="supprimer_annonce(<?PHP echo $liste_annonces['id']; ?>)" style="z-index:1005;cursor:pointer;display:flex;align-items:center;justify-content:center;position: absolute;top:3px;right:5px;width:fit-content;height:25px;padding:0px 5px;background-color:rgba(105, 105, 105, 0.1);border-radius:5px;font-size:0.7rem;">
               <i class="fa-solid fa-trash"></i>
               </div>
            <?PHP
               }
            ?>
            
            <p class="annonce_publiee_titre" style="width:100%; text-align:left;font-size:0.9rem;color:orangered;font-weight:bolder;margin-bottom:10px;">
               <?PHP
                  echo $liste_annonces['titre_annonce'];
               ?>
            </p>
            <div style="display:flex; flex-direction:row; height:65px;border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:10px;"> 
               <?PHP 
                  $annonce_auteur = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id = ?');
                  $annonce_auteur->execute(array($liste_annonces['id_annonceur']));
                  $auteur = $annonce_auteur->fetch();

                  $auteur_prenom = $auteur['prenom'];
                  $auteur_nom = $auteur['nom'];
                  $auteur_ecole = $auteur['ecole'];
                  $annonce_time = $liste_annonces['date_time_offre'];
                  $annonce_photo = $auteur['avatar'];
               ?>
               <div class="essayer" style="display:flex;  align-items:center;  justify-content:center;margin:0px 10px;">
                  <img src="membres/avatar/<?PHP echo $auteur['avatar'] ?>" alt="photo de profil" width=47px height="47px" style="border-radius:50%">
               </div>
               <div style="width: 87%;  padding: 5px 0px;  display:flex;  align-items:center;  justify-content:center;">
                  <p  style="width:100%; text-align:left; font-size:0.7rem;color:gray;">
                     Annonce publiée par : 
                     <?PHP
                        echo $auteur['prenom'].' '.$auteur['nom'].', Ingénieur '.$auteur['ecole']; 
                     ?>
                     <br>
                     Date de puclication :
                     <?PHP
                        echo $liste_annonces['date_time_offre'];
                     ?>
                  </p>
               </div>
            </div>
            <p class="annonce_publiee_texte" style="width:100%; text-align:left;font-size:0.9rem;margin-top:15px">
               <?PHP
                  echo nl2br($liste_annonces['texte_annonce']);
               ?>
            </p>
            <p  style="width:100%; text-align:left;font-size:0.9rem;margin-top:15px">
               <span style="color: orangered;">PJ :</span> 
               <?PHP 
                  if (!empty($liste_annonces['nom_pj'])){ ?>
                     <a href="membres/annonces/<?PHP echo $liste_annonces['nom_pj']; ?>" target="_blank"><?PHP echo $liste_annonces['nom_pj']; ?></a>

                  <?PHP 
                  }else {
                     ?>
                     Aucune pièce jointe
                  <?PHP
                  }
               ?>
            </p>
            <hr style="width:100%;margin:30px 0px;height:3px;">
         </div>
         <?PHP
         }
         ?>
   </div>

   <!-- NEW WRAPPER ************************************************************ -->
   <footer id="footer_index">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>
   
   <div id="footer_post">
      <div  id="plus_posts_emploi" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-plus" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Post</span></div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 80%;display:flex;align-items:center;justify-content:center;">
         <a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-house-chimney" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Acceuil</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 60%;display:flex;align-items:center;justify-content:center;">
            <a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-user-group" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Mon réseau</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;border-top:2px solid black;position: absolute; right : 20%;display:flex;align-items:center;justify-content:center;">
         <a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-briefcase" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Emploi</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 0%;display:flex;align-items:center;justify-content:center;">
         <a href="deconnexion.php" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-right-from-bracket" style="font-size:1rem;"></i><span style="font-size: 0.7rem;">Quitter</span></div></a>
      </div>
   </div>
   
<!-- Les scripts JS ************************************************************************************ -->
   <script src="js/script_menu_deroulant.js"></script>
   <script src="js/script_emploi.js"></script>
   <script src="js/script_post_emploi.js"></script>
   <script src="js/script_footer_scroll_hidden.js"></script>
   <script src="js/script_header_scroll_hidden.js"></script>
   <script src="js/script_emploi_taille_pj.js"></script>
   <script src="js/script_resize_image_posts_phone.js"></script>
   <script src="js/script_barre_lateral.js"></script>
   <script>
      function supprimer_annonce(idannonce)
      {
         if ( confirm('Supprimer mon annonce ?'))
         {
            document.location.href="controls/supprimer_annonce.php?idannonce="+idannonce+"&id=<?PHP echo $_SESSION['id'];  ?>";
         }  
      }
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
