<?PHP
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
include('controls/validation_inscription_recruteur.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="imgindex/favicon.png" type="image/png" />
	<link rel="stylesheet" href="css/style.css">
	<script src="script.js" async></script>
	<title>Ing</title>
</head>
<body>
<!-- Header ******************************************************* -->
	<?php include("header_inscription.php"); ?>

<!-- Barre Vide ******************************************************* -->
   <div class="barreVide_connexion"></div>


	<div class="inscription_container">
			<div class="inscription_div" >
				<h3 class="titre1">Inscription</h3>
			</div>
			<form action="" method="post" class="inscription_formulaire">
				<div style="width:100%">
					<label for="enseigne" style="background-color:beige">Enseigne</label>
					<input type="text" name="prenom" id="prenom" value="<?php if (isset($prenom)) { echo $prenom;}?>">
				</div>
				<div style="width:100%">
					<label for="interlocuteur" style="background-color:beige">Interlocuteur</label>
					<input type="text" name="interlocuteur" id="interlocuteur" value="<?php if (isset($interocuteur)) { echo $interocuteur;}?>">
				</div>
				<div style="width:100%">
					<label for="email" style="background-color:beige">Email</label>
					<input type="email" name="email" id="email" value="<?php if (isset($email)) { echo $email;}?>">
				</div>
				<div style="width:100%">
					<label for="passWord" style="background-color:beige">Pass</label>
					<input type="password" name="passWord" id="pâssWord">
				</div>
				<div style="width:100%">
					<label for="rePassWord" style="background-color:beige">Retype Pass</label>
					<input type="password" name="rePassWord" id="rePâssWord">
				</div>
				<div style="width:100%; text-align:right">
					<input type="submit" value="S'inscrire" name="valider_inscription" id="button" style="background-color:beige">
				</div>
			</form>
			<p style="font-size: 12px;color:red;">
				<?PHP
					If (isset($erreure)) 
					{
						echo $erreure;
					}
				?>
			</p>
			<p style="font-size: 12px;color:green;">
				<?PHP
					If (isset($message)) 
					{
						echo $message;
					}
				?>
			</p>
	</div>
	<footer>
      <p>Ing. 2024 ::: Communauté des Ingénieurs du Maroc</p>
   </footer>
</body>
</html>