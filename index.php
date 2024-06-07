<?php
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http")
. "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));

require_once "./controller/API.controller.php";
require_once "./controller/ProjectsController/projets.controller.php";
$APIController = new APIController();
$ProjetsController = new ProjetsController();
try{
	if(empty($_GET['page'])){
		throw new Exception("La page n'existe pas!");
	}else{
		$url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
		if(empty($url[0])) throw new Exception("La page n'existe pas!");
		switch($url[0]){
			case "api" :
				switch($url[1]){
					case "projects" : $APIController->getProjects();
					break;
					case "project" : 
						if(empty($url[2])) throw new Exception("L'identifiant de l'animal est manquant!");
						$APIController->getProject($url[2]);
					break;
					case "contactEmail" : $APIController->emailContactApi();
					break;
					default : throw new Exception("La page n'existe pas!");
				}
			break;
			case "login" : $APIController->pageLogin();
			break;
			case "connexion" : $APIController->connexion();
			break;
			case "admin" : $APIController->getAccueilAdmin();
			break;
			case "deconnexion" : $APIController->deconnexion();
			break;
			case "projets" : 
				switch($url[1]){
				case "show" : $ProjetsController->visualisation();
				break;
				case "create" : $ProjetsController->creation();
				break;
				case "validationSuppression" : $ProjetsController->suppression();
				break;
				case "validationModification" : $ProjetsController->modification();
				break;
				case "validationCreation" : $ProjetsController->validationCreation();
				break;
				default : throw new Exception("La page n'existe pas!");
			}
			break;
			default : throw new Exception("La page n'existe pas!");
		}
	}
} catch(Exception $e) {
	$msg = $e->getMessage();
	echo $msg;
	echo "<br>";
	echo "<a href='" . URL ."login'>Se connecter</a>";
}

	

