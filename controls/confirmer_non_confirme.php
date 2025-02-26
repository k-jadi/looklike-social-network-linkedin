<?PHP 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';



$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if(isset($_GET['id'], $_GET['idnonconfirme']) AND $_GET['id'] == $_SESSION['id'] AND $_SESSION['id'] == 23)
{

    $non_confirmes = $bdd->prepare('UPDATE coordonnees_membres SET confirmation = 1 WHERE id = ? ');
    $non_confirmes->execute(array($_GET['idnonconfirme']));
    $prenom_non_confirme = $_GET['prenomnonconfirme'];
    $email_non_confirme = $_GET['emailnonconfirme'];

    $header="From: Ingénieurs du Maroc <admin@ingenieursdumaroc.com>";
    $message0 = '
    Bonjour '.$prenom_non_confirme.'

    Votre inscription est confirmée.
    
    Votre Login est : '.$email_non_confirme.'
    
    Votre Mot de pass est : (...)
    
    Merci pour votre inscription
    
    Admin.';
    // mail($email_non_confirme, "Confirmation de votre inscription.", $message0, $header);

    // envoyer un message
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.50webs.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'admin@ingenieursdumaroc.com';
    $mail->Password = 'IZ5Zg3h9t@!-*=2az3s';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('admin@ingenieursdumaroc.com','Ingenieurs du Maroc');

    $mail->addAddress($email_non_confirme);

    $mail->isHTML(true);

    $mail->Subject = 'Confirmation de votre inscription.';

    $message_sent = nl2br($message0);

    $mail->Body =$message_sent;

    $mail->send();



    header('location:../membres_gestion.php?id='.$_SESSION['id']);

}
else
{
   header('Location:../index.php');
}
?>