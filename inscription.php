<?PHP
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=kjadi_ing_membres','kjadi_ing_membres','Maroc-2023');
include('controls/validation_inscription.php');
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
			<div  class="inscription_div">
				<h3 class="titre1">Inscription</h3>
			</div>
			<form action="" method="post" class="inscription_formulaire">
				<div style="width:100%">
					<label for="prenom" style="background-color:beige">Prenom</label>
					<input type="text" name="prenom" id="prenom" value="<?php if (isset($prenom)) { echo $prenom;}?>">
				</div>
				<div style="width:100%">
					<label for="nom" style="background-color:beige">Nom</label>
					<input type="text" name="nom" id="nom" value="<?php if (isset($nom)) { echo $nom;}?>">
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
				<div style="width:100%">
					<label for="ecole" style="background-color:beige">Ecole</label>
					<select name="ecole" id="ecole">
						<option value=""></option>
						<option value="EMI">EMI</option>
						<option value="ENSIAS">ENSIAS</option>
						<option value="ENIM">ENIM</option>
						<option value="EHTP">EHTP</option>
						<option value="INSEA">INSEA</option>
						<option value="ENSEM">ENSEM</option>
						<option value="INPT">INPT</option>
						<option value="IAV">IAV</option>
						<option value="ESITH">ESITH</option>
						<option value="ERN">ERN</option>
						<option value="AIAC">AIAC</option>
						<option value="ESI">ESI</option>
						<option value="ENA_MEKNES">ENA MEKNES</option>
						<option value="ENSAM_CASA">ENSAM CASA</option>
						<option value="ENSAM_MEKNES">ENSAM MEKNES</option>
						<option value="ENSAM_FRANCE">ENSAM FRANCE</option>
						<option value="INSA_FRANCE">INSA FRANCE</option>
						<option value="ENSI_FRANCE">ENSI FRANCE</option>
						<option value="ENTPE_FRANCE">ENTPE FRANCE</option>
						<option value="CENTRALE_FRANCE">CENTRALE FRANCE</option>
						<option value="INP_FRANCE">INP FRANCE</option>
						<option value="ESTP_FRANCE">ESTP FRANCE</option>
						<option value="X_FRANCE">X FRANCE</option>
						<option value="MINES_TELECOM_FRANCE">MINES TELECOM FRANCE</option>
						<option value="PARISTECH_FRANCE">PARISTECH FRANCE</option>
						<option value="CNAM_FRANCE">CNAM FRANCE</option>
						<option value="ENIB_FRANCE">ENIB FRANCE</option>
						<option value="POLYTECH_FRANCE">POLYTECH FRANCE</option>
						<option value="EFREI_FRANCE">EFREI FRANCE</option>
						<option value="POLYTECH_LAUSANNE">POLYTECH LAUSANNE</option>
						<option value="POLYTECH_MONTREAL">POLYTECH MONTREAL</option>
						<option value="POLYTECH_MADRID">POLYTECH MADRID</option>
						<option value="UNIV_LAVAL">UNIV LAVAL</option>
						<option value="UNIV_LEICESTER">UNIV LEICESTER</option>
						<option value="UNIV_NY">UNIV NY</option>
						<option value="PERDUE_UNIVERSITY US">PERDUE UNIVERSITY US</option>
						<option value="FLORIDA_TECH">FLORIDA TECH</option>
						<option value="UDS_CA">UDS CA</option>
						<option value="LAVAL_CA">LAVAL CA</option>
						<option value="TU_BRAUNSCHWEIG_DE">TU Braunschweig DE</option>
						<option value="UN_ANTWERPEN_BE">UN ANTWERPEN BE</option>
					</select>
				</div>
				<div style="width:100%">
					<label for="promotion" style="background-color:beige">Promotion</label>
					<select name="promotion" id="promotion">
					<option value=""></option>
					<?PHP 
					for($i=2026;$i>=1976;$i--){
						echo ' <option value="'.$i.'">'.$i.'</option>';
					}
					?>
					</select>
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