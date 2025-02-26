<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

include('controls/membres_enligne.php');

$inscrits = $bdd->query('SELECT * FROM coordonnees_membres');
$nombre_inscrits = $inscrits->rowCount();

if(isset($_GET['id']) AND $_GET['id'] == $_SESSION['id'] )
{
   $get_id = intval($_GET['id']);
   $req_user = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
   $req_user->execute(array($get_id));
   $user_info = $req_user->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
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
         <li style="display:flex;align-items:center;justify-content:center;border-left:1px dotted rgba(152, 152, 153, 0.8);padding-left:10px;"><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book"></i><span>Bibliothèque</span></div></a></li>
         <li style="display:flex;align-items:center;justify-content:center;"><a href="#"><div style="display:flex;flex-direction:column;align-items:center;justify-content:center;row-gap:3px;"><i class="fa-solid fa-book-bookmark" style="color: rgba(152, 152, 153, 0.8);"></i><span style="color: rgba(152, 152, 153, 0.8);">Pfe</span></div></a></li>
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
      <h3 style="background-color: #000; color:#fff">Pages</h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/index-banque-pfe.html')">Acceuil</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe1.html')">1</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe2.html')">2</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe3.html')">3</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe4.html')">4</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe5.html')">5</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe6.html')">6</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe7.html')">7</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe8')">8</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe9.html')">9</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe10.html')">10</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe11.html')">11</a></h3>
      <h3><a href="#" target="_top" style="text-decoration:none;  color:#000;"  onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe12.html')">12</a></h3>
   </div>
      <div class="wraper" style="height:80vh;">
         <div class="bibliotheque"> 
            <iframe id="mainFrame" width="100%" height="100%" src="pfe/index-banque-pfe.html" frameborder="0"></iframe>
         </div>
         <div class="bibliothequeMenu">
            <div class="inBibliothequeMenu">
               <h3 style="background-color: #000; color:#fff">Pages</h3>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/index-banque-pfe.html')">
               <a href="#"  target="_top" style="text-decoration:none; color:#afafaf;"><h3>Acceuil</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe1.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>1</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe2.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>2</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe3.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>3</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe4.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>4</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe5.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>5</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe6.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>6</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe7.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>7</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe8.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>8</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe9.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>9</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe10.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>10</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe11.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>11</h3></a>
               </div>
               <div width="100%" style="color:#afafaf; background-color:#f4f4f4; text-align:center;" onclick="document.getElementById('mainFrame').setAttribute('src','pfe/banque-pfe12.html')">
               <a href="#" target="_top" style="text-decoration:none;  color:#afafaf;"><h3>12</h3></a>
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