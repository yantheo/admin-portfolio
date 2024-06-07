<?php

class Securite{
	public static function secureHTML($string){
		return html_entity_decode($string);
	}

	public static function verifAccessSession(){
		return (!empty($_SESSION['access']) && $_SESSION['access'] === "admin");
	}
}

?>