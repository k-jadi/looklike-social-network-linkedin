<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
$html_nombre_commentaires = 0;
$html_div_commentaires = "";

if(isset($_GET['idcommentaire'], $_GET['idpost']) AND isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'])
{
    $supprimer_commentaire = $bdd->prepare('DELETE FROM comments WHERE id=?');

    $supprimer_commentaire ->execute(array($_GET['idcommentaire']));

    $nombre_comments=$bdd->prepare('SELECT * FROM comments WHERE id_post=?');
    $nombre_comments->execute(array($_GET['idpost']));
    $resultat_nombre_comments = $nombre_comments->rowCount();

    $html_nombre_commentaires = '
    ( '.$resultat_nombre_comments.' commentaires )
    ';

            $afficher_comments = $bdd->prepare('SELECT * FROM comments WHERE id_post=? ORDER BY id DESC');
            $afficher_comments->execute(array($_GET['idpost']));
            while($liste_des_commentaires = $afficher_comments->fetch()){
                $afficher_commentateur = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                $afficher_commentateur->execute(array($liste_des_commentaires['id_commentateur']));
                $photo_commentateur = $afficher_commentateur->fetch();


                if($photo_commentateur['id'] == $_SESSION['id']){
                    $provisoire2 ='
                    <div onclick="demander_confirmation('.$liste_des_commentaires['id'].','.$_GET['idpost'].')" style="cursor:pointer;display:flex;align-items:center;justify-content:center;position: absolute;top:12px;right:10px;width:fit-content;height:25px;padding:0px 5px;background-color:rgba(105, 105, 105, 0.1);border-radius:5px;font-size:0.7rem;">
                       <i class="fa-solid fa-trash"></i>
                    </div>
                    ';
                }else {
                    $provisoire2 ='';
                }
                $html_div_commentaires .= '
                <div  style="width: 80%; background-color: rgba(184, 181, 181, 0.1); padding:10px;border: 1px dotted rgba(105, 105, 105, 0.2);margin-bottom:5px;border-radius:10px;position:relative;left:20px;margin-bottom:5px;">
                    '.$provisoire2.'
                    <div style="width: 5%;display:inline-block;vertical-align:top;margin-right:15px;">
                        <p><img src="membres/avatar/'.$photo_commentateur['avatar'].'" alt="photo de profil" width=25px height="25px" style="border-radius:50%;"></p>
                    </div>
                    <div style="width: 85%;display:inline-block;vertical-align:top;">
                    <p style="font-size: 0.7rem;font-family:Arial, Helvetica, sans-serif;">Par '.$photo_commentateur['prenom'].' '.$photo_commentateur['nom'].'</p>
                    </div>
                    <div style="vertical-align:top; padding-left:25px;">
                        <p style="font-size: 0.7rem;font-family:Arial, Helvetica, sans-serif;">'.$liste_des_commentaires['commentaire'].'</p>
                    </div>
                </div>
                ';


         
     }


$res = ["nbr_commentaires" => $html_nombre_commentaires, "div_commentaires" => $html_div_commentaires];
echo json_encode($res);
    
    
}

else
{
   header('Location:../index.php');
}
?>