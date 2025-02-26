<?PHP 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';



$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

    

if(isset($_GET['id_relation']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $get_id_relation = intval($_GET['id_relation']);
    $get_id = intval($_GET['id']);

    $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
    $req_user->execute(array($get_id_relation));
    $user_info = $req_user->fetch();
    $user_email = $user_info['email'];

    $req_user2 = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
    $req_user2->execute(array($get_id));
    $user_info2 = $req_user2->fetch();

    $demander_relation = $bdd->prepare('INSERT INTO gestion_relations(user_demandeur, user_receveur, statut_demande) VALUES(?,?,?) ');
    $demander_relation->execute(array($_SESSION['id'],$get_id_relation,1));

    $ajouter_notification_relation = $bdd->prepare('INSERT INTO notifications_relations(id_expediteur_relations, id_destinataire_relations) VALUES(?,?) ');
    $ajouter_notification_relation->execute(array($_SESSION['id'],$_GET['id_relation']));


                // envoyer un message

                $req_destinataire = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                $req_destinataire->execute(array($get_id_correspondant));
                $destinataire_info = $req_destinataire->fetch();
    
                $mail = new PHPMailer(true);
                  $mail->isSMTP();
                  $mail->Host = 'mail.50webs.net';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'admin@ingenieursdumaroc.com';
                  $mail->Password = 'IZ5Zg3h9t@!-*=2az3s';
                  $mail->SMTPSecure = 'ssl';
                  $mail->Port = 465;
    
                  $mail->setFrom('admin@ingenieursdumaroc.com','Ingenieurs du Maroc');
    
                  $mail->addAddress($user_email);
    
                  $mail->isHTML(true);
    
                  $mail->Subject = 'Vous avez une demande de connexion';
    
                  $message_sent = nl2br('
                  Bonjour '.$user_info['prenom'].',
                  
                  Vous avez reçu une demande de connexion de la part de '.$user_info2['prenom'].' '.$user_info2['nom'].'.
                  
                  Vous pouvez accépter ou rejeter la demande depuis votre espace "Mon réseau".
                  
                  Merci.
                  
                  Admin.
                  www.ingenieursdumaroc.com
                  
                  
                  ');
    
                  $mail->Body =$message_sent;
    
                  $mail->send();
    
    header('location:../profil.php?id='.$get_id_relation);

}
else
{
   header('Location:../index.php');
}
?>