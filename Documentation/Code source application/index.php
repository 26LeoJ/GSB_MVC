<?php
	session_start(); // On démarre la session avant d'écrire du PHP	
	$_SESSION['logged']=TRUE;

	/*// Afficher les erreurs à l'écran
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('error_log', dirname(__file__) . '/log_error_php.txt');*/

	// Ne pas afficher les erreurs à l'écran
	ini_set("display_errors",0);error_reporting(0);

	require('controleurs/controleur.php');

	// attention : toutes les urls prennent index.php comme referentiel, 
	//on se considere toujours dans le dossier contenant index.php

try
{

	if(isset($_SESSION['logged'])==false)
	{
		$_SESSION['logged']=false;
	}

	$action=$_GET['action'];

	if(isset($_GET['action'])==false)
	{
		$_GET['action']=null;
	}

	// si aucune action définie : affichage de l'accueil
	if($action==null)
	{
		accueil();
	}

	if($action=="login")
	{
		login();
	}


	if($action=="logged")
	{
		if((isset($_POST['login']) && isset($_POST['password'])) && testLoginMatch($_POST['login'],$_POST['password'])==true)
		{
			logged($_POST['login']);
			$_SESSION['listeFiche']=getUserFicheList($_SESSION['ID']);
			$_SESSION['ficheLue']=getFiche($_SESSION['ficheActuelle']);
			$_SESSION['fichesLuesHF']=getFichesHF($_SESSION['ficheActuelle']);
			initFiche();
		}

		else
		{
			//Si le mot de passe ne correspond pas
			//Renvoie l'utilisateur vers la page de connexion (!)-> vueErreurLogin.php afin qu'il puisse entrer à nouveau ses identifiants
			erreurLogin(); 
		}
	}

	if($_SESSION['logged']==false)
	{
		accueil();
	} 


	elseif($action=="rens")
	{
		$_SESSION['ficheLue']=getFiche($_SESSION['ficheActuelle']);
		$_SESSION['fichesLuesHF']=getFichesHF($_SESSION['ficheActuelle']);
		rens();
	}

	elseif($action=='selectFicheHF')
	{
		$_SESSION['FicheHFChoisit']=$_POST['FicheHFChoisit'];
		rens();
	}

	elseif($action=='modifierFicheHF')
	{
		replaceFicheFraisHF($_SESSION['FicheHFChoisit'], $_POST['date'], $_POST['nomfrais'], $_POST['prixfrais']);
		$_SESSION['fichesLuesHF']=getFichesHF($_SESSION['ficheActuelle']);
		rens();
	}

	elseif($action=='modifierTotal')
	{
		$_SESSION['affichageModification']=true;
		rens();
	}

	elseif($action=='validerTotal')
	{
		replaceFicheFraisForfait($_SESSION['ficheActuelle'], $_POST['forfaitetape'], $_POST['fraiskilometriques'], $_POST['nuiteehotel'], $_POST['repasrestaurant']);
		$_SESSION['ficheLue']=getFiche($_SESSION['ficheActuelle']);
		rens();
	}

	elseif($action=='annulerModification')
	{
		unset($_SESSION['affichageModification']);
		rens();
	}

	elseif($action=='annulerModificationHF')
	{
		unset($_SESSION['FicheHFChoisit']);
		rens();
	}

	elseif($action=="consul")
	{
		$_SESSION['listeFiche']=getUserFicheList($_SESSION['ID']);
		unset($_SESSION['affichageModification']);
		unset($_SESSION['FicheHFChoisit']);
		consul();
	}

	elseif($action=="selectMonth")
	{
		$_SESSION['listeFiche']=getUserFicheList($_SESSION['ID']);
		$_SESSION['ficheLue']=getFiche($_POST['moisChoisit']);
		$_SESSION['fichesLuesHF']=getFichesHF($_POST['moisChoisit']);
		consul();
	}

	elseif($action=="addNote")
	{
		modifyFicheFraisForfait($_SESSION['ficheActuelle'], $_POST['forfaitetape'], $_POST['fraiskilometriques'], $_POST['nuiteehotel'], $_POST['repasrestaurant']);
		$_SESSION['ficheLue']=getFiche($_SESSION['ficheActuelle']);
		rens();
	}

	elseif($action=="addNoteHF")
	{
		newFicheFraisHF($_SESSION['ficheActuelle'], $_POST['date'], $_POST['nomfrais'], $_POST['prixfrais']);
		$_SESSION['fichesLuesHF']=getFichesHF($_SESSION['ficheActuelle']);
		rens();
	}

	elseif($action=="logout")
	{
		logout();
		accueil();					
	}
}

catch (Exception $e)
{
    erreur($e->getMessage());
}
	

?>