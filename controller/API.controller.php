<?php

require_once "./model/API.manager.php";
require_once "./model/Model.php";
require_once "./controller/Securite.php";

class APIController{

	private $apiManager;

	public function __construct()
	{
		$this->apiManager = new APIManager();	
	}

	public function getProjects(){
		$tab = [];
		$projects = $this->apiManager->getDBprojects();
		foreach($projects as $project => $key){
			$tab[] = [
				"project_id" => $key['project_id'],
				"project_name" => $key['project_name'],
				"project_description" => $key['project_description'],
				"project_image" => URL . 'public/image/' . $key['project_image'],
				"project_stack" => $key['project_stack'],
				"project_website" => $key['project_website']
			];
		}
		Model::sendJSON($tab);
	}

	public function getProject($id){
		$project = $this->apiManager->getDBproject($id);
		foreach($project as $key => $value){
			$tab[] = [
				"project_id" => $value['project_id'],
				"project_name" => $value['project_name'],
				"project_description" => $value['project_description'],
				"project_image" => URL . 'public/image/' . $value['project_image'],
				"project_stack" => $value['project_stack'],
				"project_website" => $value['project_website']
			];
			Model::sendJSON($tab);		
		}
	}

	public function pageLogin(){
		require_once "./view/login.php";
	}

	public function connexion(){
		//echo password_hash('admin', PASSWORD_DEFAULT);
		if(!empty($_POST['login']) && !empty($_POST['password'])){
			$login = Securite::secureHTML($_POST['login']);
			$password = Securite::secureHTML($_POST['password']);
			if($this->apiManager->isConnexionValid($login, $password)){
				$_SESSION['access'] = 'admin';
				header('location: ' . URL . 'admin');
			}else{
				header('location: ' . URL . 'login');
			}
		}
	}
	public function getAccueilAdmin(){
		if(Securite::verifAccessSession()){
			require "./view/admin.php";
		}
		else{
			header('location: ' . URL . 'login');
		}
		
	}
	public function deconnexion(){
		session_destroy();
		header('location: ' . URL . 'login');
	}

	public function emailContactApi(){
		require "./view/emailContactApi.php";
	}
}