<?PHP 
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');

// Création des variables utilisateur, inscrits et en ligne ***************************************
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="../css/style_profil.css">
    <title></title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
    </style>
</head>
<body style="overflow: hidden;">
    <div style="display:flex;flex-direction:column;width:100%;height:100vh;background-color:#fff;border: 1px dotted rgba(105, 105, 105, 0.2);">
        <div  style="padding:5px 10px;height:40px;border-bottom: 1px dotted rgba(105, 105, 105, 0.2);display:flex;align-items:center;justify-content:left;width:100%;">
            <i class="fa-solid fa-magnifying-glass" style="color: #000;font-size:1rem;width:13%;"></i>
            <form action="load_profiles.php?id=<?PHP echo $_SESSION['id']; ?>" method="POST" id="form_recherche" style="width: 85%;">
                <input type="search" onkeypress="return event.keyCode != 13;" placeholder="Selectionnez un destinataire ..." name="recherche_membres_input" id="recherche_membres_input" style="width: 100%; height:30px;border-radius:5px;border:none;outline:none;padding:0px 5px;">
            </form>
        </div>
        <div style="overflow: hidden;overflow-y:scroll;background-color:#fff;height:260px;" id="message_selection_destinataire">
        </div>
    </div>
    <script src="../js/script_barre_recherche_messagerie.js"></script>
</body>
</html>
<?PHP 
}
else
{
   header('Location: ../index.php');
}
?>