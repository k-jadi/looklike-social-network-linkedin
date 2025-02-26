<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');


if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <title>Ing.</title>
</head>
<body>
   <!-- Header ************************************************ -->

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
         <li style="display:flex;align-items:center;justify-content:center;"><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase"></i><span>Emploi</span></div></a></li>
         <?PHP 
               if ($user_info['interlocuteur'] == ''){
         ?>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book"></i><span>Bibliothèque</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book-bookmark"></i><span>Pfe</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-store" style="color: rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);">Ing Mall</span></div></a></li>
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
   <div class="fenetre_redaction_posts6">
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
         <span class="fenetre_fermeture7"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>


<!-- NEW WRAPPER ************************************************************ -->
   <div class="ca_container" style="height: 55px;">
      <p>En développement / Logistique en cours ...</p>
   </div>
   
   <!-- NEW WRAPPER ************************************************************ -->
   <footer  style="position: fixed; bottom:0px;">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

   <div id="footer_post">
   <div  id="plus_posts_ca" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-plus" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Post</span></div>
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
   <script src="js/script_barre_lateral.js"></script>
   <script src="js/script_post_ca.js"></script>
   <script src="js/script_resize_image_posts_phone.js"></script>


</body>
</html>
<?PHP
}
else
{
   header('Location: index.php');
}
?>
