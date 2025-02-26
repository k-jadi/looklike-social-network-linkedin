<?PHP 
session_start();
$liste_messages_page = "";
$get_id_correspondant = intval($_GET['id_correspondant']);
$get_id = intval($_GET['id']);

$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
        if (!empty($_POST['textarea_redaction_message'])){
             $message_a_envoyer = htmlspecialchars($_POST['textarea_redaction_message']);
             $stock_message_a_envoyer = $bdd->prepare('INSERT INTO messagerie(id_expediteur,id_destinataire,message) VALUES(?,?,?)');
             $stock_message_a_envoyer->execute(array($_SESSION['id'],$get_id_correspondant,$message_a_envoyer));

            // Insertion dans la table de notifications messages entete
            $notification_message = $bdd->prepare('INSERT INTO notifications_messages_entete(id_expediteur_notification,id_destinataire_notification) VALUES(?,?)');
            $notification_message->execute(array($_SESSION['id'],$get_id_correspondant));

             
             $mes_messages = $bdd->prepare('SELECT * FROM messagerie WHERE id_expediteur = ? OR id_destinataire = ? ORDER BY id DESC');
             $mes_messages->execute(array($get_id_correspondant,$get_id_correspondant));
             while ($afficher_mes_messages = $mes_messages->fetch()) {
                if (($afficher_mes_messages['id_expediteur'] == $get_id OR $afficher_mes_messages['id_expediteur'] == $get_id_correspondant) AND ($afficher_mes_messages['id_destinataire'] == $get_id OR $afficher_mes_messages['id_destinataire'] == $get_id_correspondant)) {
                    $expediteur = $bdd->prepare('SELECT id, prenom, nom FROM coordonnees_membres WHERE id=?');
                    $expediteur->execute(array($afficher_mes_messages['id_expediteur']));
                    $expediteur = $expediteur->fetch();
                    $x= nl2br($afficher_mes_messages['message']);
                    $w = $expediteur['prenom'].' '.$expediteur['nom'];
                    if ($expediteur['id'] == $get_id){
                        $w = 'Vous!';
                    }
                    $liste_messages_page .= '
                    <p style="padding-top:5px;padding-left:5px;font-size:0.9rem;font-family:arial;color:gray;font-weight:bold;">'.$w.'</p>
                    <p style="padding-right:10px;padding-left:10px;padding-bottom:10px;font-size:0.7rem;font-family:arial;border-bottom:1px dotted rgba(66, 61, 61, 0.2);">'.$x.'</p>
                                    ';
                }
             }
        }


$res = ["liste_messages_page" => $liste_messages_page];
echo json_encode($res);

