<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

// Création des variables utilisateur, inscrits et en ligne ***************************************
if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $get_id_correspondant = intval($_GET['id_correspondant']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
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
                <div style="position:fixed;top:0px;display:flex;flex-direction:column;width:100%;height:100%;overflow:hidden;">
                    <div style="background-color:#fff;height:55px;width:100%;display:flex;">
                        <div style="border-right: 1px dotted #000;height:55px;width: 15%;display:flex;align-items:center;justify-content:center;">
                            <?PHP echo '<img src="../membres/avatar/'.$photo_affichee_finale['avatar'].'" width="35px height="35px" style="border-radius:50%"">'; ?>
                        </div>
                        <div  style="height:55px;width: 70%;display:flex;align-items:center;justify-content:center">
                            <span style="font-weight:bold;font-family:arial;"><?PHP echo $photo_affichee_finale['prenom'].' '.$photo_affichee_finale['nom']; ?></span>
                        </div>
                        <div  style="height:55px;width: 15%;display:flex;align-items:center;justify-content:center;background-color:rgba(66, 61, 61, 0.2);">
                            <a href="corps_messagerie_phone.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration: none;color:#000;" >
                                <i class="fa-solid fa-arrow-left" style="font-size: 1.1rem;"></i>
                            </a>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;background-color:rgba(66, 61, 61, 0.1);height:55px;width:100%;" id="redaction_message">
                        <form id="formulaire_redaction_message" style="width: 100%;display:flex; align-items:center; ">
                            <div style="width: 85%;">
                                <textarea name="textarea_redaction_message" id="textarea_redaction_message" maxlength="350" placeholder="Rédigez un message ..." rows="2" style="max-height: 140px;;display: block; margin: 0; padding: 8px; box-sizing: border-box; resize: vertical;width: 100%; padding:5px; border: 1px dotted rgba(105, 105, 105, 0.2); "></textarea>
                            </div>
                            <div  style="width: 15%;display:flex; align-items:center;justify-content:center;">
                                <input type="submit" disabled="true" name="publication_message" id="publication_message" value="Envoyer" style="width: 100%;height:45px;padding:5px;cursor:not-allowed;border:none;background-color:rgba(66, 61, 61, 0.2);color:#fff;font-weight:bold;font-size:0.7rem">
                            </div>
                        </form>
                    </div>
                    <div style="height:500px;overflow:hidden;overflow-y: scroll;width:100%;display:flex;flex-direction:column;font-family:Arial, Helvetica, sans-serif;row-gap:4px;" id="liste_messages">
                        <?PHP
                            $mes_messages = $bdd->prepare('SELECT * FROM messagerie WHERE id_expediteur = ? OR id_destinataire = ? ORDER BY id DESC');
                            $mes_messages->execute(array($get_id_correspondant,$get_id_correspondant));
                            while ($afficher_mes_messages = $mes_messages->fetch()) {
                                if (($afficher_mes_messages['id_expediteur'] == $get_id OR $afficher_mes_messages['id_expediteur'] == $get_id_correspondant) AND ($afficher_mes_messages['id_destinataire'] == $get_id OR $afficher_mes_messages['id_destinataire'] == $get_id_correspondant)) {
                                    $expediteur = $bdd->prepare('SELECT id, prenom, nom FROM coordonnees_membres WHERE id=?');
                                    $expediteur->execute(array($afficher_mes_messages['id_expediteur']));
                                    $expediteur = $expediteur->fetch();
                                    $x = nl2br($afficher_mes_messages['message']);
                                    $w = $expediteur['prenom'].' '.$expediteur['nom'];
                                    if ($expediteur['id'] == $get_id){
                                        $w = 'Vous!';
                                    }
                                    echo '
                                    <p style="padding-top:5px;padding-left:5px;font-size:0.9rem;font-family:arial;color:gray;font-weight:bold;">'.$w.'</p>
                                    <p style="padding-right:10px;padding-left:10px;padding-bottom:10px;font-size:0.7rem;font-family:arial;border-bottom:1px dotted rgba(66, 61, 61, 0.2);">'.$x.'</p>
                                    ';
                                }
                            }
                        ?>
                    </div>
                    
                </div>    

    <script>
        let x = document.getElementById('textarea_redaction_message');
        let y = document.getElementById('publication_message');
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

        <!-- <script>
            const textarea_message = document.getElementById("textarea_redaction_message");
            textarea_message.addEventListener('input', () => {
                if (textarea_message.value !== ''){
                        document.getElementById("publication_message").style.visibility = "visible";         
                    }
                    else{
                        document.getElementById("publication_message").style.visibility = "hidden";
                    }
            })
            
        </script> -->

        <script>
            document.getElementById("formulaire_redaction_message").addEventListener("submit", function(e) {
                e.preventDefault();
                let xhr = new XMLHttpRequest();
                let data = new FormData(this);
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        let res = this.response;
                        let x = document.getElementById("liste_messages");
                        let y = document.getElementById("textarea_redaction_message");
                        let z = document.getElementById("publication_message");
                        x.innerHTML = res.liste_messages_page;
                        y.value = "";
                        z.style.backgroundColor = 'rgba(66, 61, 61, 0.2)';
                        z.style.cursor = 'not-allowed';
                        z.disabled="true";
                    }
                }
                xhr.open("POST",'insertion_messages.php?id=<?PHP echo $get_id; ?>&id_correspondant=<?PHP echo $get_id_correspondant; ?>', true);
                xhr.responseType = "json";
                xhr.send(data);
                return false;
            }
            );
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