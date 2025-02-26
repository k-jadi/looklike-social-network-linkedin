<!-- // entete *********************************************** -->
    <div class="ente_mobile">
    <h2>Liste Membres</h2>
    </div>
         
<!-- // les membres *********************************************** -->
<div class="cadre_membres">
    <?PHP
        while ($liste_membres = $inscrits->fetch()) {
            ?>
            <div style="width:100%;border: 1px dotted #cabcbc;margin:10px auto">
                <div style="width : 89%;display:inline-block;">
                <?PHP echo $liste_membres['prenom']." ".$liste_membres['nom']; ?> <br>
                Ingénieur <?PHP echo $liste_membres['ecole']; ?>, promotion <?PHP echo $liste_membres['promotion']; ?>

                <br>
                </div>
                <div style="width : 10%;display:inline-block;border-left: 1px dotted #cabcbc;">
                <img src="membres/avatar/<?PHP echo $liste_membres['avatar'] ?>" alt="photo de profil" width=80% style="border-radius:50%">
                </div>
            </div>
        <?PHP
        }
    ?>
</div>
