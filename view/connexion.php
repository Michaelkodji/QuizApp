<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="./public/ui.css" />
	</head>
	<body>
		<div id="shadow"></div>
		<div id="box">
			<h1>Panneau de contrôle</h1>
			<div>
				<div>Bienvenue sur le panneau de controle de l'editeur de question à choix multiple. </div>
				<div>
					<form method="post" action="index.php?condition=control_login" >
						<?=$notice ?>
						<input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" style="width:400px;" required /><br />
						<input type="password" id="pwd" name="pwd" placeholder="Mot de passe" style="width:400px;" required /><br />
						<input type="submit" name="btn" value="connexion" />
					</form>
				</div>
			</div>
			<p><a>mot de passe oublié ? &nbsp; | &nbsp; </a><a href="index.php?condition=control_signup">Nouveau ! créez un compte</a></p>
		</div>
	</body>
</html>