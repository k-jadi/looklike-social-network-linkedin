<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['id_destinataire_relations']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $supprimer_notifications_relations = $bdd->prepare('DELETE FROM notifications_relations WHERE id_destinataire_relations=?');

    $supprimer_notifications_relations->execute(array($_GET['id_destinataire_relations']));
    

}
else
{
   header('Location:../index.php');
}
?>