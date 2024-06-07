<?php

require_once './model/Model.php';

class APIManager extends Model{
	public function getDBprojects(){
		$req = "SELECT * from projects";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->execute();
		$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $projects;
	}

	public function getDBproject($id){
		$req = "SELECT * from projects WHERE project_id = :id";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$project = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $project;
	}

	private function getPasswordUser($login){
		$req = "SELECT * FROM administrateur WHERE login = :login";
		$stmt = $this->getBdd()->prepare($req);
		$stmt->bindValue(":login", $login, PDO::PARAM_STR);
		$stmt->execute();
		$admin = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $admin['password'];
	}

	public function isConnexionValid($login, $password){
		$passwordBD = $this->getPasswordUser($login);
		return password_verify($password, $passwordBD);
	}
}