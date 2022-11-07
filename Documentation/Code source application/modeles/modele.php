<?php
	function bddConnect()
	{
		$host='localhost';
		$dbname='gsb';
		$login='root';
		$password='';

		try{
			$bdd=new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $login, $password);
		}
		catch(Exception$e){
			die('Erreur : '. $e->getMessage());
		}
		return($bdd);
	}

	function getPass($username){
		$bdd=bddConnect();
		//récupère le mot de passe correspondant au nom d'utilisateur entré en paramètre
		$password = $bdd->prepare('select mdp from visiteur where login=?');
		$password->execute(array($username));
		$password = $password->fetch();
		return($password['mdp']);
	}

	function getUserID($username)
	{
		$bdd=bddConnect();
		//récupère le mot de passe correspondant au nom d'utilisateur entré en paramètre
		$userID = $bdd->prepare('select matricule from visiteur where login=?');
		$userID->execute(array($username));
		$userID = $userID->fetch();
		return($userID['matricule']);

	}


	/* function getUserName($nameuser)
	{
		$bdd=bddConnect();
		//récupère le prenom correspondant au nom d'utilisateur entré en paramètre
		$userName = $bdd->prepare('select prenom from visiteur where login=?');
		$userName->execute(array($nameuser));
		$userName = $userName->fetch();
		return($userName['prenom']);

	} */




	function addNewFiche($dataNewFiche){
		$bdd=bddConnect();
		//Créaion d'une nouvelle fiche en fonction de l'id, du mois, de l'année en cours //
		$addNewFiche = $bdd->prepare('INSERT INTO fichefrais (idVisiteur, mois, annee, idFiche, nbJustificatif, montantValide, dateModif, idEtat) VALUES ( :addIdVisiteur, :addMois, :addAnnee, :addIdFiche, :addNbJustificatif, :addMontantValide, :addDateModif, :addIdEtat)');
		$addNewFiche->bindValue(':addIdVisiteur', $dataNewFiche['IDVisiteur'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addMois', $dataNewFiche['dateM'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addAnnee', $dataNewFiche['dateY'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addIdFiche', $dataNewFiche['IDFiche'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addNbJustificatif', $dataNewFiche['default'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addMontantValide', $dataNewFiche['default'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addDateModif', $dataNewFiche['dateModif'], PDO::PARAM_STR);
		$addNewFiche->bindValue(':addIdEtat', $dataNewFiche['IDEtat'], PDO::PARAM_STR);
		$addNewFiche->execute();
	}
	function addNewLigneFraisF($idFiche, $tag, $quantite){
		$bdd=bddConnect();
		$addNewForfait = $bdd->prepare('INSERT INTO lignefraisforfait (idFicheFrais, idFraisForfait, quantite) VALUES (:addIdFiche, :addIdFraisForfait, :addQuantite)');
		$addNewForfait->bindValue(':addIdFiche', $idFiche, PDO::PARAM_STR);
		$addNewForfait->bindValue(':addIdFraisForfait', $tag, PDO::PARAM_STR);
		$addNewForfait->bindValue(':addQuantite', $quantite, PDO::PARAM_STR);
		$addNewForfait->execute();
	}



	function changeEtatFiche($dataNewEtat){
		$bbd=bddConnect();
		//clotture de la fiche de frais du mois passé et celle qui ont n'on pas été créez//
		$changeEtatFiche =  $bdd->prepare('UPDATE fichefrais SET idEtat = :changeIdEtat WHERE idFiche = :changeIdFiche ');
		$changeIdFiche->bindValue(':changeIdEtat', $dataNewEtat[''], PDO::PARAM_STR);
		$changeIdFiche->bindValue(':changeIdFiche',$dataNewEtat[''], PDO::PARAM_STR);
		$changeIdFiche->execute();
	}

	function readNote($IDnote){
		$bdd=bddConnect();
		$noteContent = $bdd->prepare('	SELECT libelle, quantite, montant from fichefrais
										inner join lignefraisforfait on lignefraisforfait.idfichefrais = fichefrais.idfiche
										inner join fraisforfait on fraisforfait.id = lignefraisforfait.idfraisforfait
										where fichefrais.idfiche = :IDnote');
		$noteContent->bindValue(':IDnote', $IDnote, PDO::PARAM_STR);
		$noteContent->execute();
		$noteContent = $noteContent->fetchAll(PDO::FETCH_ASSOC);
		return($noteContent);
		//renvoie le contenu de la fiche correspondant à l'utilisateur et au mois entrés en paramètre
	}

	function readNoteHF($IDnoteHF){
		$bdd=bddConnect();

		$noteContent = $bdd->prepare('	SELECT id, idfichefrais, libelle, dates, montant from fichefrais
										inner join lignefraishorsforfait on lignefraishorsforfait.idfichefrais = fichefrais.idfiche
										where fichefrais.idfiche = :IDnoteHF');
		$noteContent->bindValue(':IDnoteHF', $IDnoteHF, PDO::PARAM_STR);
		$noteContent->execute();
		$noteContent = $noteContent->fetchAll(PDO::FETCH_ASSOC);
		return($noteContent);
		//renvoie le contenu de la fiche correspondant à l'utilisateur et au mois entrés en paramètre
	}

	function modifyFraisForfait($IDfiche, $tag, $quantite){
		$bdd=bddConnect();
		//remplace le contenu de la fiche frais forfait actuel par les nouvelles valeurs
		$modifyFraisF = $bdd->prepare('UPDATE lignefraisforfait SET quantite = :quantiteFraisF WHERE idFicheFrais = :idFicheF AND idFraisForfait = :idFraisF');
		$modifyFraisF->bindValue(':idFraisF', $tag, PDO::PARAM_STR);
		$modifyFraisF->bindValue(':quantiteFraisF', $quantite, PDO::PARAM_INT);
		$modifyFraisF->bindValue(':idFicheF', $IDfiche, PDO::PARAM_STR);
		$modifyFraisF->execute();
	}

	function addFraisHF($dataToAdd){
		$bdd=bddConnect();
		//ajoute la nouvelle fiche frais hors forfait
		$addFraisHF = $bdd->prepare('INSERT INTO lignefraishorsforfait(idFicheFrais, libelle, dates, montant) VALUES (:addIDFicheF,:addLibelleHF, :addDateHF, :addMontantHF)');
		$addFraisHF->bindValue(':addIDFicheF', $dataToAdd['IDfiche'], PDO::PARAM_STR);
		$addFraisHF->bindValue(':addLibelleHF', $dataToAdd['nom'], PDO::PARAM_STR);
		$addFraisHF->bindValue(':addDateHF', $dataToAdd['date'], PDO::PARAM_STR);
		$addFraisHF->bindValue(':addMontantHF', $dataToAdd['prix'], PDO::PARAM_INT);
		$addFraisHF->execute();
	}

	function modifyFraisHF($newData){
		$bdd=bddConnect();
		//remplace le contenu de la fiche frais hors forfait avec les nouvelles valeurs
		$modifyFraisHF = $bdd->prepare('UPDATE lignefraishorsforfait SET libelle = :newLibelleHF, dates = :newDatesHF, montant = :newMontantHF WHERE id = :newIDHF');
		$modifyFraisHF->bindValue(':newLibelleHF', $newData['nom'], PDO::PARAM_STR);
		$modifyFraisHF->bindValue(':newDatesHF', $newData['date'], PDO::PARAM_STR);
		$modifyFraisHF->bindValue(':newMontantHF', $newData['prix'], PDO::PARAM_INT);
		$modifyFraisHF->bindValue(':newIDHF', $newData['IDfiche'], PDO::PARAM_STR);
		$modifyFraisHF->execute();
	}

	function getFicheDateList($ID){
		$bdd=bddConnect();
		$listFicheFrais = $bdd->prepare('SELECT idFiche, mois, annee from fichefrais where idvisiteur=? order by annee DESC, mois DESC');
		$listFicheFrais->execute(array($ID));
		$listFicheFrais = $listFicheFrais->fetchAll(PDO::FETCH_ASSOC);
		return($listFicheFrais);
	}
?>