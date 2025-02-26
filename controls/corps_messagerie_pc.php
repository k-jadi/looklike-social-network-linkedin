<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

// Création des variables utilisateur, inscrits et en ligne ***************************************
if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="15">
    <title></title>
</head>
<body>
<?PHP
    $mes_messages = $bdd->prepare('SELECT * FROM messagerie WHERE id_expediteur = ? OR id_destinataire = ? ORDER BY id DESC');
    $mes_messages->execute(array($_SESSION['id'],$_SESSION['id']));
    $compteur = $mes_messages->rowCount();
    $tableau_provisoire = array();
    if ($compteur !== 0) {
        while ($afficher_mes_messages = $mes_messages->fetch()) {
        ?>
            <?PHP
                if ($afficher_mes_messages['id_expediteur'] == $_SESSION['id']) {
                    $id_photo_affichee = $afficher_mes_messages['id_destinataire'];
                }
                else {
                    $id_photo_affichee = $afficher_mes_messages['id_expediteur'];
                }
                if(!in_array($id_photo_affichee,$tableau_provisoire)){
                    $photo_affichee = $bdd->prepare('SELECT id, prenom, nom, avatar FROM coordonnees_membres WHERE id=?');
                    $photo_affichee->execute(array($id_photo_affichee));
                    $photo_affichee_finale = $photo_affichee->fetch();
            ?>
                    <a href="fil_messagerie_pc.php?id_correspondant=<?PHP echo $photo_affichee_finale['id']; ?>&id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;color:#000;" >
                    <div style="cursor:pointer;display:flex;width:100%;height:45px;border-bottom: 1px dotted rgba(105, 105, 105, 0.2);margin-bottom:5px;">
                            <div style="width:18%;">
                                <?PHP echo '<img src="../membres/avatar/'.$photo_affichee_finale['avatar'].'" width="35px height="35px" style="border-radius:50%"">'; ?>
                            </div>
                            <div style="width:80%;height:45px;display:flex;flex-direction:column;font-family:Arial, Helvetica, sans-serif;row-gap:4px;margin:5px 0px;">
                                <div style="font-weight: bold;font-size:0.8rem;"><?PHP echo $photo_affichee_finale['prenom'].' '.$photo_affichee_finale['nom']; ?></div>
                                <div style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:0.7rem;"><?PHP echo $afficher_mes_messages['message']; ?></div>
                            </div>
                    </div>
                    </a>
            <?PHP
                    array_push($tableau_provisoire,$id_photo_affichee);
                }
            ?>

        <?PHP
        };
    }
    else {
        echo '<p style="width:100%;text-align:center;">Vous n\'avez aucun message !</p>';
    }
    ?>

    
    </body>
</html>
<?PHP 
}
else
{
   header('Location: ../index.php');
}
?>