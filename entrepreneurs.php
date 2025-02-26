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
<html lang="fr">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
   <link rel="stylesheet" href="css/style_profil.css">
   <link rel="icon" href="imgindex/favicon.png" type="image/png" />
   
   <title>Ing.</title>
</head>
<body>
   <!-- Le Header ************************************************ -->
   <header>
      <h1>Ing.</h1>
      <div>
         <div  style="display:flex;align-items:center;justify-content:left;background-color:#fff;width:95%;padding:0px 10px;border-radius:5px;">
            <i class="fa-solid fa-magnifying-glass" style="color: #000;font-size:1rem;width:13%;"></i>
            <input type="search" placeholder="Recherche" name="recherche_membres_input" id="recherche_membres_input" style="width: 85%; height:30px;border-radius:5px;border:none;outline:none;padding:0px 5px;">
         </div>
      </div>
      <div id="avatar">
         <?PHP
            if(!empty($user_info['avatar']))
            {
                  ?>
                     <img src="membres/avatar/<?php echo $user_info['avatar'];  ?>" id="avatar_default2">
                  <?PHP 
            }
         ?>
      <!-- <img src="imgindex/avatar_default.png" alt="avatar_default" id="avatar_default2"> -->
      <span id="menuText"><?PHP echo '  '.$_SESSION['prenom']. ' '; ?></span>
   </div>
      <ul>
         <li><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>">Acceuil</a></li>
         <li><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>">Bibliothèque</a></li>
         <li><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>">PFE</a></li>
         <li><a href="#"  class="highlight">Entrepreneurs</a></li>
         <li><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>">Emploi</a></li>
         <li><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>">Centrale-Achats</a></li>
         <li><a href="deconnexion.php"><i class="fa-solid fa-right-from-bracket" style="color:rgb(123, 226, 64);font-size:1.5rem;"></i></a></li>
      </ul>
      <div id="menu_open" class="initial">
         <svg width="30" height="30">
            <path d="M0,5 30,5" stroke="#fff" stroke-width="3"/>
            <path d="M0,14 30,14" stroke="#fff" stroke-width="3"/>
            <path d="M0,23 30,23" stroke="#fff" stroke-width="3"/>
         </svg>
      </div>
   </header>
   <div class="barreVide"></div>
   

   <div class="modalContainer2">
      <div class="modal2">
         <h1>FLUIDEA</h1>
         <h2>Entreprise d'études et réalisations des travaux de fluides ...</h2>
         <h3>Entrepreneur : Zouhir BOUDLAL, Ingénieur EMI.</h3>
         
         <div class="modalScroll2">
            <hr>
            <section>
               <p><u>SARL AU</u> <br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspCapital social : 3.000.000,00 DHS<br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate de création : 2011</p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Domaines de compétences</u> :</p>
               <ul>
                  <li>Climatisation / Ventilation / Désenfumage / Chauffage</li>
                  <li>Plomerie / Sécurité Incendie / Sprinklage</li>
                  <li>Piscines</li>
               </ul>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Références</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspBanque populaire, ATW, KITEA, INTELCIA, COMDATA ... et bien d'autres<br>
               </p>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Dossier commercial</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTéléchargez le dossier commercial en cliquant ... <a href="http://www.ingenieursdumaroc.com/dossier_commercial_fluidea.pdf" style="text-decoration: none;" target="_blank"><span style="color:red; font-weight:bold">ICI</span></a><br>
               </p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Coordonnées</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdresse : 19, RUE AMAR RIFFI, Mersultan, Casablanca<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTEL: 05 22 30 17 79 / FAX: 05 22 30 17 76<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspEMAIL: fluidea.sarl@gmail.com
               </p>
            </section>
            <br>
            <hr>
         </div>
         <span class="closeModal2">X</span>
      </div>
   </div>

   <div class="modalContainer3">
      <div class="modal3">
         <h1>INIDEV</h1>
         <h2>Entreprise Générale de Bâtiment ...</h2>
         <h3>Entrepreneur : Abdelali Bchaiker, Ingénieur EMI.</h3>
         
         <div class="modalScroll3">
            <hr>
            <section>
               <p><u>SARL AU</u> <br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspCapital social : 500.000,00 DHS<br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate de création : 2010</p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Domaines de compétences</u> :</p>
               <ul>
                  <li>Génie Civil / Gros Oeuvres</li>
                  <li>Second Oeuvres</li>
                  <li>Etudes / TCE</li>
               </ul>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Références</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspALLIANZ, WALILI RESIDENCE, MOVENPIK, OCP, MOROCCO MALL ... et bien d'autres<br>
               </p>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Dossier commercial</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTéléchargez le dossier commercial en cliquant ... <a href="http://www.ingenieursdumaroc.com/dossier_commercial_inidev.pdf" style="text-decoration: none;" target="_blank"><span style="color:red; font-weight:bold">ICI</span></a><br>
               </p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Coordonnées</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdresse : Ichrak Business Center – Imm 29 – Bur N°30 Rte d’El Jadida – Lissasfa.<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTel : +212 5 22 09 02 83 Fax : +212 5 22 09 02 15<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspEMAIL: contact@inidev.ma
               </p>
            </section>
            <br>
            <hr>
         </div>
         <span class="closeModal3">X</span>
      </div>
   </div>

   <div class="modalContainer4">
      <div class="modal4">
         <h1>Premium Accounting Services</h1>
         <h2>Cabinet de conseil fiscal & Juridique ...</h2>
         <h3>Entrepreneur : KHALIL GHAZALI, Ingénieur EHTP.</h3>
         
         <div class="modalScroll4">
            <hr>
            <section>
               <p><u>SARL</u> <br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspCapital social : 550.000,00 DHS<br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate de création : 2010</p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Domaines de compétences</u> :</p>
               <ul>
                  <li>Le secrétariat fiscal et/ou Juridique</li>
                  <li>L’audit fiscal</li>
                  <li>L’assistance à l'occasion d'un contrôle ou d'un contentieux fiscal</li>
               </ul>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Références</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspSEWS CABINED, CAFES DU BOIS, TETRAPAK, COLGATE MAROC ... et bien d'autres<br>
               </p>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Dossier commercial</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTéléchargez le dossier commercial en cliquant ... <a href="http://www.ingenieursdumaroc.com/dossier_commercial_pas.pdf" style="text-decoration: none;" target="_blank"><span style="color:red; font-weight:bold">ICI</span></a><br>
               </p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Coordonnées</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdresse : 59 Bd Zerktouni 5ème étage, Appt n° 15, Casablanca<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTél/Fax: 05 22 200 928<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspEMAIL: gha_kha@hotmail.com
               </p>
            </section>
            <br>
            <hr>
         </div>
         <span class="closeModal4">X</span>
      </div>
   </div>

   <div class="modalContainer5">
      <div class="modal5">
         <h1>Atlantic Bureau</h1>
         <h2>Mobilier de Bureau ...</h2>
         <h3>Entrepreneur : MOHAMED BEZZAZ, Ingénieur EMI.</h3>
         
         <div class="modalScroll5">
            <hr>
            <section>
               <p><u>SARL</u> <br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspCapital social : 1.000.000,00 DHS<br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbspDate de création : 2015</p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Domaines de compétences</u> :</p>
               <ul>
                  <li>Mobilier de bureau </li>
                  <li>Comptoir d'acceuil / Salle de réunion / Bureau direction</li>
                  <li>Bureau collaborateur / Rangement / Chaises</li>
               </ul>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Références</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAUDA, LES ECO, AKD, LEAR CORPORATION,  ... et bien d'autres<br>
               </p>
               <br>
            </section>
            <hr>
            <section>
               <p><u>Dossier commercial</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTéléchargez le dossier commercial en cliquant ... <a href="http://www.ingenieursdumaroc.com/dossier_commercial_atlantic_bureau.pdf" style="text-decoration: none;" target="_blank"><span style="color:red; font-weight:bold">ICI</span></a><br>
               </p>
            </section>
            <br>
            <hr>
            <section>
               <p><u>Coordonnées</u> :<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspAdresse : 57, Rue Abou AL Alaa Azzahar (EX Vesal),
                  Q. des Hopitaux Casablanca<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspTél. : +212 522 86 32 63 - Fax : +212 522 86 32 16<br>
                  &nbsp&nbsp&nbsp&nbsp&nbsp&nbspEMAIL: contact@atlanticbureau.ma
               </p>
            </section>
            <br>
            <hr>
         </div>
         <span class="closeModal5">X</span>
      </div>
   </div>

   
   <ul id="menu_deroulant">
      <li><a href="index_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F3E0;</span> Acceuil</a></li>
      <li><a href="edition_profil.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x2192;</span> Editer mon profil</a></li>
      <li><a href="bibliotheque.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;"   class="highlight">&#x1F4DA;</span> Ma bibliothèque</a></li>
      <li><a href="banque-pfe.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F4D4;</span> Mon receuil des PFE</a></li>
      <li><a href="entrepreneurs.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F477;</span> Mes amis entrepreneurs</a></li>
      <li><a href="emploi.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F4BC;</span> Emploi</a></li>
      <li><a href="ca.php?id=<?PHP echo $_SESSION['id']; ?>"><span style="font-size:1.1rem;">&#x1F9FA; </span> Ma centrale-achats</a></li>
      <li><span style="color:gray"><span style="font-size:1.1rem;">&#x1F465;</span> Membres :</span></li>
      <li><span style="color:gray;">&nbsp . Nombre d'inscrits : <?php echo $nombre_inscrits; ?></span></li>
      <?PHP if ($_SESSION['id'] == 23){ ?>
      <li><span style="color:gray;">&nbsp . Membres en ligne : <?php echo $membres_enligne; ?></span></li>
         <?PHP
         $membres_preinscrits = $bdd->query('SELECT * FROM coordonnees_membres WHERE confirmation=0');
         $membres_enattente = $membres_preinscrits->rowCount();
         ?>
         <li><span style="color:gray;">&nbsp . Membres en attente : <a href="membres_gestion.php?id=<?PHP echo $_SESSION['id']; ?>"><?php echo $membres_enattente; ?></a></span></li>
      <?PHP
      }
      ?>
      <li><a href="deconnexion.php">Déconnexion</a></li>
