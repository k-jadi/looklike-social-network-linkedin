<?PHP 
session_start();
$html_div_recherche = "";
$html_nbre_resultat_recherche = 0;

$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

$texte_recherche = trim($_POST['recherche_membres_input']);
    if(isset($texte_recherche) && !empty($texte_recherche)){
        $words = explode(' ',$texte_recherche);
        $champs =['prenom','nom','ecole','promotion'];
        $kw ="";
        for($j=0;$j<count($champs);$j++){
            for($i=0;$i<count($words);$i++){
                $kw .= " ".$champs[$j]." like '%".$words[$i]."%' OR ";
            }
        }
        $recherche_membres = $bdd->prepare("SELECT * FROM coordonnees_membres WHERE ".$kw." prenom like 'cbhdnzpfjd' ORDER BY id DESC");
        $recherche_membres->execute();
        $tab = $recherche_membres->rowCount();
        if ($tab == 0) {
            $html_div_recherche .= 'Aucun résultat !';
        }
        else {
            while($x = $recherche_membres->fetch()){
            if ($x['interlocuteur'] == ''){
            $html_div_recherche .=
            '
            <a href="profil.php?id='.$x['id'].'
            "><div style="width : 90%;padding:10px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                <div style="width : 80%;display:inline-block;padding:10px;">'.
                $x['prenom'].' '.$x['nom'].'<br>'.
                'Ingénieur '.$x['ecole'].', promo '.$x['promotion'].'</div>
                <div style="width : 19%;display:inline-block;border-left: 1px dotted #cabcbc;">
                <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$x['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                </div>
            </div>
            </a>'
            ;
        }else {
            $html_div_recherche .=
            '
            <a href="profil.php?id='.$x['id'].'
            "><div style="width : 90%;padding:10px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
                <div style="width : 80%;display:inline-block;padding:10px;">'.
                $x['prenom'].' '.$x['nom'].'<br>'.
                'Recruteur</div>
                <div style="width : 19%;display:inline-block;border-left: 1px dotted #cabcbc;">
                <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$x['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
                </div>
            </div>
            </a>'
            ;
        }
        }
        }
        
    }
$texte_recherche_phone = trim($_POST['recherche_membres_input_phone']);
    if(isset($texte_recherche_phone) && !empty($texte_recherche_phone)){
        $words2 = explode(' ',$texte_recherche_phone);
        $champs2 =['prenom','nom','ecole','promotion'];
        $kw2 ="";
        for($j2=0;$j2<count($champs2);$j2++){
            for($i2=0;$i2<count($words2);$i2++){
                $kw2 .= " ".$champs2[$j2]." like '%".$words2[$i2]."%' OR ";
            }
        }
        $recherche_membres2 = $bdd->prepare("SELECT * FROM coordonnees_membres WHERE ".$kw2." prenom like 'cbhdnzpfjd'ORDER BY id DESC ");
        $recherche_membres2->execute();
        $tab2 = $recherche_membres2->rowCount();
        if ($tab2 == 0) {
            $html_div_recherche .= 'Aucun résultat !';
        }
        else {
            while($x2 = $recherche_membres2->fetch()){
            if ($x2['interlocuteur'] == ''){
            $html_div_recherche .=
            '
            <a href="profil.php?id='.$x2['id'].'
            "><div style="width : 100%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
            <div style="width : 75%;display:inline-block;padding:10px;">
            <p style="font-size:0.8rem;">'.
            $x2['prenom'].' '.$x2['nom'].'<br>'.
            'Ingénieur '.$x2['ecole'].', promo '.$x2['promotion'].'
            </p>
            </div>
            <div style="width : 23%;display:inline-block;border-left: 1px dotted #cabcbc;">
            <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$x2['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
            </div>
            </div>
            </a>'
            ;
            }else {
            $html_div_recherche .=
            '
            <a href="profil.php?id='.$x2['id'].'
            "><div style="width : 100%;padding:5px;border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:5px;margin:5px;">
            <div style="width : 75%;display:inline-block;padding:10px;">
            <p style="font-size:0.8rem;">'.
            $x2['prenom'].' '.$x2['nom'].'<br>'.
            'Recruteur
            </p>
            </div>
            <div style="width : 23%;display:inline-block;border-left: 1px dotted #cabcbc;">
            <p style="width:100%;height:100%;text-align: center;"><img src="membres/avatar/'.$x2['avatar'].'" alt="photo de profil" width=50% style="border-radius:50%"></p>
            </div>
            </div>
            </a>'
            ;
            }

        }
        }
        
    }

$res = ["div_resultats" => $html_div_recherche];
echo json_encode($res);


