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

   if (isset($_POST['envoi_fiche_recruteur']))
         {
            if (!empty($_POST['fiche_recruteur']))
            {
               $fiche_recruteur = htmlspecialchars($_POST['fiche_recruteur']);
               $insererfiche_recruteur = $bdd->prepare('UPDATE coordonnees_membres SET informations_recruteur = ? WHERE id = ?');
               $insererfiche_recruteur->execute(array($fiche_recruteur,$_SESSION['id']));
               $message_fiche_recruteur = 'Vos informations ont été mises à jour !';
               header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
            }
            
         }
   
   if (isset($_POST['competences']))
         {
            if (!empty($_POST['texte_competences']))
            {
               $competences = htmlspecialchars($_POST['texte_competences']);
               $inserercompetences = $bdd->prepare('UPDATE coordonnees_membres SET competences = ? WHERE id = ?');
               $inserercompetences->execute(array($competences,$_SESSION['id']));
               $message12 = 'Vos compétences ont été mis à jour !';
               header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
            }
            
         }
   
   if (isset($_POST['texte_mes_experiences_pro']))
         {
            if (!empty($_POST['texte_mes_experiences_pro']))
            {
               $mes_experiences = htmlspecialchars($_POST['texte_mes_experiences_pro']);
               $inserermesexperiences = $bdd->prepare('UPDATE coordonnees_membres SET mes_experiences = ? WHERE id = ?');
               $inserermesexperiences->execute(array($mes_experiences,$_SESSION['id']));
               $message_experiences_pro = 'Vos expériences PRO ont été mis à jour !';
               header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
            }
            
         }
   
   if (isset($_POST['texte_mes_realisations_pro']))
         {
            if (!empty($_POST['texte_mes_realisations_pro']))
            {
               $mes_realisations = htmlspecialchars($_POST['texte_mes_realisations_pro']);
               $inserermesrealisations = $bdd->prepare('UPDATE coordonnees_membres SET mes_realisations = ? WHERE id = ?');
               $inserermesrealisations->execute(array($mes_realisations,$_SESSION['id']));
               $message_realisations_pro = 'Vos réalisations PRO ont été mis à jour !';
               header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
            }
            
         }
   
   if (isset($_POST['edition_submit']))
      {
         $edition_email = htmlspecialchars($_POST['edition_email']);
         if(!empty($_POST['edition_email']) )
            {
               if (filter_var($edition_email,FILTER_VALIDATE_EMAIL))
               {
                  $reqemail = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE email = ?');
                  $reqemail->execute(array($edition_email));
                  $email_exist = $reqemail->rowCount();
                  if($email_exist == 0)
                  {
                     $email_update = $bdd->prepare('UPDATE coordonnees_membres SET email = :nvemail WHERE id = :get_id');
                     $email_update->execute(array(
                        'nvemail' => $edition_email,
                        'get_id' => $get_id
                     ));
                     $message = 'Votre adresse email est éditée !';
                     header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
                  }
                  else
                  {
                     $message  = 'Erreure : Email déjà existant';
                  }
               }
               else
               {
                  $message = 'Erreure : Votre adresse Email n\'est pas valide ! ';
               }
            }
            else
            {
               $message = 'Erreure : Veuillez entrer une adresse email !';
            }
      }
   if (isset($_POST['submit_motdepasse']))
      {
         $edition_motdepasse = htmlspecialchars($_POST['edition_motdepasse']);
         $edition_motdepasse_chifre = sha1($_POST['edition_motdepasse']);
         if(!empty($_POST['edition_motdepasse']) )
            {
                     $motdepasse_update = $bdd->prepare('UPDATE coordonnees_membres SET mdp = :nvmdp, motdepass = :nvmotdepasse WHERE id = :get_id');
                     $motdepasse_update->execute(array(
                        'nvmdp' => $edition_motdepasse,
                        'nvmotdepasse' => $edition_motdepasse_chifre,
                        'get_id' => $get_id
                     ));
                     $message2 = 'Votre nouveau mot de passe est :'.$edition_motdepasse;
                     header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
            }
            else
            {
               $message2 = 'Erreure : Veuillez entrer un mot de passe !';
            }
      }
      if (isset($_FILES['edition_profil_photo']) AND !empty($_FILES['edition_profil_photo']['name']))
         {
            $taillemax = 2097152;
            $extenionsvalides = array('jpg','jpeg','gif','png');
            if ($_FILES['edition_profil_photo']['size'] <= $taillemax)
               {
                  $extenionupload = strtolower(substr(strrchr($_FILES['edition_profil_photo']['name'],'.'),1));
                  if(in_array($extenionupload,$extenionsvalides))
                     {
                        $chemin = "membres/avatar/".$_SESSION['id'].".".$extenionupload;
                        $resultat = move_uploaded_file($_FILES['edition_profil_photo']['tmp_name'],$chemin);
                        if($resultat)
                           {
                              $updateavatar = $bdd->prepare('UPDATE coordonnees_membres SET avatar = :avatar WHERE id= :id');
                              $updateavatar->execute(array(
                                 'avatar' => $_SESSION['id'].".".$extenionupload,
                                 'id' => $_SESSION['id']
                              ));
                              $message3 = "Votre photo de profil a bien été téléchargée !";
                              header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
                           }
                           else
                           {
                              $message3 = "erreure lors de l'importation de votre photo !";
                           }
                     }
                     else
                     {
                        $message3 = "Votre photo doit être au format jpg, jpeg, gif ou png !";
                     }
               }
               else
               {
                  $message3 ="Votre photo ne doit pas dépasser 2Mo";
               }
         }
      if (isset($_FILES['edition_profil_cv']) AND !empty($_FILES['edition_profil_cv']['name']))
         {
            $taillemax2 = 10485760;
            $extenionsvalides2 = array('pdf');
            if ($_FILES['edition_profil_cv']['size'] <= $taillemax2)
               {
                  $extenionupload2 = strtolower(substr(strrchr($_FILES['edition_profil_cv']['name'],'.'),1));
                  if(in_array($extenionupload2,$extenionsvalides2))
                     {
                        $chemin2 = "membres/cv/".$_SESSION['id'].".".$extenionupload2;
                        $resultat2 = move_uploaded_file($_FILES['edition_profil_cv']['tmp_name'],$chemin2);
                        if($resultat2)
                           {
                              $updatecv = $bdd->prepare('UPDATE coordonnees_membres SET cv = :cv WHERE id= :id');
                              $updatecv->execute(array(
                                 'cv' => $_SESSION['id'].".".$extenionupload2,
                                 'id' => $_SESSION['id']
                              ));
                              $message4 = "Votre CV a bien été téléchargé !";
                              header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
                           }
                           else
                           {
                              $message4 = "erreure lors de l'importation de votre CV !";
                           }
                     }
                     else
                     {
                        $message4 = "Votre CV doit être au format PDF !";
                     }
               }
               else
               {
                  $message4 ="Votre CV ne doit pas dépasser 5Mo";
               }
         }
         if (isset($_POST['edition_submit_genie']))
         {
            $edition_genie = $_POST['edition_genie'];
            if(!empty($_POST['edition_genie']) )
               {
                        $genie_update = $bdd->prepare('UPDATE coordonnees_membres SET genie = :nvgenie WHERE id = :get_id');
                        $genie_update->execute(array(
                           'nvgenie' => $edition_genie,
                           'get_id' => $get_id
                        ));
                        $message6 = 'Votre génie est édité !';
                        header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
               }
               else
               {
                  $message6 = 'Erreure : Veuillez faire un choix !';
               }
         }
      
      if (isset($_FILES['edition_profil_pfe']) AND !empty($_FILES['edition_profil_pfe']['name']))
         {
            $taillemax3 = 41943040;
            $extenionsvalides3 = array('pdf');
            if ($_FILES['edition_profil_pfe']['size'] <= $taillemax3)
               {
                  $extenionupload3 = strtolower(substr(strrchr($_FILES['edition_profil_pfe']['name'],'.'),1));
                  if(in_array($extenionupload3,$extenionsvalides3))
                     {
                        $chemin3 = "membres/pfe/".$_SESSION['id'].".".$extenionupload3;
                        $resultat3 = move_uploaded_file($_FILES['edition_profil_pfe']['tmp_name'],$chemin3);
                        if($resultat3)
                           {
                              $updatepfe = $bdd->prepare('UPDATE coordonnees_membres SET pfe = :pfe WHERE id= :id');
                              $updatepfe->execute(array(
                                 'pfe' => $_SESSION['id'].".".$extenionupload3,
                                 'id' => $_SESSION['id']
                              ));
                              $message5 = "Votre PFE a bien été téléchargé !";
                              header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
                           }
                           else
                           {
                              $message5 = "erreure lors de l'importation de votre PFE !";
                           }
                     }
                     else
                     {
                        $message5 = "Votre PFE doit être au format PDF !";
                     }
               }
               else
               {
                  $message5 ="Votre PFE ne doit pas dépasser 20Mo";
               }
         }
      
         if (isset($_POST['edition_submit_phone']))
         {
            $edition_phone = htmlspecialchars($_POST['phone']);
            if(!empty($_POST['phone']) )
               {
                  if (preg_match("/^([0-9]{10})$/",$edition_phone) OR preg_match("/^([+,0-9]{14})$/",$edition_phone) OR preg_match("/^([+,0-9]{13})$/",$edition_phone) OR preg_match("/^([+,0-9]{12})$/",$edition_phone) OR preg_match("/^([+,0-9]{11})$/",$edition_phone))
                  {
                  $phone_update = $bdd->prepare('UPDATE coordonnees_membres SET phone = :nvphone WHERE id = :get_id');
                  $phone_update->execute(array(
                     'nvphone' => $edition_phone,
                     'get_id' => $get_id
                  ));
                  $message7 = 'Votre nouveau numéro de téléphone :'.$edition_phone;
                  header('refresh:2;URL=edition_profil.php?id='.$_SESSION['id']);
                  }
                  else
                  {
                     $message7 = 'Erreure : Ce numéro de téléphone n\'est pas valide !';
                  }
               }
               else
               {
                  $message7 = 'Erreure : Veuillez entrer un numéro de téléphone !';
               }
         }
