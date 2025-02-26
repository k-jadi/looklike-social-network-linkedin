<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

// Création des variables utilisateur, inscrits et en ligne ***************************************
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

            <?PHP
                $photo_affichee = $bdd->prepare('SELECT prenom, nom, avatar FROM coordonnees_membres WHERE id=?');
                $photo_affichee->execute(array($get_id_correspondant));
                $photo_affichee_finale = $photo_affichee->fetch();

            ?>
                <div style="border: 1px dotted rgba(105, 105, 105, 0.2);position:relative;display:flex;flex-direction:column;width:100%;height:100vh;overflow:hidden;background-color:#fff;">
                    <div style="background-color:#fff;position:fixed;top:0px;height:55px;width:99%;display:flex;border-bottom: 1px dotted rgba(105, 105, 105, 0.2);padding:5px;">
                        <div style="width: 18%;">
                            <?PHP echo '<img src="../membres/avatar/'.$photo_affichee_finale['avatar'].'" width="35px height="35px" style="border-radius:50%"">'; ?>
                        </div>
                        <div  style="width: 67%;display:flex;align-items:center;justify-content:left;padding-left:5px;">
                            <?PHP echo $photo_affichee_finale['prenom'].' '.$photo_affichee_finale['nom']; ?>
                        </div>
                        <div  style="width: 14%;display:flex;align-items:center;justify-content:center;border-left:1px dotted #000;">
                            <a href="nouveau_message_pc.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;color:#000;" >
                                <i class="fa-solid fa-arrow-left" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                    </div>
                    <div style="height:245px;padding:5px;overflow:hidden;overflow-y: scroll;position:fixed;top:55px;width:100%;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" >
                        <form action="insertion_message_direct.php?id=<?PHP echo $_SESSION['id']; ?>&id_correspondant=<?PHP echo $get_id_correspondant; ?>" method="post">
                            <div style="width: 100%;display:inline-block;vertical-align:middle;">
                                <textarea name="message_direct" id="message_direct" maxlength="500" placeholder="Ecrire un message ..." rows="12" style="margin: 0; box-sizing: border-box; resize: none;width: 100%; padding:5px; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:5px "></textarea>
                            </div>
                            <div  style="width: 100%;display:inline-block;vertical-align:middle;text-align:center;">
                                <input  type="submit" disabled="true" name="envoi_message_direct" id="envoi_message_direct" value="Envoyer" style="width: 99%;padding:5px;cursor:not-allowed;border-radius:5px;border:none;background-color:rgba(105, 105, 105, 0.3);color:#fff;font-weight:bold;font-size:0.7rem">
                            </div>
                        </form>
                    </div>

                    </div>
                </div>    
    <script>
        let x = document.getElementById('message_direct');
        let y = document.getElementById('envoi_message_direct');
        x.addEventListener('input', ()=> {
            if (x.value != '') {
                y.style.backgroundColor = 'blue';
                y.style.cursor = 'pointer';
                y.disabled="";
            }
            else {
                y.style.backgroundColor = 'rgba(105, 105, 105, 0.3)';
                y.style.cursor = 'not-allowed';
                y.disabled="true";
            }
        })
    </script>
    </body>
</html>
<?PHP 
}
else
{
   header('Location: ../index.php');
}
?>