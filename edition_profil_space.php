<!-- // Espace edition du profil *********************************************** -->
    <div class="ente_mobile2">
    <h2>Editer mon profil</h2>
    </div>

    <?PHP 
            if ($user_info['interlocuteur'] != ''){
        ?>
    <section class="autresNews">
        <div>
            <p><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Changer ma photo de profil ( Taille max : 2Mo ) :</p>
            <div class="petit_synopsis">
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="width:100%; text-align:left;">
                        <input type="file" name="edition_profil_photo" id="edition_profil_photo">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_profil_photo" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message3)) 
                                {
                                    echo $message3;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
                <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Editer mon contact telephonique :</p>
                <div class="petit_synopsis">
                <form action="" method="post">
                        <div style="width:100%; text-align:left;">
                            <!-- <label for="phone">Entrer mon numero de Tél : &nbsp &nbsp &nbsp </label> -->
                            <input type="tel" id="phone" name="phone" placeholder=" ..." style="border: 1px dotted rgba(105, 105, 105, 0.7);">
                        </div>
                        <div style="width:25%; text-align:right; display:inline-block;">
                            <input type="submit" value="Editer" name="edition_submit_phone" id="button" style="background-color:beige">
                        </div>
                        <div style="width:72%; text-align:left; display:inline-block;">
                            <p style="color:orange;">
                                <?PHP
                                    If (isset($message7)) 
                                    {
                                        echo $message7;
                                    }
                                ?>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <section class="autresNews">
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Changer mon adresse Email :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <input type="email" name="edition_email" id="edition_email" placeholder="Entrez la nouvelle adresse email !" style="width:100%;border: 1px dotted rgba(105, 105, 105, 0.8); border-radius: 5px; padding: 5px 5px;">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="edition_submit" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message)) 
                                {
                                    echo $message;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <p><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Changer mon mot de passe :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <input type="text" name="edition_motdepasse" id="pass_edition" placeholder="Entrez le nouveau mot de passe !" style="width:100%;border: 1px dotted rgba(105, 105, 105, 0.8); border-radius: 5px; padding: 5px 5px;">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_motdepasse" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message2)) 
                                {
                                    echo $message2;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="autresNews">
        <div  style="width: 100%;">
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Fiche recruteur</p>
            <div class="petit_synopsis_mes_experiences_pro">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <textarea  name="fiche_recruteur" required id="fiche_recruteur" rows="18" placeholder="Entrez les informations vous concernant  ..." maxlength="500" style="font-size:0.6rem;width:100%;padding: 5px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;"></textarea><br>
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;margin:0;padding:0px">
                        <input type="submit" value="Editer" name="envoi_fiche_recruteur" id="button" style="background-color:beige;">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message_fiche_recruteur)) 
                                {
                                    echo $message_fiche_recruteur;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?PHP 
            }    
        ?>

    <?PHP 
            if ($user_info['interlocuteur'] == ''){
        ?>
    <section class="autresNews">
        <div>
            <p><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Photo de profil ( Format carré / Taille max : 2Mo ) :</p>
            <div class="petit_synopsis">
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="width:100%; text-align:left;">
                        <input type="file" name="edition_profil_photo" id="edition_profil_photo">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_profil_photo" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message3)) 
                                {
                                    echo $message3;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        
        
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Editer mon génie :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <label for="genie">Choisir mon génie : &nbsp &nbsp &nbsp </label>
                        <select name="edition_genie" id="genie">
                            <option value=""></option>
                            <option value="Industriel">Industriel</option>
                            <option value="Civil">Civil</option>
                            <option value="Informatique">Informatique</option>
                            <option value="Minéral">Minéral</option>
                            <option value="Electrique">Electrique</option>
                            <option value="Mécanique">Mécanique</option>
                            <option value="Naval">Naval</option>
                            <option value="Aérobautique">Aéronautique</option>
                            <option value="Agronome">Agronome</option>
                            <option value="Procédés">Procédés</option>
                            <option value="Data Science">Data Science</option>
                            <option value="Actuariat">Actuariat</option>
                            <option value="Statistique">Statistique</option>
                        </select>
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="edition_submit_genie" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message6)) 
                                {
                                    echo $message6;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <section class="autresNews">
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Uploader mon CV ( PDF, Taille max : 5Mo ) :</p>
            <div class="petit_synopsis">
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="width:100%; text-align:left;">
                        <input type="file" name="edition_profil_cv" id="edition_profil_cv" accept=".pdf">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_profil_cv" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message4)) 
                                {
                                    echo $message4;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Uploader mon PFE ( PDF, Taille max : 20Mo ) :</p>
            <div class="petit_synopsis">
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="width:100%; text-align:left;">
                        <input type="file" name="edition_profil_pfe" id="edition_profil_pfe" accept=".pdf">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_profil_pfe" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message5)) 
                                {
                                    echo $message5;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="autresNews">
    <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Editer mon numéro WhatsApp :</p>
            <div class="petit_synopsis">
            <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <label for="phone">Entrer mon whatsApp : &nbsp &nbsp &nbsp </label>
                        <input type="tel" id="phone" name="phone" style="border: 1px dotted rgba(105, 105, 105, 0.7);">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="edition_submit_phone" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message7)) 
                                {
                                    echo $message7;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Editer mes domaines d'expertise :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <textarea  name="texte_competences" required id="texte_competences" rows="2" placeholder="Expression libre / Uitilsez des mots clés ..." maxlength="250" style="font-size:0.6rem;width:100%;padding: 5px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;"></textarea><br>
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;margin:0;padding:0px">
                        <input type="submit" value="Editer" name="competences" id="button" style="background-color:beige;">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message12)) 
                                {
                                    echo $message12;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="autresNews">
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Mes expériences PRO</p>
            <div class="petit_synopsis_mes_experiences_pro">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <textarea  name="texte_mes_experiences_pro" required id="texte_mes_experiences_pro" rows="18" placeholder="Expression libre / Soyez bref et concis  ..." maxlength="500" style="font-size:0.6rem;width:100%;padding: 5px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;"></textarea><br>
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;margin:0;padding:0px">
                        <input type="submit" value="Editer" name="experiences_pro" id="button" style="background-color:beige;">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message_experiences_pro)) 
                                {
                                    echo $message_experiences_pro;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Mes réalisations PRO</p>
            <div class="petit_synopsis_mes_experiences_pro">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <textarea  name="texte_mes_realisations_pro" required id="texte_mes_realisations_pro" rows="18" placeholder="Expression libre / Soyez bref et concis  ..." maxlength="1000" style="font-size:0.6rem;width:100%;padding: 5px; border: 1px dotted rgba(105, 105, 105, 0.7); border-radius:5px;"></textarea><br>
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;margin:0;padding:0px">
                        <input type="submit" value="Editer" name="experiences_pro" id="button" style="background-color:beige;">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message_realisations_pro)) 
                                {
                                    echo $message_realisations_pro;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>


    
    <section class="autresNews">
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Changer mon adresse Email :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <input type="email" name="edition_email" id="edition_email" placeholder="Entrez la nouvelle adresse email !" style="width:100%;border: 1px dotted rgba(105, 105, 105, 0.8); border-radius: 5px; padding: 5px 5px;">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="edition_submit" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message)) 
                                {
                                    echo $message;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <p><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Changer mon mot de passe :</p>
            <div class="petit_synopsis">
                <form action="" method="post">
                    <div style="width:100%; text-align:left;">
                        <input type="text" name="edition_motdepasse" id="pass_edition" placeholder="Entrez le nouveau mot de passe !" style="width:100%;border: 1px dotted rgba(105, 105, 105, 0.8); border-radius: 5px; padding: 5px 5px;">
                    </div>
                    <div style="width:25%; text-align:right; display:inline-block;">
                        <input type="submit" value="Editer" name="submit_motdepasse" id="button" style="background-color:beige">
                    </div>
                    <div style="width:72%; text-align:left; display:inline-block;">
                        <p style="color:orange;">
                            <?PHP
                                If (isset($message2)) 
                                {
                                    echo $message2;
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    
    <section class="autresNews">
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Autre</p>
            <div class="petit_synopsis">
                                <p>(en cours)</p>
            </div>
        </div>
        <div>
            <p class="petit_titre"><i class="fa fa-circle" style="font-size:10px;font-weight:bolder;color:red"></i> &nbsp Autre</p>
            <div class="petit_synopsis">
                                <p>(en cours)</p>
            </div>
        </div>
    </section>
    <?PHP 
        }    
    ?>
         