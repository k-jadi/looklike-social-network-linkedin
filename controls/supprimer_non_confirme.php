<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['id'], $_GET['idnonconfirme']) AND $_GET['id'] == $_SESSION['id'] AND $_SESSION['id'] == 23)
{

    $non_confirmes = $bdd->prepare('DELETE FROM coordonnees_membres WHERE confirmation = 0 AND id = ? ');
    $non_confirmes->execute(array($_GET['idnonconfirme']));
    header('location:../membres_gestion.php?id='.$_SESSION['id']);

}
else
{
   header('Location:../index.php');
}
?>