<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

$get_id = intval($_GET['id']);
$req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
$req_user->execute(array($get_id));
$user_info = $req_user->fetch();

if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] AND $user_info['interlocuteur'] == '' )
{
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <title>Ing.</title>
</head>
<body>
   <!-- Le Header ************************************************ -->
   <div class="barre_lateral" id="barre_lateral">
      <?PHP include('slidelayer_phone.php'); ?>
   </div>

   <header id="header_sans_barre_recherche">
      <h1>Ing.</h1>
      <div id="avatar">
         <?PHP
            if(!empty($user_info['avatar']))
            {
                  ?>
                     <img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default2">
                  <?PHP 
            }
         ?>
      </div>
      <ul id="header_emploi">
         <li style="display:flex;align-items:center;justify-content:center;"><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-house"></i><span>Acceuil</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="mon_reseau.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-user-group"></i><span>Réseau</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-briefcase"></i><span>Emploi</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book" style="color: rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);">Bibliothèque</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book-bookmark"></i><span>Pfe</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-store"></i><span>Ing Mall</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="deconnexion.php"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-right-from-bracket"></i><span>Quitter</span></div></a></li>
      </ul>
      <div style="width: 85%;text-align:right;" id="biblio_10000">
        <span><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><img src="imgindex/fleche_retour.png" alt="bouton_retour" style="width: 28px;vertical-align:middle;"></a></span>
      </div> 
   </header>


   <div class="barreVide"></div>



   <!-- NEW WRAPPER ************************************************************ -->
   <div class="topBibliothequeMenu">
      <h3 style="background-color: #000; color:#fff">Disciplines</h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/index-bibliotheque.php')">Acceuil</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment1.php')">Bâtiment I</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment2.php')">Bâtiment II</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment3.php')">Bâtiment III</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/fin-eco.php')">Finances-Eco</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/industrie.php')">Industrie</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise1.php')">Gestion I</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise2.php')">Gestion II</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise3.php')">Gestion III</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/agriculture.php')">Agriculture</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/informatique.php')">Informatique</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/web-design.php')">Web-Design</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/maths1.php')">Maths I</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/maths2.php')">Maths II</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/multitechniques.php')">Multitech.</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/phy-chi.php')">Phy/Chi</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/pb-st.php')">Pb/St</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/res-tel.php')">Res/Tel</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/langues.php')">Langues</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/arts-techniques.php')">Arts Tech.</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','biblio/sports.php')">Sports</a></h3>
   </div>
   <div class="wraper" style="height:80vh;">
      <div class="bibliotheque"> 
         <iframe id="mainFrame" width="100%" height="100%" src="biblio/index-bibliotheque.php" frameborder="0"></iframe>
      </div>
      <div class="bibliothequeMenu">
         <div class="inBibliothequeMenu">
            <h3 style="background-color: #000; color:#fff">Disciplines</h3>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/index-bibliotheque.php')">
            <a href="#"  target="_top" style="text-decoration:none; color:#afafaf;"><h3>Acceuil</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment1.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Bâtiment I</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment2.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Bâtiment II</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/batiment3.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Bâtiment III</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/fin-eco.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Finances-Eco</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/industrie.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Industrie</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise1.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Gestion I</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise2.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Gestion II</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/entreprise3.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Gestion III</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/agriculture.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Agriculture</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/informatique.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Informatique</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/web-design.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Web-Design</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/maths1.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Maths I</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/maths2.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Maths II</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/multitechniques.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Multitechniques</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/phy-chi.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Phy/Chi</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/pb-st.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Pb/St</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/res-tel.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Res/Tel</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/langues.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Langues</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/arts-techniques.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Arts Techniques</h3></a>
            </div>
            <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','biblio/sports.php')">
            <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>Sports</h3></a>
            </div>
         </div>
      </div>
   </div>

   <!-- NEW WRAPPER ************************************************************ -->
   <footer id="footer_index">
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>



   <script src="js/script_barre_lateral.js"></script>


</body>
</html>
<?PHP
}
else
{
   header('Location: index.php');
}
?>
