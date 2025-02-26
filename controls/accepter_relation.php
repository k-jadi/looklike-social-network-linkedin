<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_POST['accepter_relation']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $accepter_relation = $bdd->prepare('UPDATE gestion_relations SET statut_demande = 0 WHERE user_demandeur = :user_demandeur AND user_receveur = :user_receveur ');

    $accepter_relation->execute([
        'user_demandeur' => $_SESSION['id'],
        'user_receveur' => $_GET['id_relation']
    ]);
    
    $accepter_relation->execute([
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