?>

<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   
   <title>Ing.</title>
   <?PHP include('controls/inscrits_barres.php'); ?>
</head>
<body>

<!-- Header ****************************************************************************************** -->
   <div class="barre_lateral" id="barre_lateral">
      <?PHP include('slidelayer_phone_edition.php'); ?>
   </div>
   <header id="header_sans_barre_recherche">
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
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-store"></i><span>Ing Mall</span></div></a></li>
         <?PHP 
               }    
            ?>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="deconnexion.php"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-right-from-bracket"></i><span>Quitter</span></div></a></li>
   </ul>
   <div style="width: 85%;text-align:right;" id="biblio_10000">
        <span><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><img src="imgindex/fleche_retour.png" alt="bouton_retour" style="width: 28px;vertical-align:middle;"></a></span>
      </div>  
</header>

<div class="barreVide"></div>


   
   <!-- Main page ******************************************************* -->
   <div class="wraper">
      <?php include('sidelayer_edition.php') ?>
      <div class="container">
         <?php include('edition_profil_space.php') ?>
      </div>

      <!--  SIDE LAYER ************************************************************** -->
      <?php include('sidelayer_lacommunaute.php') ?>
   </div>     

   <!-- NEW WRAPPER ************************************************************ -->
   <footer id="footer_index">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

   <script src="js/script_barres_down.js"></script>
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