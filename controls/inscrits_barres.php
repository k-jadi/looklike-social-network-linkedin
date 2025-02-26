<?PHP  

echo '
    <style type="text/css" >
        @import url(\'https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap\');

        .container_inscrits_barres {
            position: relative;
            left: 50%;
            transform: translate(-50%,0%);
            max-width: 500px;
            width: 75%;
            background: #fff;
            margin: 10px 0px;
            padding: 0px;
            border-radius: 7px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px dotted rgba(105, 105, 105, 0.3);
            transition: all 5s ease-in-out;
        }

        .container_inscrits_barres .skill-box{
            width: 95%;
            margin: 10px 0;
        }

        .skill-box .title{
            display: block;
            padding-right:15px;
            font-size: 10px;
            font-weight: 600;
            text-align:right;
            color: #333;
        }

        .skill-box .skill-bar{
            height: 8px;
            width: 100%;
            border-radius: 6px;
            margin-top: 6px;
            background: rgba(0,0,0,0.1);
        }

        .skill-bar .skill-per{
            position: relative;
            display: block;
            height: 100%;
            width: 90%;
            border-radius: 6px;
            background: rgb(123, 226, 64);
            animation: progress 0.4s ease-in-out forwards;
            opacity: 0;
        }
';
$liste_ecoles = ["EMI", "ENSIAS", "ENIM", "EHTP", "INSEA", "ENSEM", "INPT", "IAV", "ESITH", "ERN", "AIAC","POLYTECH_FRANCE","ENSI_FRANCE","MINES_TELECOM_FRANCE","CNAM_FRANCE","ESTP_FRANCE","CENTRALE_FRANCE","PARISTECH_FRANCE","POLYTECH_MONTREAL","ENSAM_FRANCE"];
$delays = 0;
for($j=0; $j<20; $j++){

    $tous_les_membres = $bdd->query('SELECT * FROM coordonnees_membres');
    $nombre_total_membres = $tous_les_membres->rowCount();

    $membres_par_ecole = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE ecole=? ');
    $membres_par_ecole->execute(array($liste_ecoles[$j]));
    $nombre_membres_par_ecole = $membres_par_ecole->rowCount();

    $pourcentage = round(($nombre_membres_par_ecole/$nombre_total_membres)*100)+1;
    $delays += 0.1;
    echo '
        .skill-per.'.$liste_ecoles[$j].'{
            width: '.$pourcentage.'%;
            animation-delay: '.$delays.'s;
        }
    ';
}
   
echo '    
    @keyframes progress {
        0%{
            width: 0;
            opacity: 1;
        }
        100%{
            opacity: 1;
        }
    }
    .skill-per .tooltip{
        position: absolute;
        right: -14px;
        top: -28px;
        font-size: 9px;
        font-weight: 500;
        color: #fff;
        padding: 2px 6px;
        border-radius: 3px;
        background: rgb(123, 226, 64);
        z-index: 1;
    }
    .tooltip::before{
        content: \'\';
        position: absolute;
        left: 50%;
        bottom: -2px;
        height: 10px;
        width: 10px;
        z-index: -1;
        background-color: rgb(123, 226, 64);
        transform: translateX(-50%) rotate(45deg);

    }
</style>
';


?>