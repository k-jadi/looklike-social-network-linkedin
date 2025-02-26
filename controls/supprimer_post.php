<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['idpost']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $supprimer_post = $bdd->prepare('DELETE FROM posts WHERE id=?');

    $supprimer_post->execute(array($_GET['idpost']));
    
    header('location:../index_profil.php?id='.$_SESSION['id']);

}
else
{
   header('Location:../index.php');
}
?>