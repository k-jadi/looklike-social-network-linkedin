<div class="connexion_layer">
    <div style="height:70vh;display:flex;flex-direction:column;justify-content:center;align-items:center;">
        <h3 class="titre1">Connexion</h3>
        <form action="" method="post" class="formulaire">
            <div style="width:100%">
                <label for="email" style="background-color:beige">Email</label>
                <input type="email" name="email_connect" id="email">
            </div>
            <div style="width:100%">
                <label for="passWord" style="background-color:beige">Mot de passe</label>
                <input type="password" name="pass_word_connect" id="passWord">
            </div>
            <div style="width:100%; text-align:right">
                <input type="submit" value="Se connecter" name="button_connect" id="button" style="background-color:beige">
            </div>
            <span id="compteCreation"><a href="mot_de_passe_recup.php">Mot de passe oublié ?</a></span>
            <hr>
            <span id="compteCreation">Pas encore inscrit ? <a href="inscription.php" style="text-decoration: none;color:brown;">Créer un compte</a></span>
            <span id="compteCreation">Vous ête recruteur ? <a href="inscription_recruteur.php" style="text-decoration: none;color:rgba(247, 16, 151, 0.8);">Créer un compte recruteur</a></span>
        </form>
    </div>
    <p style="font-size: 12px;color:red;">
				<?PHP
					If (isset($erreure)) 
					{
						echo $erreure.'<br><br>';
					}
				?>
			</p>
</div>