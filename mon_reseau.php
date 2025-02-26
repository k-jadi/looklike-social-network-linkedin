<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
if(isset($_GET['id']) AND isset($_SESSION['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();

   $req_user2 = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user2->execute(array($_SESSION['id']));
   $user_info2 = $req_user2->fetch();

   $inscrits = $bdd->query('SELECT * FROM coordonnees_membres');
   $nombre_inscrits = $inscrits->rowCount();
   
   include('controls/membres_enligne.php');
   include('controls/traitement_php_posts.php');


   $query = $bdd->prepare('SELECT * FROM gestion_relations WHERE user_demandeur = :user_demandeur OR user_receveur = :user_receveur');
    $query->execute([
        "user_demandeur" => $_SESSION['id'],
        "user_receveur" => $_SESSION['id']

    ]);
    $compteur = $query->rowCount();
    $data = $query->fetchAll();

// script 001 : Compter le nombre de relations du $_SESSION['id']
    $nombre_connectes = 0;

    if ($compteur !== 0){
        $compteur_provisoire2 = 0;
        for($j=0; $j < sizeof($data); $j++){
            if(($data[$j]['user_demandeur'] == $_SESSION['id'] OR $data[$j]['user_receveur'] == $_SESSION['id']) AND $data[$j]['statut_demande'] == 0){
                $compteur_provisoire2++;
            }
        }
        $nombre_connectes = $compteur_provisoire2;
    }
// fin du script 001


?>


<!DOCTYPE html>
<html lang="FR">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Ing.</title>
   <?PHP include('controls/inscrits_barres.php'); ?>
</head>
<body>



<!-- Header *********************************************************************************** -->

   <!-- Menu + profil caché à gauche à utiliser sur le phone viewer -->
   <div class="barre_lateral" id="barre_lateral">
      <?PHP include('slidelayer_phone_recherche.php'); ?>
   </div>

   <!-- Partie Header both desk & phone viewers -->
   <header id="header_hidden">
      <h1>Ing.</h1>
      <div id="avatar">
         <?PHP
            if(!empty($user_info2['avatar']))
            {
                  ?>
                     <img src="membres/avatar/<?php echo $user_info2['avatar'];  ?>" id="avatar_default2">
                  <?PHP 
            }
         ?>
      </div>
      <ul id="header_emploi">
         <li style="display:flex;align-items:center;justify-content:center;"><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-house"></i><span>Acceuil</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-user-group" style="color: rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);">Réseau</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase"></i><span>Emploi</span></div></a></li>
         <?PHP 
               if ($user_info['interlocuteur'] == ''){
         ?>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book"></i><span>Bibliothèque</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book-bookmark"></i><span>Pfe</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-store"></i><span>Ing Mall</span></div></a></li>
         <?PHP 
               }    
         ?>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="deconnexion.php"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-right-from-bracket"></i><span>Quitter</span></div></a></li>
      </ul>
      <div class="loading_edition_white" style="border-bottom: 1px dotted rgba(105, 105, 105, 0.2);">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
   </header>



<!-- Barre horizontale de séparation vide fixe ********************************************** -->
   <div class="barreVide"></div>




<!-- fenêtre ouvrante pour redaction des posts pour portable -->
<div class="fenetre_redaction_posts3">
      <div class="sous_fenetre_redaction_posts">
         <p>Bonjour <?PHP echo $user_info['prenom'] ?>,<br><br></p>
         <!-- Formulaire pour les posts phone -->
         <form action="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" method="post" enctype="multipart/form-data" id="form_posts_pc2">
            <textarea  name="texte_posts2" required  id="texte_posts2" placeholder="De quoi souhaitez-vous discuter ?" rows="14" style="width:100%;padding: 10px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;margin-bottom:25px;resize:none;"></textarea>
            <div style="display:flex;justify-content:right;">
               <p style="border: 1px dotted gray;border-radius:5px; position:relative;display:flex; align-items:center;justify-content:center; width:120px;height:120px;text-align:center;background-image:url('imgindex/visualisez_limage_ici2.png');background-repeat: no-repeat;" id="image_wrapper2">
                  <span id="fermerphoto2"  style="display:flex; align-items:center;justify-content:center;cursor:pointer;position: absolute; top:5px; right:10px;border-radius:50%;background-color:rgba(105, 105, 105, 0.7);width:20px;height:20px;"><i class="fa-solid fa-x" style="font-size: 0.8rem; color:#fff"></i></span>
               </p>
            </div>
            <div style="text-align:center;">
               <input type="submit" value="Poster" id="button2" name="submit_posts2" style="position:absolute;bottom:9vh;right:15px;background-color:beige;width:100px">
            </div>
         </form>
         <div>
            <label>
               <input type="file" style="display:none;" name="piece_jointe_posts2" id="piece_join_posts2" accept=".jpg, .png, .gif, .jpeg">
               <p style="text-align:left;">
                  <i class="fa fa-picture-o" aria-hidden="true" style="cursor:pointer;position:absolute;bottom:18vh;left:15px;font-size: 2rem;"></i>
                  <hr style="position:absolute;bottom:15vh;left:20px;width:95%; border: 1px dotted rgba(105, 105, 105, 0.3);">
               </p>
            </label>
         </div>
         <!-- Fin Formulaire pour les posts phone -->
         <span class="fenetre_fermeture4"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
      </div>
   </div>



   
<!-- Main page ***************************************************************************************** -->
    <!-- Menu flottant hors flux DOM pour gerer Invitations ************************************** -->
    <div style="min-width:80px;padding:5px;position:fixed; top: 50vh; right:0px; background-color: rgba(105,105,105,0.5);z-index:53;border-top-left-radius: 10%;border-bottom-left-radius: 10%;" id="gestion_relations_menu">
         <p style="color:#fff;font-size:0.8rem;min-width:100%;text-align:center;"><i class="fa-solid fa-user-plus" style="color: #fff;font-size:2rem;"></i></p>
         <p style="color:#fff;font-size:0.8rem;text-align:center;">Invitations</p>
      </div>

    <!-- Menu flottant hors flux DOM pour membres stats ************************************** -->
    <div style="min-width:80px;padding:5px;position:fixed; top: 62vh; right:0px; background-color: rgba(105,105,105,0.5);z-index:53;border-top-left-radius: 10%;border-bottom-left-radius: 10%;" id="membres_stats_menu">
         <p style="color:#fff;font-size:0.8rem;min-width:100%;text-align:center;"><i class="fa-solid fa-chart-pie" style="color: #fff;font-size:2rem;"></i></p>
         <p style="color:#fff;font-size:0.8rem;text-align:center;">Stats</p>
      </div>

    <div class="wraper" style="position: relative;">
        <!--  SIDE LAYER GAUCHE -->
        <div class="sideLayer" style="width:25%;position: sticky;top:100px; border-radius:5px;background-color:rgba(105, 105, 105, 0.06)">
            <h3 class="titre1"><?PHP echo ' '.$user_info2['prenom'].' '.$user_info2['nom']; ?></h3>
            <?PHP
                if(!empty($user_info2['avatar']))
                {
                    ?>
                        <img src="membres/avatar/<?php echo $user_info2['avatar'];  ?>" id="avatar_default">
                    <?PHP 
                }
            ?>
            <p class="source" style="background-color:rgba(105, 105, 105, 0.09)">Mon profil</p>
            <?PHP 
               if ($user_info['interlocuteur'] == ''){
            ?>
            <p class="source"><?PHP echo 'Ingénieur '.$user_info2['ecole'].', promo '.$user_info2['promotion']; ?><br></p>
            <p class="source"><?PHP echo 'Diplômé en génie : '; if($user_info2['genie'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['genie']; }?><br></p>
            <?PHP
             }
            ?>
            <p class="source"><i class="fa-solid fa-envelope" style="font-size: 0.8rem;"></i> : <?PHP echo $user_info2['email']; ?><br></p>
            <p class="source"><i class="fa fa-whatsapp" style="font-size:14px;color:green;"></i> : <?PHP if($user_info2['phone'] == "") {echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';}else{echo $user_info2['phone']; } ?><br></p>
            <?PHP 
               if ($user_info['interlocuteur'] == ''){
            ?>
            <p class="source"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  Mon CV : 
            <?PHP
                if(!empty($user_info2['cv']))
                {
                    ?>
                        <a href="membres/cv/<?php echo $user_info2['cv'];  ?>" target=_blank>Voir</a>
                    <?PHP 
                }
                else
                {
                    echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';
                }
            ?>
            </p>
            <p class="source"><i class="fa fa-file-pdf-o" style="font-size:14px;color:red;"></i>  Mon PFE : 
            <?PHP
                if(!empty($user_info['pfe']))
                {
                    ?>
                        <a href="membres/pfe/<?php echo $user_info2['pfe'];  ?>" target=_blank id="avatar_default2">Voir</a>
                    <?PHP 
                }
                else
                {
                    echo '<span style="color:rgba(241, 29, 29, 0.3); font-size:0.8rem;">Non renseigné</span>';
                }
            ?>
            </p>
            <?PHP
             }
            ?>
            <p class="source" style="text-align:center;"><?PHP echo 'Nombre de relations : '; echo $nombre_connectes ; ?><br></p>
            <div style="width:100%; height:60px; display:flex;align-items:center;justify-content:center;gap:15px;">
                <p class="boutton_voir_monprofil">
                    <a href="profil.php?id=<?PHP echo $_SESSION['id']?>">Voir mon profil</a>     
                </p>
                <p class="boutton_editer_monprofil">
                    <a href="edition_profil.php?id=<?PHP echo $_SESSION['id']?>">Editer mon profil</a>     
                </p>
            </div>
        </div>

        <!--  SIDE LAYER MILIEU -->
        <div class="container">
            <h3 class="titre1">Mes relations (<?PHP echo $nombre_connectes; ?>) </h3>
            <?PHP
                if ($compteur !== 0){
                    $compteur_provisoire = 0;
                    for($i=0; $i < sizeof($data); $i++){
                        if(($data[$i]['user_demandeur'] == $_SESSION['id'] OR $data[$i]['user_receveur'] == $_SESSION['id']) AND $data[$i]['statut_demande'] == 0){
                            if ($data[$i]['user_demandeur'] == $_SESSION['id']){
                                $id_friend = $data[$i]['user_receveur'];
                            }
                            else if ($data[$i]['user_receveur'] == $_SESSION['id']){
                                $id_friend = $data[$i]['user_demandeur'];
                            }
                            $looking_friend = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                            $looking_friend->execute(array($id_friend));
                            $friend = $looking_friend->fetch();
                            if ($friend['interlocuteur'] == ''){
                            echo '
                            <a href="profil.php?id='.$friend['id'].'" style="text-decoration:none;">
                                <div style="width : 99%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;display:flex;justify-content:center;align-items:center;">
                                    <div style="width : 50%;padding:10px;">
                                        <p style="font-size:0.8rem;">'.
                                        $friend['prenom'].' '.$friend['nom'].'<br>'.
                                        'Ingénieur '.$friend['ecole'].', promo '.$friend['promotion'].'
                                        </p>
                                    </div>
                                    <div style="width : 23%;border-left: 1px dotted #cabcbc;">
                                        <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$friend['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                                    </div>
                                    <div style="width:25%;height:100%;border-left: 1px dotted #cabcbc;vertical-align:middle;">
                                            <form action="controls/supprimer_relation.php?id='.$_SESSION['id'].'&id_relation='.$friend['id'].'" method="POST" style="width:100%;height:100%;text-align:center;">
                                                <input type="submit" value="Supprimer" name="supprimer_relation" style="padding:5px;cursor:pointer;border: 1px dotted #cabcbc;border-radius:5px;">
                                            </form>
                                    </div>
                                </div>
                            </a>
                            ' ;}else {
                                echo '
                            <a href="profil.php?id='.$friend['id'].'" style="text-decoration:none;">
                                <div style="width : 99%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;display:flex;justify-content:center;align-items:center;">
                                    <div style="width : 50%;padding:10px;">
                                        <p style="font-size:0.8rem;">'.
                                        $friend['prenom'].' '.$friend['nom'].'<br>'.
                                        'Recruteur
                                        </p>
                                    </div>
                                    <div style="width : 23%;border-left: 1px dotted #cabcbc;">
                                        <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$friend['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                                    </div>
                                    <div style="width:25%;height:100%;border-left: 1px dotted #cabcbc;vertical-align:middle;">
                                            <form action="controls/supprimer_relation.php?id='.$_SESSION['id'].'&id_relation='.$friend['id'].'" method="POST" style="width:100%;height:100%;text-align:center;">
                                                <input type="submit" value="Supprimer" name="supprimer_relation" style="padding:5px;cursor:pointer;border: 1px dotted #cabcbc;border-radius:5px;">
                                            </form>
                                    </div>
                                </div>
                            </a>';
                            }
                            $compteur_provisoire++;
                        }
                    }
                    if ($compteur_provisoire == 0){
                        echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                        <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune relation !</p>
                        </div>';
                    }
                }
                else{
                    echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                    <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune relation !</p>
                    </div>';
                }
            ?>
        </div>

        <!--  SIDE LAYER DROITE -->
        <div class="container2">
        <span class="fenetre_fermeture6"><i class="fa-solid fa-x" style="font-size: 1.5rem; color:#000;"></i></span>
            <h3 class="titre1">Gérer les invitations</h3>
            <div class="tabs_container">
                <div class="tabs">
                    <h3 class="active">Reçues</h3>
                    <h3>Envoyées</h3>
                </div>
                <div class="tab-content">
                    <div class="tabs_div active">
                        <?PHP
                            if ($compteur !== 0){
                                $compteur_provisoire = 0;
                                for($i=0; $i < sizeof($data); $i++){
                                    if($data[$i]['user_demandeur'] !== $_SESSION['id'] AND $data[$i]['user_receveur'] == $_SESSION['id'] AND $data[$i]['statut_demande'] == 1){
                                        $id_friend = $data[$i]['user_demandeur'];
                                        $looking_friend = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                                        $looking_friend->execute(array($id_friend));
                                        $friend = $looking_friend->fetch();
                                        echo '
                                        <a href="profil.php?id='.$friend['id'].'">
                                            <div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                                <div style="width : 75%;display:inline-block;padding:10px;">
                                                    <p style="font-size:0.8rem;">'.$friend['prenom'].' '.$friend['nom'].'<br>'.'Ingénieur '.$friend['ecole'].', promo '.$friend['promotion'].'</p>
                                                </div>
                                                <div style="width : 23%;display:inline-block;border-left: 1px dotted #cabcbc;">
                                                    <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$friend['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                                                </div>
                                            </div>
                                        </a>
                                        <div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                            <div style="width :100%%;display:flex;align-items:center;justify-content:center;">
                                                    <form action="controls/accepter_relation.php?id='.$_SESSION['id'].'&id_relation='.$friend['id'].'" method="POST" style="width:50%;text-align:center;">
                                                        <input type="submit" value="Accépter" name="accepter_relation" style="padding:5px;cursor:pointer;border: 1px dotted #cabcbc;border-radius:5px;">
                                                    </form>
                                                    <form action="controls/refuser_relation.php?id='.$_SESSION['id'].'&id_relation='.$friend['id'].'" method="POST" style="width:50%;text-align:center;">
                                                        <input type="submit" value="Refuser" name="refuser_relation" style="padding:5px;cursor:pointer;border: 1px dotted #cabcbc;border-radius:5px;">
                                                    </form>
                                            </div>
                                        </div>
                                        ' ;
                                        $compteur_provisoire++;
                                    }
                                }
                                if ($compteur_provisoire == 0){
                                    echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                    <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune invitation !</p>
                                    </div>';
                                }
                            }
                            else{
                                echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune invitation !</p>
                                </div>';
                            }
                        ?>
                    </div>
                    <div class="tabs_div">
                        <?PHP
                            if ($compteur !== 0){
                                $compteur_provisoire = 0;
                                for($i=0; $i < sizeof($data); $i++){
                                    if($data[$i]['user_demandeur'] == $_SESSION['id'] AND $data[$i]['user_receveur'] !== $_SESSION['id'] AND $data[$i]['statut_demande'] == 1){
                                        $id_friend = $data[$i]['user_receveur'];
                                        $looking_friend = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                                        $looking_friend->execute(array($id_friend));
                                        $friend = $looking_friend->fetch();
                                        echo '
                                        <a href="profil.php?id='.$friend['id'].'
                                        " style="text-decoration:none;"><div style="display:flex;align-items:center;justify-content:center; width:98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                        <div style="width : 54%;padding:10px;">
                                        <p style="font-size:0.7rem;">'.
                                        $friend['prenom'].' '.$friend['nom'].'<br>'.
                                        'Ingénieur '.$friend['ecole'].', promo '.$friend['promotion'].'
                                        </p>
                                        </div>
                                        <div style="width : 20%;border-left: 1px dotted #cabcbc;">
                                        <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$friend['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                                        </div>
                                        <div style="width:24%;height:100%;border-left: 1px dotted #cabcbc;vertical-align:middle;">
                                            <form action="controls/retirer_relation.php?id='.$_SESSION['id'].'&id_relation='.$friend['id'].'" method="POST" style="width:100%;height:100%;text-align:center;">
                                                <input type="submit" value="Retirer" name="retirer_relation" style="padding:2px;cursor:pointer;border: 1px dotted #cabcbc;border-radius:5px;">
                                            </form>
                                        </div>
                                        </div>
                                        </a>
                                        ' ;
                                        $compteur_provisoire++;
                                    }
                                }
                                if ($compteur_provisoire == 0){
                                    echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                    <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune invitation !</p>
                                    </div>';
                                }
                            }
                            else{
                                echo '<div style="width : 98%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                                <p style="width:100%;height:100%;text-align: center;font-size:0.8rem;">Vous n\'avez aucune invitation !</p>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!--  Membres Stats -->
        <div class="container3">
            <span class="fenetre_fermeture9"><i class="fa-solid fa-x" style="font-size: 1.5rem; color:#000;"></i></span>
            <h3 class="titre1 titre2">Nombre d'inscrits : <?php echo $nombre_inscrits; ?></h3>
            <div class="container_inscrits_barres">
                <?PHP 
                    $liste_ecoles = ["EMI", "ENSIAS", "ENIM", "EHTP", "INSEA", "ENSEM", "INPT", "IAV", "ESITH", "ERN", "AIAC","POLYTECH_FRANCE","ENSI_FRANCE","MINES_TELECOM_FRANCE","CNAM_FRANCE","ESTP_FRANCE","CENTRALE_FRANCE","PARISTECH_FRANCE","POLYTECH_MONTREAL","ENSAM_FRANCE"];
                    for($i=0; $i<20; $i++){
                        $membres_par_ecole = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE ecole=? ');
                        $membres_par_ecole->execute(array($liste_ecoles[$i]));
                        $nombre_membres_par_ecole = $membres_par_ecole->rowCount();
                        echo '
                            <div class="skill-box">
                                <span class="title">'.$liste_ecoles[$i].'</span>
                                <div class="skill-bar">
                                    <span class="skill-per '.$liste_ecoles[$i].'">
                                        <span class="tooltip">'.$nombre_membres_par_ecole.'</span>
                                    </span>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
   </div>

   <br><br><br><br><br><br><br><br><br><br>

<!-- Le footer for both desk & phone viewers ************************************************************ -->
   <footer id="footer_index">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>

   <div id="footer_post">
   <div  id="plus_posts_m" style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-plus" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Post</span></div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 80%;display:flex;align-items:center;justify-content:center;">
         <a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-house-chimney" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Acceuil</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;border-top:2px solid black;position: absolute; right : 60%;display:flex;align-items:center;justify-content:center;">
            <a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-user-group" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Mon réseau</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 20%;display:flex;align-items:center;justify-content:center;">
         <a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-briefcase" style="font-size: 1rem;"></i><span style="font-size: 0.7rem;">Emploi</span></div></a>
      </div>
      <div style="height:100%;width:20%;padding:0px;position: absolute; right : 0%;display:flex;align-items:center;justify-content:center;">
         <a href="deconnexion.php" style="text-decoration:none;"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:1px;"><i class="fa-solid fa-right-from-bracket" style="font-size:1rem;"></i><span style="font-size: 0.7rem;">Quitter</span></div></a>
      </div>
   </div>
   

    <!-- Les scripts JS ************************************************************************************ -->
    <script src="js/script_post_stats_members.js"></script>
   <script src="js/script_post.js"></script>
   <script src="js/script_comments.js"></script>
   <script src="js/script_barres_down.js"></script>
   <?PHP include('controls/creation_scripts_js_textarea_boutton_commentaires.php'); ?>
   <?PHP include('controls/creation_scripts_js_asychrone_traitement_commentaires.php'); ?>
   <script src="js/script_footer_scroll_hidden.js"></script>
   <script src="js/script_header_scroll_hidden.js"></script>
   <script src="js/script_resize_image_posts_phone.js"></script>
   <script src="js/script_resize_image_posts.js"></script>
   <script src="js/script_barre_lateral.js"></script>
   <script src="js/script_barre_recherche.js"></script>
   <script src="js/script_tabs.js"></script>
   <script>
        let x = document.getElementById('gestion_relations_menu');
        let v = document.getElementById('membres_stats_menu');
        let y = document.querySelector('.container2');
        let w = document.querySelector('.container3');
        let z = document.querySelector('.fenetre_fermeture6');
        let u = document.querySelector('.fenetre_fermeture9');
        x.addEventListener('click', () =>{
            y.style.display = 'block';
        })
        v.addEventListener('click', () =>{
            w.style.display = 'block';
        })
        z.addEventListener('click', () =>{
            y.style.display = 'none';
        })
        u.addEventListener('click', () =>{
            w.style.display = 'none';
        })
   </script>
   


   
</body>
</html>
<?PHP 
}
else
{
   header('Location: index.php');
}
?>