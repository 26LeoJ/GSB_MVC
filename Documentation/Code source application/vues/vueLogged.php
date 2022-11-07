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
				<h1 class="menuObj"><a href="<?= "index.php?action=logout" ?>">Se déconnecter</a></h1>
				<h1 class="menuObj"><a href="<?= "index.php?action=consul" ?>">Consulter une fiche de frais</a></h1>
				<h1 class="menuObj"><a href="<?= "index.php?action=rens" ?>">Renseigner une fiche de frais</a></h1>
				
			</div>
		</header>
	
		<div class="textBox">
			<h2>Bienvenue</h2>
			<p class="filler"> </p>
			<p>Vous pouvez maintenant renseigner ou consulter vos fiches de frais.</p>
			<p>Utilisez les boutons du menu en haut de l'écran pour naviguer.</p>
			<p>Utilisez le bouton "se déconnecter" pour retourner à l'écran d'accueil.</p>
		</div>
		
		<footer>
			<p>Copyright © 2018 - Tous droits réservés - Galaxy-Swiss Bourdin</p>
		</footer>
	</body>
</html>