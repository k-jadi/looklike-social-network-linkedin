<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['idannonce']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $supprimer_annonce = $bdd->prepare('DELETE FROM annonces_emploi WHERE id=?');

    $supprimer_annonce->execute(array($_GET['idannonce']));
    
    header('location:../emploi.php?id='.$_SESSION['id']);

}
else
{
   header('Location:../index.php');
}
?>