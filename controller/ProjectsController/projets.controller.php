<?php
require_once './controller/Securite.php';
require_once './controller/ProjectsManager/projects.manager.php';
require_once './controller/imageManager.php';

class ProjetsController{
	private $projectsManager;

	public function __construct(){
		$this->projectsManager = new ProjectsManager();
	}
	
	public function visualisation(){
		if(Securite::verifAccessSession()){
			$projects = $this->projectsManager->getMyProjects();
			require_once './view/projects.view.php';
		}else{
			throw new Exception("Vous ne devez pas être là");
		}
	}

	public function suppression(){
		if(Securite::verifAccessSession()){
			$idProject = (int)Securite::secureHTML($_POST['project_id']);
			$image = $this->projectsManager->getImageProject($idProject);
			unlink("public/image/". $image);
			$this->projectsManager->deleteProject($idProject);
			$_SESSION['alert'] = [
				'message' => "Le projet est supprimé",
				'type' => "alert-success",
			];
			header('location: ' . URL . 'projets/show');
		}else{
			throw new Exception("Vous ne devez pas être là");
		}
	}

	public function modification(){
		if(Securite::verifAccessSession()){
			$project_id = (int)Securite::secureHTML($_POST['project_id']);
			$project_name = Securite::secureHTML($_POST['project_name']);
			$project_description = Securite::secureHTML($_POST['project_description']);
			$project_stack = Securite::secureHTML($_POST['project_stack']);
			$project_image = $this->projectsManager->getImageProject($project_id);
			if($_FILES['project_image']['size'] > 0){
				unlink('public/image/'. $project_image);
				$repertoire = 'public/image/';
				$project_image = ajoutImage($_FILES['project_image'], $repertoire);
			}
			$this->projectsManager->modificationProject($project_id, $project_name, $project_description, $project_image, $project_stack);
			$_SESSION['alert'] = [
				'message' => "Le projet a bien été modifié",
				'type' => "alert-success",
			];
			header('location: ' . URL . 'projets/show');
		}else{
			throw new Exception("Vous ne devez pas être là");
		}
	}

	public function creation(){
		if(Securite::verifAccessSession()){
			require_once './view/projetCreation.view.php';
		}else{
			throw new Exception("Vous ne devez pas être là");
		}
	}

	public function validationCreation(){
		if(Securite::verifAccessSession()){
			$name = Securite::secureHTML($_POST['project_name']);
			$description = Securite::secureHTML($_POST["project_description"]);
			$stack = Securite::secureHTML($_POST["project_stack"]);
			$image= "";
			if($_FILES['project_image']['size'] > 0){
				$repertoire = 'public/image/';
				$image = ajoutImage($_FILES['project_image'], $repertoire);
			}
			$this->projectsManager->creationProjet($name, $description, $stack, $image);
			$_SESSION['alert'] = [
				'message' => "Le projet a bien été créé",
				'type' => "alert-success",
			];
			header('location: ' . URL . 'projets/show');
		}else{
			throw new Exception("Vous ne devez pas être là");
		}
	}
}