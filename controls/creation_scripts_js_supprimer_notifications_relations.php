<?PHP  

$compteur_notifications_relations = $bdd->prepare('SELECT * FROM notifications_relations WHERE id_destinataire_relations = ?');
$compteur_notifications_relations->execute(array($_SESSION['id']));
$compteur_notifications_relations = $compteur_notifications_relations->rowCount();

if ($compteur_notifications_relations != 0){
        echo '
        <script>
        let y_relations = document.getElementById(\'icone_reseau\');
        let xphone_relations = document.getElementById(\'icone_reseau_phone\');
        

        xphone_relations.addEventListener(\'click\', supprimer_notification_relations_phone);
        function supprimer_notification_relations_phone() {
            let xhr_supprimer_notification_relations_phone = new XMLHttpRequest();
            xhr_supprimer_notification_relations_phone.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    let res = this.response;
                    console.log(res);
                }
            }
            xhr_supprimer_notification_relations_phone.open("GET","controls/supprimer_notifications_relations.php?id_destinataire_relations='.$_SESSION['id'].'&id='.$_SESSION['id'].'", true);
            xhr_supprimer_notification_relations_phone.responseType = "json";
            xhr_supprimer_notification_relations_phone.send();
            
        }


        y_relations.addEventListener(\'click\', supprimer_notification_relations);

        function supprimer_notification_relations() {
            let xhr_supprimer_notification_relations = new XMLHttpRequest();
            xhr_supprimer_notification_relations.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    let res = this.response;
                    console.log(res);
                }
            }
            xhr_supprimer_notification_relations.open("GET","controls/supprimer_notifications_relations.php?id_destinataire_relations='.$_SESSION['id'].'&id='.$_SESSION['id'].'", true);
            xhr_supprimer_notification_relations.responseType = "json";
            xhr_supprimer_notification_relations.send();
            
        }


        </script>
        ';
}
?>
