<div class="sideLayer" style="border:none;">
    <h3 class="titre1 titre2">La communauté</h3>
    <div style="border:1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;margin-bottom:10px;background-color:rgba(105, 105, 105, 0.1);">
        <p class="source" style="cursor: pointer; border:none;margin-bottom:0px;" id="button_barres">
            Nombre d'inscrits : <?php echo $nombre_inscrits; ?>
            &nbsp <i class="fas fa-plus" id="icon2" ></i>
        </p>
        <div class="container_inscrits_barres" id="barres">
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
    <!-- <div style="min-height:50px;border:1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;margin-bottom:10px;background-color:rgba(105, 105, 105, 0.1);">
        <p class="source" style="cursor: pointer; border:none;margin-bottom:0px;" id="button_recruteurs">
            <?PHP /*
                $recruteurs = $bdd->query('SELECT * FROM coordonnees_membres WHERE interlocuteur != "" ORDER BY id DESC');
                $nombre_recruteurs = $recruteurs->rowCount(); */

            ?>
            Nos Ing-recruteurs : <?PHP // echo $nombre_recruteurs;  ?>
            &nbsp <i class="fas fa-plus" id="icon3" ></i>
        </p>
        <div  id="recruteurs">
            <?PHP  /*
            while ($liste_recruteurs = $recruteurs->fetch()) {
                echo '
                    <a href="profil.php?id='.$liste_recruteurs['id'].'" style="text-decoration:none;">
                  <div style="width: 99%;background-color:#fff;border:1px dotted rgba(105, 105, 105, 0.2);margin:5px 0px;">
                    '.$liste_recruteurs['prenom'].'
                  </div>
                  </a>

                ';
            } */
            ?>
        </div>
    </div>    -->
    <div style="border:1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;margin-bottom:10px;height:50px;background-color:rgba(105, 105, 105, 0.1);">
        <p class="source" style="cursor: pointer; border:none;margin-bottom:0px;" id="button_entreprises">
            <?PHP 
                $entreprises = $bdd->query('SELECT * FROM coordonnees_membres WHERE entreprise = "oui" ORDER BY id DESC');
                $nombre_entreprises = $entreprises->rowCount();

            ?>
            Nos Ing-entreprises : <?PHP echo $nombre_entreprises;  ?>
            &nbsp <i class="fas fa-plus" id="icon4" ></i>
        </p>
        <div  id="entreprises">
            <?PHP  
            while ($liste_entreprises = $entreprises->fetch()) {
                echo '
                    <a href="profil.php?id='.$liste_entreprises['id'].'" style="text-decoration:none;">
                  <div style="width: 99%;background-color:#fff;border:1px dotted rgba(105, 105, 105, 0.2);margin:5px 0px;">
                    '.$liste_entreprises['prenom'].'
                  </div>
                  </a>

                ';
            }
            ?>
        </div>
    </div>
    <div style="border:none;margin-bottom:10px;">
        <p>
            <img src="imgindex/intelligentsia.png" alt="intelligentsia" style="border-radius: 10px; width:100%;" >
        </p>
    </div>
</div>
