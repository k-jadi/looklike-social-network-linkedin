<?PHP
session_start();
if(isset($_SESSION['connexion']))
{
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="imgindex/favicon.png" type="image/png" />
        <link rel="stylesheet" href="css/style_profil.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/script.js" async></script>
        <title>Ing</title>
    </head>
    <body>
    <?php include("header_connexion.php"); ?>
    <div class="cr_container">
            <p>Merci <?PHP echo $_SESSION['interlocuteur'].' de  '.$_SESSION['prenom'] ; ?> pour votre inscription<br><br>Une confirmation de l'inscription vous sera envoyé par Email !<br><br>Retour à la page d'acceuil dans 5s ...</p>
    </div>

    <footer style="position: fixed; bottom:0px;">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>
    <?php
        session_destroy();
        header('refresh:5;URL=index.php');
    ?>
    </body>
    </html>
    <?PHP
}
else
{
    header('Location: inscription.php');
}
?>