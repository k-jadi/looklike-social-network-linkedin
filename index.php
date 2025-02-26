<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=u282907555_kjadi_membres','u282907555_kjadi_membres','Maroc-2023@2024');

// Traitement du formulaire de connexion ********************************************************
if (isset($_POST['button_connect']))
{
   $email_connect = htmlspecialchars($_POST['email_connect']);
   $pass_word_connect = sha1($_POST['pass_word_connect']);
   if (!empty($email_connect) AND !empty($pass_word_connect))
   {
      $requser = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE email = ? AND motdepass = ?');
      $requser ->execute(array($email_connect, $pass_word_connect));
      $user_exist = $requser->rowCount();
      if($user_exist == 1)
      {
         $user_info = $requser->fetch();
         $_SESSION['id'] = $user_info['id'];
         $_SESSION['prenom'] = $user_info['prenom'];
         $_SESSION['nom'] = $user_info['nom'];
         $_SESSION['email'] = $user_info['email'];
         $_SESSION['ecole'] = $user_info['ecole'];
         $_SESSION['promotion'] = $user_info['promotion'];
         $_SESSION['confirmation'] = $user_info['confirmation'];
         if ($user_info['confirmation'] == 1)
         {
         header('Location:index_profil.php?id='.$_SESSION['id']);
         }
         else
         {
            $erreure ='Votre compte est en attente de confirmation';
         }
      }
      else
      {
         $erreure ='Email ou Mot de pass incorrect !';
      }
   }
   else
   {
      $erreure = 'Tous les champs doivent être complétés ';
   }
}
?>

<!-- Affichage du formulaire de connexion ******************************************************** -->
<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <script src="script.js" async></script>
   <title>Ing.</title>
</head>
<body>
   <!-- Header ******************************************************* -->
   <?php include("header_connexion.php"); ?>

   <!-- Barre Vide ******************************************************* -->
   <div class="barreVide_connexion"></div>

   <!-- Main page ******************************************************* -->
      <?php include('connexion_layer.php') ?>

   <!-- FOOTER ************************************************************ -->
   <footer style="position: fixed; bottom:0px;">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

</body>
</html>