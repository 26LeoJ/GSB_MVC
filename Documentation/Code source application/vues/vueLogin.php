<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="ressources/css/style.css"/>
		<title>Galaxy Swiss Bourdin - GSB</title>
	</head>
	
	<body>
		<header>
			<a id="logo"><img src="ressources/images/logo.jpg" alt="logo"/></a>
			<div class="menu">
				<h1 class="menuObj"><a href="index.php">Accueil</a></h1>
			</div>
		</header>
		
		<div class="formulaireLogin">
			<h2>Connexion</h2>
			<form action="<?= "index.php?action=logged" ?>" method="post">
				<p><label>Login</label>  <input class="labLog" type="text" name="login" required /></p>
				<p><label>Mot de passe</label>  <input class="labMdp" type="password" name="password" required /></p>
				<p><input type="submit" value="Se connecter"/></p>
			</form>
		</div>
		
		<footer>
			<p>Copyright © 2018 - Tous droits réservés - Galaxy-Swiss Bourdin</p>
			
		</footer>
	</body>
</html>
