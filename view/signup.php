<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="./public/ui.css"/>
	</head>
	<body>
		<div id="shadow"></div>
		<div id="box">
			<h1>Inscription</h1>
			<div>
				<div>
					Lecture et validation des conditions d'utilisation
				</div>
				<div>
					<?=$notice ?>
					<form method="POST" action="index.php?condition=control_signup">
						<input type="text" id="name" name="name" placeholder="nom et prénom" style="width:432px;" required /><br />
						<input type="tel" id="phone" name="phone" placeholder="téléphone" required />
						<input type="email" id="mail" name="mail" placeholder="courriel" required /><br />
						<input type="password" id="pwd" name="pwd" placeholder="Mot de passse" required />
						<input type="password" id="confirm" name="confirm" placeholder="Confirmation" required /><br />
						<input type="checkbox" name="condition" id="condition" value="enabled" onClick="condition_enabled()" style="width:0px;" required /> 
						Cochez si vous avez lu et pour valider des conditions d'utilisation<br />
						<input type="submit" name="btn" id="button" value="inscription" disabled />
					</form>
				</div>
			</div>
			<p><a>mot de passe oublié ? &nbsp; | &nbsp; </a><a href="index.php?condition=control_login">accéder à mon compte</a></p>
		</div>
        <script src="../public/ui.js"></script>
	</body>
</html>