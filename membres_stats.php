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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <?PHP include('controls/inscrits_barres.php'); ?>
   <title>Ing.</title>
</head>
<body>

<!-- Header ******************************************************************************************** -->

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
      <ul>
         <li><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" >Acceuil</a></li>
         <li><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>">Bibliothèque</a></li>
         <li><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>">PFE</a></li>
         <li><a href="entrepreneurs.php?id=<?PHP echo $_SESSION['id']; ?>">Entrepreneurs</a></li>
         <li><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>">Emploi</a></li>
         <li><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>">Centrale-Achats</a></li>
         <li><a href="deconnexion.php"><i class="fa-solid fa-right-from-bracket" style="color:rgb(123, 226, 64);font-size:1.5rem;"></i></a></li>
      </ul>
      <div class="loading_edition_white" style="border-bottom: 1px dotted rgba(105, 105, 105, 0.2);">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div> 
      </div>
   </header>



<!-- Barre horizontale de séparation vide fixe ********************************************** -->
   <div class="barreVide"></div>



<!-- fenêtre ouvrante pour redaction des posts pour portable -->
   <div class="fenetre_redaction_posts3">
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
         <span class="fenetre_fermeture4"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>


<!-- NEW WRAPPER : Membres Inscrits Stats Par école ************************************************************ -->
    <h3 class="titre1 titre2">Nombre d'inscrits : <?php echo $nombre_inscrits; ?></h3>
    <div class="container_inscrits_barres">
        <?PHP 
            $liste_ecoles = ["EMI", "ENSIAS", "ENIM", "EHTP", "INSEA", "ENSEM", "INPT", "IAV", "ESITH", "ERN", "AIAC"];
            for($i=0; $i<11; $i++){
                $membres_par_ecole = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE ecole=? ');
                $membres_par_ecole->execute(array($liste_ecoles[$i]));
                $nombre_membres_par_ecole = $membres_par_ecole->rowCount();
                echo '
                    <div class="skill-box">
                        <span class="title">'.$liste_ecoles[$i].'</span>
                        <div class="skill-bar">
                            <span class="skill-per '.$liste_ecoles[$i].'">
                                <span class="tooltip">'.$nombre_membres_par_ecole.'</span>
                            </span>
                        </div>
                    </div>
                ';
            }
        ?>
    </div>
    <br><br><br><br><br>

<!-- Le footer ************************************************************ -->
   <div id="footer_post">
      <p><i class="fa-solid fa-plus" style="font-size: 1.5rem;" id="plus_posts_m"></i></p>
      <p style="height:100%;width:20%;padding:0px 15px;position: absolute; right : 80%;display:flex;align-items:center;justify-content:center;">
         <a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><i class="fa-solid fa-house-chimney" style="font-size: 1.3rem;"></i></a>
      </p>
      <p style="height:100%;width:20%;padding:0px 15px;position: absolute; right : 60%;display:flex;align-items:center;justify-content:center;">
         <a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><i class="fa-solid fa-briefcase" style="font-size: 1.3rem;"></i></a>
      </p>
      <p style="height:100%;width:20%;padding:0px 15px;border-top:2px solid black;position: absolute; right : 20%;display:flex;align-items:center;justify-content:center;">
            <a href="membres_stats.php?id=<?PHP echo $_SESSION['id']; ?>"><i class="fa-sharp fa-solid fa-users" style="font-size: 1.3rem;"></i></a>
      </p>
      <p style="height:100%;width:20%;padding:0px 15px;position: absolute; right : 0%;display:flex;align-items:center;justify-content:center;">
         <a href="deconnexion.php"><i class="fa-solid fa-right-from-bracket" style="font-size:1.3rem;"></i></a>
      </p>
   </div>
   
   
<!-- Les scripts JS ************************************************************************************ -->
   <script src="js/script_menu_deroulant.js"></script>
   <script src="js/script_post_stats_members.js"></script>
   <script src="js/script_footer_scroll_hidden.js"></script>
   <script src="js/script_header_scroll_hidden.js"></script>
   <script src="js/script_resize_image_posts_phone.js"></script>
   <script src="js/script_barre_lateral.js"></script>

</body>
</html>

<?PHP
}
else
{
   header('Location: index.php');
}
?>
