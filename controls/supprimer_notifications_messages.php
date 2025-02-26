<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['id_destinataire']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $supprimer_notifications_messages = $bdd->prepare('DELETE FROM notifications_messages_entete WHERE id_destinataire_notification=?');

    $supprimer_notifications_messages->execute(array($_GET['id_destinataire']));
    

}
else
{
   header('Location:../index.php');
}
?>