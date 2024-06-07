<?php
require_once './model/Model.php';

class ProjectsManager extends Model{
	public function getMyProjects(){
		$req = 'SELECT * FROM projects';
		$stmt = $this->getBdd()->prepare($req);
		$stmt->execute();
		$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $projects;
	} 

	public function deleteProject($id){
		$req = "DELETE FROM projects WHERE project_id = :id";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT).
		$stmt->execute();
		$stmt->closeCursor();
	}

	public function modificationProject($project_id, $project_name, $project_description, $project_image, $project_stack){
		$req = "Update projects SET project_name = :project_name, project_description = :project_description, project_image = :project_image, project_stack = :project_stack WHERE project_id = :project_id";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(':project_id', $project_id, PDO::PARAM_INT);
		$stmt->bindValue(':project_description', $project_description, PDO::PARAM_STR);
		$stmt->bindValue(':project_name', $project_name, PDO::PARAM_STR);
		$stmt->bindValue(':project_image', $project_image, PDO::PARAM_STR);
		$stmt->bindValue(':project_stack', $project_stack, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->closeCursor();
	}

	public function creationProjet($name, $description, $stack, $image){
		$req = "INSERT INTO projects (project_name, project_description, project_stack, project_image) values (:name, :description, :stack, :image)";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':stack', $stack, PDO::PARAM_STR);
		$stmt->bindValue(':image', $image, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->closeCursor();
	}

	public function getImageProject($idProject){
		$req = "SELECT project_image FROM projects WHERE project_id = :idProject";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(':idProject', $idProject, PDO::PARAM_INT);
		$stmt->execute();
		$project_image = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $project_image['project_image'];
	}
}