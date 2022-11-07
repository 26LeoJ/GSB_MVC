<?php
	require_once 'modeles/modele.php';

	// Action 1 : Affiche la page d'accueil
	function accueil()
	{ 
  		require_once 'vues/vueAccueil.php';
	}

	// Action 2 : Affiche la page de login
	function login()
	{
	require 'vues/vueLogin.php';
	}

	function erreurLogin()
	{
	require 'vues/vueErreurLogin.php';
	}



	function logged($username)
	{	
		$_SESSION['logged']=true;
		$_SESSION['ID']=getUserID($username);
		/* $_SESSION['prenom']=getUserName($nameuser); */
		require'vues/vueLogged.php';
	}


	function logout()
	{
		$_SESSION['logged']=false;
		session_unset();
		session_destroy();
	}


	function rens()
	{
		require('vues/vueRensFiche.php');
	}

	function consul()
	{
		require('vues/vueConsulFiche.php');
	}

	function testLoginMatch($username,$password)
	{
		$pass=getPass($username);
		if($pass==$password)
		{
			return(true);
		}
		else
		{
			return(false);
		}
	}




	function initFiche()
	{
		$getFiche=getFicheDateList($_SESSION['ID']);
		if($getFiche[0]['mois'] != date("m")){
			$completeNewFiche=array(	'IDVisiteur'=>$_SESSION['ID'],
										'dateM'=>date("m"),
										'dateY'=>date("Y"),
										'IDFiche'=> $_SESSION['ID'].date("m").date("Y"),
										'default'=>'0',
										'dateModif'=>date("Y/m/d"),
										'IDEtat'=>'CR');
			addNewFiche($completeNewFiche);
			$array=array(	'1'=>array('idFiche'=>$completeNewFiche['IDFiche'],'tag'=>'ETP','quantite'=>0),
							'2'=>array('idFiche'=>$completeNewFiche['IDFiche'],'tag'=>'KM','quantite'=>0),
							'3'=>array('idFiche'=>$completeNewFiche['IDFiche'],'tag'=>'NUI','quantite'=>0),
							'4'=>array('idFiche'=>$completeNewFiche['IDFiche'],'tag'=>'REP','quantite'=>0));
			foreach ($array as $value) {
				addNewLigneFraisF($value['idFiche'], $value['tag'], $value['quantite']);
			}	
		}			
	}

	function getUserFicheList($ID)
	{
		$numToMonthTab=array(	'01'=>'Janvier',
								'02'=>'Février',
								'03'=>'Mars',
								'04'=>'Avril',
								'05'=>'Mai',
								'06'=>'Juin',
								'07'=>'Juillet',
								'08'=>'Aout',
								'09'=>'Septembre',
								'10'=>'Octobre',
								'11'=>'Novembre',
								'12'=>'Décembre');

		$listeFiche=getFicheDateList($ID);
		$_SESSION['ficheActuelle']=$listeFiche[0]['idFiche'];
		foreach($listeFiche as &$fiche){
			$fiche['mois']=$numToMonthTab[$fiche['mois']];
			$tableFiches[$fiche['idFiche']]=array(	'mois'=>$fiche['mois'],
													'annee'=>$fiche['annee']);
		}
		return($tableFiches);
	}

	function getFiche($IDfiche)
	{
		$contenuFiche = readNote($IDfiche);
		$contenuFiche[4]['dateFiche']=($_SESSION['listeFiche'][$IDfiche]['mois'].' '.$_SESSION['listeFiche'][$IDfiche]['annee']);
		return($contenuFiche);
	}

	function getFichesHF($IDfiche)
	{
		$listeFiches = readNoteHF($IDfiche);
		foreach($listeFiches as $fiche){
			$tableFiches[$fiche['id']]=array(	'idfichefrais'=>$fiche['idfichefrais'],
												'libelle'=>$fiche['libelle'],
												'dates'=>$fiche['dates'],
												'montant'=>$fiche['montant']);
		}
		return($tableFiches);
	}

	function modifyFicheFraisForfait($IDfiche, $etape, $kilometre, $hotel, $restaurant)
	{
		//prend le total déjà existant et y ajoute les nouvelles valeurs
		$valeursActu=getFiche($_SESSION['ficheActuelle']);
		$tabData=array(	'ETP'=>$etape + $valeursActu[0]['quantite'],
						'KM'=>$kilometre + $valeursActu[1]['quantite'],
						'NUI'=>$hotel + $valeursActu[2]['quantite'],
						'REP'=>$restaurant + $valeursActu[3]['quantite']);
		foreach($tabData as $key=>$ligne){
			modifyFraisForfait($IDfiche, $key, $ligne);
		}
	}

	function replaceFicheFraisForfait($IDfiche, $etape, $kilometre, $hotel, $restaurant)
	{
		//remplace le total actuel par le nouveau total
		$tabData=array(	'ETP'=>$etape,
						'KM'=>$kilometre,
						'NUI'=>$hotel,
						'REP'=>$restaurant);
		foreach($tabData as $key=>$ligne){
			modifyFraisForfait($IDfiche, $key, $ligne);
		}
	}

	function newFicheFraisHF($IDfiche, $date, $nom, $prix)
	{
		//crée une nouvelle fiche frais hors forfait avec les valeurs
		$ficheToAdd=array(	'IDfiche'=>$IDfiche,
							'date'=>$date,
							'nom'=>$nom,
							'prix'=>$prix);
		addFraisHF($ficheToAdd);
	}

	function replaceFicheFraisHF($IDfiche, $date, $nom, $prix)
	{
		//remplace les données de la fiche frais hors forfait par les nouvelles valeurs
		$newData=array(	'IDfiche'=>$IDfiche,
						'date'=>$date,
						'nom'=>$nom,
						'prix'=>$prix);
		modifyFraisHF($newData);
	}

	function erreur ()
	{
		echo 'Echec de la requête d\'insertion des fiches de frais !';
	}

?>