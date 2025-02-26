<?PHP 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

if (isset($_GET['section']))
{
    $section = htmlspecialchars($_GET['section']);
}
else
{
    $section = "";
}

if (isset($_POST['submit_email_recup'],$_POST['email_recup']))
{
    if (!empty($_POST['email_recup']))
    {
        $email_recup = htmlspecialchars($_POST['email_recup']);
        if (filter_var($email_recup,FILTER_VALIDATE_EMAIL))
        {
            $mailexist = $bdd->prepare('SELECT * from coordonnees_membres WHERE email = ?');
            $mailexist->execute(array($email_recup));
            $mailexistcount = $mailexist->rowCount();
            if ($mailexistcount == 1)
            {
                $mailrecupere = $mailexist->fetch();
                $recupmail = $mailrecupere['email'];

                $recup_code = "";
                for ($i=0; $i < 8 ; $i++) { 
                    $recup_code .= mt_rand(1,9);
                }
                $email_recup_exist = $bdd->prepare('SELECT id FROM recup_mdp WHERE email = ?');
                $email_recup_exist->execute(array($email_recup));
                $email_recup_exist_count = $email_recup_exist->rowCount();
                if ($email_recup_exist_count == 1)
                {
                    $recup_insert = $bdd->prepare('UPDATE recup_mdp SET code = ? WHERE email = ?');
                    $recup_insert->execute(array($recup_code,$email_recup));
                }
                else
                {
                    $recup_insert = $bdd->prepare('INSERT INTO recup_mdp(email,code) VALUES (?,?)');
                    $recup_insert->execute(array($email_recup,$recup_code));
                }
                $message0 = $recup_code;

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

                $mail->addAddress($recupmail);

                $mail->isHTML(true);

                $mail->Subject = 'Votre code de recuperation';

                $message_sent = $message0;

                $mail->Body =$message_sent;

                $mail->send();
                
               
                header("Location:http://www.ingenieursdumaroc.com/mot_de_passe_recup.php?section=code&recupmail=$recupmail");

            }
            else
            {
                $erreure ='Cette adresse Email n\'est pas enregistrée !';
            }
        }
        else
        {
            $erreure ='Adresse Email invalide !';
        }
    }
    else
    {
        $erreure ='Veuillez entrer votre adresse Email !';
    }
}





if (isset($_POST['recup_code_sent'], $_POST['submit_code_sent'] ))
{
    if (!empty($_POST['recup_code_sent']))
    { 
        $mailconcerne = $_GET['recupmail'];

        $recup_code_sent = htmlspecialchars($_POST['recup_code_sent']);
        $verif_req = $bdd->prepare('SELECT * From recup_mdp WHERE email = ? AND code = ?');
        $verif_req->execute(array($_GET['recupmail'],$recup_code_sent));
        $verif_req_count = $verif_req->rowCount();
        if ($verif_req_count == 1)
        {
            $up_req = $bdd->prepare('UPDATE recup_mdp SET confirm = 1 WHERE email = ?');
            $up_req->execute((array($_GET['recupmail'])));
            header("Location:http://www.ingenieursdumaroc.com/mot_de_passe_recup.php?section=newpass&mailconcerne=$mailconcerne");
        }
        else
        {
            $erreure ='Code invalide !'; 
        }
    }
    else
    {
        $erreure ='Veuillez entrer votre code !';
    }
}


