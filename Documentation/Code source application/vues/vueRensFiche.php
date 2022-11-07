<!DOCTYPE html>
<html>
<head>
	<title>Galaxy Swiss Bourdin - GSB</title>
	<script  language="javascript" type="text/javascript" src="ressources/javascript/main.js"></script>
	<link rel="stylesheet" type="text/css" href="ressources/css/default.css">
	<meta type="text/html" charset="utf-8">
</head>

	<body>
	  <header>
		<a id="logo"><img src="ressources/images/logo.jpg" alt="logo"/></a>
		<div class="menu">
			<h1 class="menuObj"><a href="<?= "index.php?action=logout" ?>">Se déconnecter</a></h1>
			<h1 class="menuObj"><a href="<?= "index.php?action=consul" ?>">Consulter une fiche de frais</a></h1>
		</div>
		 </header>

		<!-- <div id="conteneur">
			<div id="menu">
			 lien permettant de relier les différentes pages du site 
				<ul>
 					<li><a href="#"> Renseigner fiches de frais</a></li>
  					<li><a href="index.php?action=consul">Consulter une fiche de frais</a></li>
  					<li style="float:right"><a class="active" href="index.php?action=logout">Se déconnecter</a></li>
				</ul>
				</div> -->



			<!-- Formulaire permettant la saisie des différents frait et frais hors forfaits  -->
			
		<div id="conteneur">

			<div class="formulaire">
				<h2 id="titre1">Renseigner une fiche de frais</h2>
				<p id="titre2">Frais Forfaitaires</p>
				<div id="FraisForfait">
					<div id="total">
						<table id="totalform">
							<tr id="titrerow">
								<td id="titrerow">
									<b id="titrecol">Totaux</b>
								</td>
							</tr>
							<?php
								$total = 0;
								$compteur = 0;
									foreach($_SESSION['ficheLue'] as $indice){
										if($compteur !== 4){
											echo('<tr id="espacerow">');
											echo('<td id="espacerow">');
											echo('<b>'.$indice['libelle'] .' </b>');
											echo('</td>');
											echo('<tr id="totalformrow">');
											echo('<td id="totalformcoln">'.$indice['quantite'].'</td>');
											echo('</tr>');
										}
								$compteur++;
								}
							?>
							<tr id="espacerow">
								<td id="espacerow">

								</td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput">
									<form method="post" action="index.php?action=modifierTotal">
										<input id="Frais" name="validationFormulaireFrais" value="Modifier Total" type="submit">
									</form>
								</td>
							</tr>
						</table>
					</div>
					<div id="total">
					<?php
                     	if(isset($_SESSION['affichageModification'])){
                        	echo('<form method="post" action="index.php?action=validerTotal">');
                        }
                        else{
                            echo('<form method="post" action="index.php?action=addNote">');
                        }
                    ?>
						<table id="totalform">
							<?php  
								if(isset($_SESSION['affichageModification'])){
									echo('
											<!--Code titre Modifications de Frais -->
											<tr id="titrerow">
												<td id="titrerow" colspan="2">
													<b id="titrecol">Modifications de Frais</b>
												</td>
											</tr>
										');
									}
									else{
										echo('
												<!--Code titre Ajouts de Frais -->
												<tr id="titrerow">
													<td id="titrerow" colspan="2">
														<b id="titrecol">Ajouts de Frais</b>
													</td>
													<td></td>
												</tr>
											');
									}
							?>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Forfait Etape : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le nombre de forfait" name="forfaitetape" id="fraisforfaitaires" onkeypress="verifierCaracteresNum(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="6" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Frais Kilométriques : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le nombre de Kilomètres" name="fraiskilometriques" id="fraisforfaitaires" onkeypress="verifierCaracteresNum(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="6" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Nuitée Hôtel : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le nombre de nuitée" name="nuiteehotel" id="fraisforfaitaires" onkeypress="verifierCaracteresNum(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="6" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Repas Restaurants : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le nombre de repas" name="repasrestaurant" id="fraisforfaitaires" onkeypress="verifierCaracteresNum(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="6" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<?php  
									if(isset($_SESSION['affichageModification'])){
										echo('
												<!-- Code affichage bouton Annuler + Valider-->
												<td id="totalformcolninput" width="50%" style="background:#D8D8D8; border: 0px solid black;">
													<div id="button">
														<input id="Frais" type="submit" Value="Valider" name="validationFormulaireFrais" style="width:200px;">
													</div>	
												</td>
												<td id="totalformcolninput" width="50%" style="background:#D8D8D8; border: 0px solid black;">
													<a style="text-decoration:none;" href="index.php?action=annulerModification"><input id="Frais" type="submit" value="Annuler" name="validationFormulaireFrais" style="width:200px;"></a>
												</td>
										');
									}
									else{
										echo('
												<!-- Code affichage bouton Valider (seul) -->
												<td id="totalformcolninput" colspan="2">
													<input id="Frais" type="submit" value="Valider" name="validationFormulaireFrais" style="width:401px;">
												</td>
												<td></td>
										');
									}
								?>
							</tr>
						</table>
					</form>
				</div>
			</div>


			<div class="formulaire">
				<div id="titre3"> Autres Frais
					<!-- <div> 
						<form method="POST" action="index.php?action=selectFicheHF">
							<select class="" name="FicheHFChoisit">
							<?php
								foreach($_SESSION['fichesLuesHF'] as $key => $ficheHF){
									echo("<option value=".$key.">".$ficheHF['libelle']."</option>");

								}
							?>
							</select>
							<input type="submit" id="btnSelect" value="Modifier">
						</form>
					</div> !-->
				</div>
				<?php
					if(isset($_SESSION['FicheHFChoisit']))
					{
						echo('
								<div id="FraisHorsForfait">
								<!-- Affichage des valeurs anciennement contenue dans la base lors de la modification -->
									<div id="total">
										<table id="totalform">
							');
						$fiche=$_SESSION['fichesLuesHF'];
						$repfiche=$_SESSION['FicheHFChoisit'];
						echo('
											<tr id="titrerow">
												<td id="titrerow">
													<b id="titrecol">Frais Hors Forfait</b>
												</td>
											</tr>
											<tr id="espacerow">
												<td id="espacerow">
													<b>Date : </b>
												</td>
											</tr>
											<tr id="totalformrow">
												<td id="totalformcoln">
													<b>'.$fiche[$repfiche]['dates'].'</b>
												</td>
											</tr>
											<tr id="espacerow">
												<td id="espacerow">
													<b>Nom Frais : </b>
												</td>
											</tr>
											<tr id="totalformrow">
												<td id="totalformcoln">
													<b>'.$fiche[$repfiche]['libelle'].'</b>
												</td>
											</tr>
											<tr id="espacerow">
												<td id="espacerow">
													<b>Prix Prais : </b>
												</td>
											</tr>
											<tr id="totalformrow">
												<td id="totalformcoln">
													<b>'.$fiche[$repfiche]['montant'].' €</b>
												</td>
											</tr>
										</table>
									</div>
							');								 			 
						}
				?>
					<!-- Saisie des Données et Modification des données -->
				<div id="total">
					<?php
                        if(isset($_SESSION['FicheHFChoisit'])){
                            echo('<form method="POST" action="index.php?action=modifierFicheHF" >');
                        }
                        else{
                            echo('<form method="POST" action="index.php?action=addNoteHF" >');
                        }
                    ?>
						<table id="totalform">
							<?php
								if(isset($_SESSION['FicheHFChoisit'])){
									echo('								
											<tr id="titrerow">
												<td id="titrerow" colspan="2">
													<b id="titrecol">Modification de Frais Hors Forfait </b>
												</td>
												<td></td>
											</tr>
										');
								}
								else{
									echo('
											<tr id="titrerow">
												<td id="titrerow" colspan="2">
													<b id="titrecol">Ajout de Frais Hors Forfaits</b>
												</td>
												<td></td>
											</tr>
										');
								}
							  ?>								
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Date : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="date" placeholder="Indiquer la date du frais" name="date" id="fraisforfaitaires" onkeypress="verifierCaracterestext(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Nom Frais : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le nom du frais" name="nomfrais" id="fraisforfaitaires" onkeypress="verifierCaracteresText(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="30" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow">
								<td id="espacerow" colspan="2">
									<b>Prix Prais : </b>
								</td>
								<td></td>
							</tr>
							<tr id="totalformrow">
								<td id="totalformcolninput" colspan="2">
									<input type="text" placeholder="Indiquer le prix du frais" name="prixfrais" id="fraisforfaitaires" onkeypress="verifierCaracteresNum(event); return false;" oncontextmenu="return false" onPaste="this.value = '';return false;" maxlength="6" required>
								</td>
								<td></td>
							</tr>
							<tr id="espacerow" >
								<td id="espacerow" colspan="2">

								</td>
								<td></td>
							</tr>
								<?php
									if(isset($_SESSION['FicheHFChoisit'])){
										echo('								
												<tr id="totalformrow">
													<td id="totalformcolninput" width="50%" style="background:#D8D8D8; border: 0px solid black;">
														<input id="Frais" type="submit" value="Valider" name="validationFormulaireFrais" style="width: 200px;">
													</td>
													<td id="totalformcolninput" width="50%" style="background:#D8D8D8; border: 0px solid black;">
														<a style="text-decoration:none;" href="index.php?action=annulerModificationHF"><input id="Frais" type="submit" value="Annuler" name="validationFormulaireFrais" style="width: 200px;"></a>
													</td>
												</tr>
											');
									}
									else{
										echo('
												<tr id="totalformrow">
													<td id="totalformcolninput" colspan="2" style="background:#D8D8D8; border: 0px solid black;">
														<input id="Frais" type="submit" value="Valider" name="validationFormulaireFrais">
													</td>
											');
									}
								?>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
