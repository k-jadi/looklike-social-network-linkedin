<?PHP 
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $get_id_correspondant = intval($_GET['id_destinataire']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title></title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body style="overflow: hidden;">
<div style="padding:5px;display:flex;align-items:center;justify-content:center;width:100%;height:100vh;background-color:#fff;">
<?PHP
    $get_id_correspondant = intval($_GET['id_correspondant']);
    if (!empty($_POST['message_direct'])){
            $message_a_envoyer = htmlspecialchars($_POST['message_direct']);
            $stock_message_a_envoyer = $bdd->prepare('INSERT INTO messagerie(id_expediteur,id_destinataire,message) VALUES(?,?,?)');
            $stock_message_a_envoyer->execute(array($_SESSION['id'],$get_id_correspondant,$message_a_envoyer));

            // Insertion dans la table de notifications messages entete
            $notification_message = $bdd->prepare('INSERT INTO notifications_messages_entete(id_expediteur_notification,id_destinataire_notification) VALUES(?,?)');
            $notification_message->execute(array($_SESSION['id'],$get_id_correspondant));


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

              $mail->addAddress($destinataire_info['email']);

              $mail->isHTML(true);

              $mail->Subject = 'Vous avez un nouveau message';

              $message_sent = nl2br('
              Bonjour '.$destinataire_info['prenom'].'
              
              Vous avez un nouveau message de la part de '.$user_info['prenom'].' '.$user_info['nom'].'
              
              Vous le trouverez dans votre boîte messagerie.
              
              
              Ing.
              www.ingenieursdumaroc.com
              
                            ');

              $mail->Body =$message_sent;

              $mail->send();

            ?>
            
            <p style="padding:5px;text-align:center;color:green;font-family:Arial, Helvetica, sans-serif;font-size:0.8rem;font-weight:bold;">Votre message a bien été envoyé.<br><br>Retour dans 3s pour écrire un nouveau message.</p>
            <?PHP
            header('refresh:3;URL=nouveau_message_pc.php?id='.$_SESSION['id']);
    }
?>
</div>

</body>
</html>


<?PHP 
}
else
{
   header('Location: ../index.php');
}
?>