<?PHP

if (isset($_POST['valider_inscription']))
{
	$prenom = htmlspecialchars($_POST['prenom']);
	$interlocuteur = htmlspecialchars($_POST['interlocuteur']);
	$email = htmlspecialchars($_POST['email']);
	$reemail = htmlspecialchars($_POST['reemail']);
	$ecole = htmlspecialchars($_POST['ecole']);
	$promotion = htmlspecialchars($_POST['promotion']);
	$question = htmlspecialchars($_POST['question']);
	$mdp = htmlspecialchars($_POST['passWord']);
	$passWord = sha1($_POST['passWord']);
	$rePassWord = sha1($_POST['rePassWord']);

	$prenomlenght = strlen($prenom);

	$_SESSION['interlocuteur'] = $interlocuteur;
	$_SESSION['prenom'] = $prenom;


	if(!empty($_POST['prenom']) AND !empty($_POST['interlocuteur']) AND !empty($_POST['email']) AND !empty($_POST['passWord']) AND !empty($_POST['rePassWord']))
	{
		if ($prenomlenght <= 255)
		{
			$nomlenght = strlen($interlocuteur);
			if ($nomlenght <= 255)
			{
				if (filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$reqemail = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE email = ?');
					$reqemail->execute(array($email));
					$email_exist = $reqemail->rowCount();
					if($email_exist == 0)
					{
						if ($passWord == $rePassWord)
						{
							$_SESSION['connexion'] = true;
							$insert_membre = $bdd->prepare('INSERT INTO coordonnees_membres(prenom, email, mdp, motdepass, avatar, interlocuteur) VALUES(?,?,?,?,?,?)' );
							$insert_membre->execute(array($prenom,$email,$mdp, $passWord,"avatar_default_recruteur.png",$interlocuteur));
							header('Location: connexion_reussie_recruteur.php');

						}
						else
						{
							$erreure = 'Erreur : Vos mots de pass ne correspondent pas !';
						}
					}
					else
					{
						$erreure = 'Erreure : Email déjà existant';
					}
				}
				else
				{
					$erreure = 'Erreure : Votre adresse Email n\'est pas valide ! ';
				}
			}
			else
			{
				$erreure = 'Erreure Votre nom d\'interlocuteur ne doit pas dépasser 255 caractères !';
			}
		}
		else
		{
			$erreure = 'Erreure Votre nom d\'enseigne ne doit pas dépasser 255 caractères !';
		}

	}
	else
	{
		$erreure ='Erreure : Tous les champs doivent être complété !';
	}
}

?>