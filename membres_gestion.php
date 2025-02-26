<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>membres_gestion</title>
</head>

<body>
<p style="font-size: 2rem;">
<?PHP
if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] AND $_SESSION['id'] == 23)
{
    ?> <a href="index_profil.php?id=<?PHP echo  $_SESSION['id']; ?>">Acceuil</a><br><br><br> <?PHP
    $non_confirmes = $bdd->query('SELECT * FROM coordonnees_membres WHERE confirmation = 0');
    while($liste_non_confirmes = $non_confirmes->fetch()){
        $id_non_confirme = $liste_non_confirmes['id'];
        $prenom_non_confirme = $liste_non_confirmes['prenom'];
        $email_non_confirme = $liste_non_confirmes['email'];
        echo $liste_non_confirmes['prenom'].' '.$liste_non_confirmes['nom'].'<br><br>';
        ?>
        <a href="controls/supprimer_non_confirme.php?idnonconfirme=<?PHP echo $id_non_confirme;  ?>&id=<?PHP echo $_SESSION['id'] ?>">Supprimer</a><br><br>
        <a href="controls/confirmer_non_confirme.php?idnonconfirme=<?PHP echo $id_non_confirme;  ?>&emailnonconfirme=<?PHP echo $email_non_confirme;  ?>&prenomnonconfirme=<?PHP echo $prenom_non_confirme;  ?>&id=<?PHP echo $_SESSION['id'] ?>">Confirmer</a><br><br><br><br>
        <?PHP
    };
?>
</p>
<?PHP
}
else
{
   header('Location: index.php');
}
?>

</body>
</html>
