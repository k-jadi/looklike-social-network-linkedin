<?PHP  

$compteur_notifications = $bdd->prepare('SELECT * FROM notifications_messages_entete WHERE id_destinataire_notification = ?');
$compteur_notifications->execute(array($_SESSION['id']));
$compteur_notifications = $compteur_notifications->rowCount();

if ($compteur_notifications != 0){
    $provisoire = 'y_notification.style.visibility = "hidden";';
    $provisoire_phone = 'xphone_notification.style.visibility = "hidden";';
}else{
    $provisoire = '';
    $provisoire_phone = '';
}

        echo '
        <script>
        let x = document.getElementById(\'section_messagerie_pc\');
        let x2 = document.getElementById(\'section_ecrire_message_pc\');
        let y = document.getElementById(\'cheveron_up\');
        let y_notification = document.getElementById(\'notification_message_entete\');
        let y2 = document.getElementById(\'ecrire_message\');
        let y3 = document.getElementById(\'fermer_ecrire_message\');
        let z = document.getElementById(\'chevron\');
        let u = document.getElementById(\'section_corps_messagerie_pc\');

        let xphone = document.getElementById(\'icone_messagerie_phone\');
        let xphone_notification = document.getElementById(\'notification_message_entete_phone\');
        let yphone = document.getElementById(\'barre_section_messagerie\');
        let zphone = document.getElementById(\'sortie_messagerie_phone\');

        xphone.addEventListener(\'click\', open3);

        function open3() {
            yphone.style.right = "0%";
            zphone.addEventListener(\'click\', close3);
            let xhr_supprimer_notification_phone = new XMLHttpRequest();
            xhr_supprimer_notification_phone.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    let res = this.response;
                    console.log(res);
                }
            }
            xhr_supprimer_notification_phone.open("GET","controls/supprimer_notifications_messages.php?id_destinataire='.$_SESSION['id'].'&id='.$_SESSION['id'].'", true);
            xhr_supprimer_notification_phone.responseType = "json";
            xhr_supprimer_notification_phone.send();
            '.$provisoire_phone.'
        }

        function close3() {
            yphone.style.right = "-100%";
        }


        let xphone2 = document.getElementById(\'ecrire_message_phone\');
        let yphone2 = document.getElementById(\'barre_section_messagerie_redaction\');
        let zphone2 = document.getElementById(\'sortie_messagerie_redaction_phone\');

        xphone2.addEventListener(\'click\', open32);

        function open32() {
            yphone2.style.right = "0%";
            zphone2.addEventListener(\'click\', close32);
        }

        function close32() {
            yphone2.style.right = "-100%";
        }




        y.addEventListener(\'click\', open);

        function open() {
            let xhr_supprimer_notification = new XMLHttpRequest();
            xhr_supprimer_notification.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    let res = this.response;
                    console.log(res);
                }
            }
            xhr_supprimer_notification.open("GET","controls/supprimer_notifications_messages.php?id_destinataire='.$_SESSION['id'].'&id='.$_SESSION['id'].'", true);
            xhr_supprimer_notification.responseType = "json";
            xhr_supprimer_notification.send();
            '.$provisoire.'
            x.style.bottom = "400px";
            u.style.bottom = "0px";
            z.classList.remove(\'fa-chevron-up\');
            z.classList.add(\'fa-chevron-down\');
            y.addEventListener(\'click\', close);
            
        }

        function close() {
            x.style.bottom = "0px";
            u.style.bottom = "-500px";
            z.classList.remove(\'fa-chevron-down\');
            z.classList.add(\'fa-chevron-up\');
            y.removeEventListener(\'click\',close);
            y.addEventListener(\'click\', open);
        }


        y2.addEventListener(\'click\', open2);

        function open2() {
            x2.style.bottom = "0px";
            y2.removeEventListener(\'click\',open2);
            y3.addEventListener(\'click\', close2);
        }

        function close2() {
            x2.style.bottom = "-350px";
            y3.removeEventListener(\'click\',close2);
            y2.addEventListener(\'click\', open2);
        }


        </script>
        ';
?>
