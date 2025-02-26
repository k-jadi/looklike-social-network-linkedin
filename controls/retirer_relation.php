<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_POST['retirer_relation']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $retirer_relation = $bdd->prepare('DELETE FROM gestion_relations WHERE user_demandeur = :user_demandeur AND user_receveur = :user_receveur ');

    $retirer_relation->execute([
        'user_demandeur' => $_SESSION['id'],
        'user_receveur' => $_GET['id_relation']
    ]);
    
    $retirer_relation->execute([
        'user_demandeur' => $_GET['id_relation'],
        'user_receveur' => $_SESSION['id']
    ]);


    header('location:../mon_reseau.php?id='.$_SESSION['id']);

}
else
{
   header('Location:../index.php');
}
?>