if (isset($_POST['submit_new_pwd_sent']))
{
    if (isset($_POST['new_pwd_sent'],$_POST['retype_new_pwd_sent']))
    {
        $verif_confirm = $bdd->prepare('SELECT confirm FROM recup_mdp WHERE email = ?');
        $verif_confirm->execute(array($_GET['mailconcerne']));
        $verif_confirm = $verif_confirm->fetch();
        $verif_confirm = $verif_confirm['confirm'];
        if ($verif_confirm == 1)
        {
            $mdpnew = htmlspecialchars($_POST['new_pwd_sent']);
            $mdpretypenew = htmlspecialchars($_POST['retype_new_pwd_sent']) ;
            if (!empty($mdpnew) AND !empty($mdpretypenew))
            {
                if ($mdpnew == $mdpretypenew )
                {
                    $mdpnewchifre = sha1($mdpnew);
                    $ins_mdp = $bdd->prepare('UPDATE coordonnees_membres SET mdp = ? , motdepass = ? WHERE email = ?');
                    $ins_mdp->execute(array($mdpnew,$mdpnewchifre,$_GET['mailconcerne']));
                    $del_req = $bdd->prepare('DELETE FROM recup_mdp WHERE email = ?');
                    $del_req->execute(array($_GET['mailconcerne']));
                    $message_reussi = "Votre mot de passe a bien été changé !<br>Vous allez être redirigé à la page connexion dans 5s.<br><br>";
                    header('refresh:5;URL=index.php');
                }
                else
                {
                    $erreure ='Vos mots de passe ne correspondent pas !';
                }
            }
            else
            {
                $erreure ='Veuillez remplir tous les champs !';
            }
        }
        else
        {
            $erreure ='Veuillez renseigner un email de récupération !';
        }
    }
    else
    {
        $erreure ='Veuillez remplir tous les champs !';
    }
}



?>

<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />   
   <title>Ing.</title>
</head>
<body>
   <!-- Header ******************************************************* -->
   <?php include("header_inscription.php"); ?>

   <!-- Barre Vide ******************************************************* -->
   <div class="barreVide_connexion"></div>

   <!-- Main page ******************************************************* -->
   <div class="connexion_layer">
        <div style="height:70vh;display:flex;flex-direction:column;justify-content:center;align-items:center;">
            <h3 class="titre1">Mot de passe oublié ?</h3>
            <?PHP
            if ($section == "code")
            {?>
                <form action="" method="post" class="formulaire">
                    <div  style="width:100%; text-align:left;">
                        <p>Entrer le code envoyé à votre Email.</p>
                    </div>
                    <div style="width:100%">
                        <label for="recup_code_sent" style="background-color:beige">Code</label>
                        <input type="text" name="recup_code_sent" id="recup_code_sent" placeholder="Entrez votre code ici ...">
                    </div>
                    <div style="width:100%; text-align:right">
                        <input type="submit" value="Envoyer" name="submit_code_sent" id="button" style="background-color:beige">
                    </div>
                </form>
            <?PHP
            }
            elseif ($section == "newpass") 
            { ?>
                <form action="" method="post" class="formulaire">
                    <div  style="width:100%; text-align:left">
                        <p>Entrez votre nouveau passe</p>
                    </div>
                    <div style="width:100%">
                        <label for="new_pwd_sent" style="background-color:beige">Pass</label>
                        <input type="password" name="new_pwd_sent" id="new_pwd_sent">
                    </div>
                    <div style="width:100%">
                        <label for="etype_new_pwd_sent" style="background-color:beige">Retype Pass</label>
                        <input type="password" name="retype_new_pwd_sent" id="retype_new_pwd_sent">
                    </div>
                    <div style="width:100%; text-align:right">
                        <input type="submit" value="Envoyer" name="submit_new_pwd_sent" id="button" style="background-color:beige">
                    </div>
                </form>
            <?PHP
            } 
            else
            {
            ?>
                <form action="" method="post" class="formulaire">
                    <div style="width:100%">
                        <label for="email_recup" style="background-color:beige">Email</label>
                        <input type="email" name="email_recup" id="email_recup" placeholder="Entrez votre adresse Email ...">
                    </div>
                    <div style="width:100%; text-align:right">
                        <input type="submit" value="Envoyer" name="submit_email_recup" id="button" style="background-color:beige">
                    </div>
                </form>
            <?PHP } ?>
        </div>
        <p style="font-size:12px;color:red;">
                    <?PHP
                        If (isset($erreure)) 
                        {
                            echo $erreure.'<br><br>';
                        }
                    ?>
        </p>
        <p style="font-size:12px;color:green;">
                    <?PHP
                        If (isset($message_reussi)) 
                        {
                            echo $message_reussi.'<br><br>';
                        }
                    ?>
        </p>
    </div>

   <!-- FOOTER ************************************************************ -->
   <footer style="position: fixed; bottom:0px;">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>
</body>
</html>