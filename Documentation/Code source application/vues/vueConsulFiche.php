<!DOCTYPE html>
<html>
<head>
 <!-- définition des caractèristique de la page ainsi que les différents lien -->
	<title>Galaxy Swiss Bourdin - GSB</title>
	<link rel="stylesheet" type="text/css" href="ressources/css/default.css">
	<meta type="text/html" charset="utf-8">
</head>

<body>
  <header>
      <a id="logo"><img src="ressources/images/logo.jpg" alt="logo"/></a>
      <div class="menu">
        <h1 class="menuObj"><a href="<?= "index.php?action=logout" ?>">Se déconnecter</a></h1>
        <h1 class="menuObj"><a href="<?= "index.php?action=rens" ?>">Renseigner une fiche de frais</a></h1>
      </div>
   </header>

		<!-- <div id="conteneur">
			<div id="menu">
				 lien permettant de relier les différentes pages du site 
          <ul>
 					<li><a href="index.php?action=rens">Renseigner fiches de frais</a></li>
  					<li><a href="#"> Consulter fiche de frais</a></li>
  					<li  type="submit" style="float:right"><a class="active" href="index.php?action=logout">Deconnexion</a></li>
				</ul>
			</div> -->


    <div id="conteneur">

			<div id="formulaire">
        <h2 id="titre1">Consulter une fiche de frais</h2>
      	<div id="titre2">Frais Forfaitaires<?php if(isset($_SESSION['ficheLue'])){echo(" - ".$_SESSION['ficheLue'][4]['dateFiche']);} ?>
					<div>
						<form method="POST" action="index.php?action=selectMonth">
    							<select class="" name="moisChoisit">
                    <?php
                      foreach($_SESSION['listeFiche'] as $key => $fiche){
                        echo("<option value=".$key.">".$fiche['mois']." - ".$fiche['annee']."</option>");
                      }
                    ?>
    							</select>
							<input type="submit" id="btnSelect" value="valider">
						</form>
						</div>
					</div>
						<table id="AffichFrais" style="margin: 50px auto">
  								<thead id="enTete">
    								<tr id="tr">
      								<th id="titreTab">Libellé</th>
      								<th id="titreTab">Quantité</th>
      								<th id="titreTab">Prix Unité</th>
      								<th id="titreTab">Total</th>
    								</tr>
  								</thead>
  								<tbody id="tbody">
                    <?php
                      $total = 0;
                      $compteur = 0;
                      foreach($_SESSION['ficheLue'] as $indice){
                        if($compteur !== 4){
                          echo('<tr id="tr">');
                          foreach($indice as $champ){
                            echo('<td id="affichageTD">'.$champ.'</td>');
                          }
                          $total = $total + ($indice['quantite'] * $indice['montant']);
                          echo('<td id="affichageTD">'.$indice['quantite'] * $indice['montant'].' €</td>');
    								      echo('</tr>');
                        }
                        $compteur++;
                      }
                    ?>
  								</tbody>
  								<tfoot id="tfoot">
    								<tr id="tr">
      								<th id="titreTab" colspan="3">Grand Total</th>
      								<th id="titreTab"><?php echo($total); ?> €</th>
    								</tr>
  								</tfoot>
							</table>
							<p id="titre3">Autres Frais </p>
							<div id="conteneurHF">
                <?php
                  foreach($_SESSION['fichesLuesHF'] as $fiche){
                    echo('
								      <div id="ViewFraisHF">
                        <table id="AffichFraisHF" style="margin: 0px auto">
                          <thead id="enTete">
                            <tr id="tr">
                              <th id="titreTabHF" name="HorsForfait" colspan="2">Frais Hors Forfait</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">
                            <tr id="titreTabHF">
                              <td id="affichageTDHF">Libellé</td>
                              <td id="affichageTDHF">'.$fiche['libelle'].'</td>
                            </tr>
                            <tr id="titreTab">
                              <td id="affichageTDHF">Date</td>
                              <td id="affichageTDHF">'.$fiche['dates'].'</td>
                            </tr>
                            <tr id="titreTab">
                              <td id="affichageTDHF">Montant</td>
                              <td id="affichageTDHF">'.$fiche['montant'].'</td>
                            </tr>
                          </tbody>
                        </table>
								      </div>
                    ');
                  }
                ?>
				</div>
			</div>
		</div>
</body>
</html>


