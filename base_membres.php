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
?>

<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Ing.</title>
</head>
<body>
   <!-- Header ******************************************************* -->
   <header>
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
      <span id="menuText"><?PHP echo '  '.$_SESSION['prenom']. ' '; ?></span>
   </div>
   <ul>
      <li><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>">Acceuil</a></li>
      <li><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>">Bibliothèque</a></li>
      <li><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>">PFE</a></li>
      <li><a href="entrepreneurs.php?id=<?PHP echo $_SESSION['id']; ?>">Entrepreneurs</a></li>
      <li><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>">Emploi</a></li>
      <li><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>">Centrale-Achats</a></li>
      <li><a href="deconnexion.php">Déconnexion</a></li>
   </ul>
   <div id="menu_open" class="initial">
      <svg width="30" height="30">
         <path d="M0,5 30,5" stroke="#fff" stroke-width="3"/>
         <path d="M0,14 30,14" stroke="#fff" stroke-width="3"/>
         <path d="M0,23 30,23" stroke="#fff" stroke-width="3"/>
      </svg>
   </div>
</header>

<div class="barreVide"></div>

<ul id="menu_deroulant">
      <li><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"  class="highlight"><span style="font-size:1.1rem;">&#x1F3E0;</span> Acceuil</a></li>
      <li><a href="edition_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x2192;</span> Editer mon profil</a></li>
      <li><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F4DA;</span> Ma bibliothèque</a></li>
      <li><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F4D4;</span> Mon receuil des PFE</a></li>
      <li><a href="entrepreneurs.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F477;</span> Mes amis entrepreneurs</a></li>
      <li><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F4BC;</span> Emploi</a></li>
      <li><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F9FA; </span> Ma centrale-achats</a></li>
      <li><span style="color:gray"><span style="font-size:1.1rem;">&#x1F465;</span> Membres :</span></li>
      <li><span style="color:gray;">&nbsp . Nombre d'inscrits : <?php echo $nombre_inscrits; ?></span></li>
      <li><span style="color:gray;">&nbsp . Membres en ligne : <?php echo $membres_enligne; ?></span></li>
      <?PHP if ($_SESSION['id'] == 23){
         $membres_preinscrits = $bdd->query('SELECT * FROM coordonnees_membres WHERE confirmation=0');
         $membres_enattente = $membres_preinscrits->rowCount();
         ?>
         <li><span style="color:gray;">&nbsp . Membres en attente : <a href="membres_gestion.php?id=<?PHP echo $_SESSION['id']; ?>"><?php echo $membres_enattente; ?></a></span></li>
      <?PHP
      }
      ?>
      <li><span style="color:gray;">&nbsp . Espace membres (en cours)</span></li>
      <li><a href="deconnexion.php">Déconnexion</a></li>
</ul>

   
   <!-- Main page ******************************************************* -->
   <div class="wraper">
      <div class="container">
         <?php include('controls/liste_membres.php') ?>
      </div>

      <!--  SIDE LAYER ************************************************************** -->
      <?php include('sidelayer.php') ?>
   </div>     

   <!-- NEW WRAPPER ************************************************************ -->
   <footer>
      <p>Ing. 2023 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

</body>
</html>
<?PHP 
}
else
{
   header('Location: index.php');
}
?>