</ul>
    <!-- Le Corps de la page -->
      <div class="basDePage">
         <p>Bienvenu à l'espace entrepreneurs</p>
         <p>Ici ! Nous mettons en avant les ingénieurs qui ont choisi l'entrepreneuriat. </p>
         <p>Ci-dessous, vous pouvez découvrir leurs entreprises, leurs activités, télécharger leurs dossiers commercials et faire appel à leurs services !</p>
         <p>Pour figurer parmis les entrepreneurs ci-dessous, nous contacter par email : admin@ingenieursdumaroc.com</p>
      </div>
        <div class="ingSeriesTable">
            <div><img src="imgindex/fluidea.png" alt="FLUIDEA SARL AU" id="fluidea"></div>
            <div><img src="imgindex/inidev.png" alt="INIDEV SARL AU" id="inidev"></div>
            <div><img src="imgindex/cabinetpas.png" alt="CABINET PAS SARL" id="cabinetpas"></div>
            <div><img src="imgindex/atlanticbureau.png" alt="ATLANTIC BUREAU SARL" id="atlanticbureau"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
            <div><img src="imgindex/addanexpert.png" alt="An expert"></div>
        </div>
    <!-- NEW WRAPPER  -->
    
   <footer>
      <p>Ing. 2023 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>
   <script src="js/script_menu_deroulant.js"></script>
   <script src="js/script_entrepreneurs.js"></script>
</body>
</html>
<?PHP
}
else
{
   header('Location: index.php');
}
?>